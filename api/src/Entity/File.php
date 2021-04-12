<?php

namespace App\Entity;

use App\Utils\Utils;

const FILE_TYPE_IMAGE_JPEG = 'image/jpeg';
const FILE_TYPE_IMAGE_PNG = 'image/png';
const FILE_TYPE_IMAGE_GIF = 'image/gif';
const FILE_TYPE_AUDIO_AAC = 'audio/aac';

const FILE_TYPES = [
    FILE_TYPE_IMAGE_JPEG, FILE_TYPE_IMAGE_PNG, FILE_TYPE_IMAGE_GIF, FILE_TYPE_AUDIO_AAC
];

const MAX_IMAGE_FILE_SIZE = 307200; // 307 200 octets = 300 Kio (for Windows)

trait File
{
    /**
     * File URI
     *
     * @var string
     */
    private $src;

    /**
     * File Path (in local to edit file)
     *
     * @var string
     */
    private $path;

    /**
     * File type
     *
     * @var string
     */
    private $fileType = null;

    /**
     * File exists indicator
     *
     * @var boolean
     */
    private $fileExists = false;

    /**
     * File Size in bytes
     *
     * @var int
     */
    private $fileSize = null;

    /**
     * Get File URI
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set File URI
     *
     * @param string $src File URI or WP ID Attachment
     *
     * @return self
     */
    public function setSrc($src)
    {
        $src = Utils::addHttp($src);

        if (Utils::isUrl($src)) {
            $this->src = $src;
            $this->fileExists = null;
            $this->fileSize = null;
        }

        return $this;
    }

    /**
     * Check if File has a src value
     *
     * @return bool
     */
    public function hasSrc()
    {
        return Utils::isUrl($this->getSrc());
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path = null)
    {
        if (!is_null($path)) {
            $this->path = $path;

            return $this;
        }

        if (!$this->hasPath()) {
            $this->downloadFile();
        }

        return $this;
    }

    public function hasPath()
    {
        $path = $this->getPath();

        return is_string($path) && strlen($path) > 0 && file_exists($path);
    }

    /**
     * Get File Type
     *
     * @return void
     */
    public function getFileType()
    {
        if (is_null($this->fileType)) {
            $this->checkFileType();
        }

        return $this->fileType;
    }

    /**
     * Set File Type
     *
     * @param string $fileType
     *
     * @return self
     */
    public function setFileType($fileType = null)
    {
        if (is_null($fileType)) {
            $this->checkFileType();
        }

        if (in_array($fileType, FILE_TYPES)) {
            $this->fileType = $fileType;
        }

        return $this;
    }

    public function checkFileType()
    {
        if (!$this->hasFileType() && $this->isFileExists()) {
            $file = $this->getSrc();

            if ($this->hasPath()) {
                $file = $this->getPath();
            }

            $info = getimagesize($file);

            $this->fileType = Utils::getArrayValue('mime', $info);
        }

        return $this;
    }

    public function hasFileType()
    {
        return in_array($this->fileType, FILE_TYPES);
    }

    /**
     * Get indicator File exists
     *
     * @return bool
     */
    public function isFileExists()
    {
        if (is_null($this->fileExists)) {
            $this->checkFileExists();
        }

        return true === $this->fileExists;
    }

    /**
     * Set indicator File exists
     *
     * @param bool $fileExists Image fileExists
     *
     * @return self
     */
    public function setFileExists($fileExists)
    {
        if (is_bool($fileExists)) {
            $this->fileExists = $fileExists;
        }

        return $this;
    }

    /**
     * Check if the file behind Image src exists and set fileExists indicator
     *
     * @return boolean
     */
    public function checkFileExists()
    {
        // Check if the file is already downloaded to avoid HTTP requests
        if ($this->hasPath()) {
            return file_exists($this->getPath());
        }

        $fileExists = self::isFileExistsFromUrl($this->getSrc());

        $this->setFileExists($fileExists);

        return $fileExists;
    }

    /**
     * Get Image File Size
     *
     * @return int|null
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set Image File Size if isn't already
     *
     * @param boolean $force
     *
     * @return self
     */
    public function setFileSize($force = false)
    {
        if ($this->hasFileSize() && !$force) {
            return $this;
        }

        $this->setPath();

        // Check if the file is already downloaded to avoid HTTP requests
        if ($this->hasPath() && $this->isFileExists()) {
            $this->fileSize = filesize($this->getPath());
        }

        return $this;
    }

    /**
     * Check if Image has a valid File Size
     *
     * @return boolean
     */
    public function hasFileSize()
    {
        $fileSize = $this->getFileSize();

        return (is_int($fileSize) && $fileSize > 0);
    }

    /**
     * Check if Image has a File Size equals or lower than given Max File Size (in bytes)
     *
     * @param int $maxFileSize Max File Size in bytes
     *
     * @return boolean|null
     */
    public function checkFileSize($maxFileSize = MAX_IMAGE_FILE_SIZE)
    {
        $this->setFileSize();

        if (!$this->hasFileSize()) {
            return null;
        }

        return $this->getFileSize() <= $maxFileSize;
    }

    /**
     * Download File In Uploads Directory
     *
     * Eg.
     *
     * $file = download_file( `file-url` );
     *
     * if( $file['success'] ) {
     *     $file_abs_url = $file['data']['file'];
     *     $file_url     = $file['data']['file'];
     *     $file_type    = $file['data']['type'];
     * }
     *
     * @param  string $file Download File URL.
     * @return array        Downloaded file data.
     */
    public function downloadFile()
    {
        // Gives us access to the download_url() and wp_handle_sideload() functions.
        require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $timeout = 5;

        $fileUrl = $this->getSrc();

        // Download file to temp dir.
        $tempFile = download_url($fileUrl, $timeout);

        // WP Error.
        if (is_wp_error($tempFile)) {
            return [
                'success' => false,
                'data'    => $tempFile->get_error_message(),
            ];
        }

        // Array based on $_FILE as seen in PHP file uploads.
        $fileArgs = [
            'name'     => basename($fileUrl),
            'tmp_name' => $tempFile,
            'error'    => 0,
            'size'     => filesize($tempFile)
        ];

        $overrides = [
            // Tells WordPress to not look for the POST form fields that would normally be present as
            // we downloaded the file from a remote server, so there will be no form fields
            // Default is true
            'test_form'   => false,

            // Setting this to false lets WordPress allow empty files, not recommended.
            // Default is true
            'test_size'   => true,

            // A properly uploaded file will pass this test. There should be no reason to override this one.
            'test_upload' => true,
        ];

        // Move the temporary file into the uploads directory.
        $results = wp_handle_sideload($fileArgs, $overrides);

        if (isset($results['error'])) {
            return [
                'success' => false,
                'data'    => $results,
            ];
        }

        $this->path = Utils::getArrayValue('file', $results);
        $this->src  = Utils::getArrayValue('url', $results);
        $this->fileExists = true;

        return [
            'success' => true,
            'data'    => $results
        ];
    }

    /**
     * Remove file on Disk
     *
     * @return boolean True if unlink executed successfuly, false otherwise
     */
    public function removeFile()
    {
        if ($this->hasPath() && $this->isFileExists()) {
            return unlink($this->getPath());
        }

        return false;
    }

        /**
     * Check if given file url is a valid file url
     */
    public static function isFileExistsFromUrl(string $fileUrl): bool
    {
        $headers = get_headers($fileUrl);

        $httpResponse = (string) self::getArrayValue(0, $headers);

        return strpos($httpResponse, '200 OK') > 0;
    }

    /**
     * Replace extension of given filename by new extension
     */
    public static function replaceExtension(string $filename, string $newExt): string
    {
        $info = pathinfo($filename);
        return self::getArrayValue('filename', $info) . '.' . $newExt;
    }
}
