<?php

namespace App\Entity\Media;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\MediaRepositories\MediaImageRepository;
use Doctrine\ORM\Mapping as ORM;
use GdImage;
#[ApiResource]
#[ORM\Entity(repositoryClass: MediaImageRepository::class)]
#[ORM\Table(name: "media_image")]
class MediaImage extends Media
{
    const DEFAULT_IMAGE_QUALITY_COMPRESSION = 60;
    const DEFAULT_MAX_IMAGE_WIDTH = 1200;
    const DEFAULT_MIN_IMAGE_QUALITY = 40;
    const DEFAULT_WP_IMAGE_EDITOR_WIDTH = 1200;
    const MAX_IMAGE_FILE_SIZE = 307200;
    // 307 200 octets = 300 Kio (for Windows)
    public function __construct()
    {
        parent::__construct();
    }
    public function getType() : string
    {
        return self::TYPE_IMAGE;
    }
    /**
     * MediaImage Width in pixels
     *
     */
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $width = null;
    /**
     * MediaImage Height in pixels
     *
     */
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $height = null;
    /**
     * Contains  title to display under image zoomed
     *
     */
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $title = null;
    #[ORM\Column(type: "string", nullable: true)]
    private ?string $alt = null;
    /**
     * Set MediaImage Dimensions informations (width and height)
     *
     * @return self
     */
    public function setDimensions()
    {
        // $fileLocation = ($this->hasPath() ? $this->getPath() : $this->getSrc());
        // if ($fileLocation) {
        //     list($width, $height, $type, $attr) = getimagesize($fileLocation);
        //     $this->setWidth($width);
        //     $this->setHeight($height);
        //     $this->setFileType($type);
        // }
        return $this;
    }
    /**
     * Get image width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }
    /**
     * Set image width
     *
     * @param int|null $width MediaImage width
     *
     * @return self
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }
    /**
     * Check if MediaImage has width
     *
     * @return bool
     */
    public function hasWidth()
    {
        $width = $this->getWidth();
        return is_int($width) && $width > 0;
    }
    /**
     * Get image height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }
    /**
     * Set image height
     *
     * @param int|null $height MediaImage height
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }
    /**
     * Check if MediaImage has height
     *
     * @return bool
     */
    public function hasHeight()
    {
        $height = $this->getHeight();
        return is_int($height) && $height > 0;
    }
    /**
     * Get image alt attribute
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    /**
     * Set image alt attribute
     *
     * @param string|null $alt MediaImage alt attribute
     *
     * @return self
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
        return $this;
    }
    /**
     * Check if MediaImage has alt attribute
     *
     * @return bool
     */
    public function hasAlt()
    {
        $alt = $this->getAlt();
        return is_string($alt) && strlen($alt) > 0;
    }
    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set the value of Title
     *
     * @param string $title Title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Check if MediaImage has a valid title
     *
     * @return boolean
     */
    public function hasTitle()
    {
        $title = $this->getTitle();
        return is_string($title) && strlen($title) > 0;
    }
    /**
     * Resize MediaImage
     *
     * @param int $width
     * @param int $height
     * @param boolean $keepOriginal
     *
     * @return self
     */
    public function resize($width = null, $height = null, $keepOriginal = false)
    {
        // if (!$this->isFileExists()) {
        //     return false;
        // }
        // $this->setEditor();
        // if ($this->hasEditor()) {
        //     $editor = $this->getEditor();
        //     // If given width is the same as default WP Editor MediaImage width (1200px), don't resize because
        //     // WP MediaImage Editor resize automatically on this width and cause $result error (stupid...)
        //     if (self::DEFAULT_WP_IMAGE_EDITOR_WIDTH !== $width) {
        //         $result = $editor->resize($width, $height, false);
        //         if (!is_wp_error($result)) {
        //             $filePath = $this->getPath();
        //             if ($keepOriginal) {
        //                 $filePath = $editor->generate_filename();
        //             }
        //             $editor->save($filePath);
        //         } else {
        //             // Handle the problem however you deem necessary.
        //         }
        //     }
        //     $this->setPath($filePath);
        //     $this->setDimensions();
        // }
        return $this;
    }
    /**
     * Compress MediaImage
     *
     * @param int $quality
     *
     * @return self
     */
    public function compress($quality = self::DEFAULT_MIN_IMAGE_QUALITY)
    {
        // if (!$this->isFileExists()) {
        //     return false;
        // }
        // $this->setEditor();
        // if ($this->hasEditor()) {
        //     $editor = $this->getEditor();
        //     $result = $editor->set_quality($quality);
        //     if (!is_wp_error($result)) {
        //         $result = $editor->save($editor->generate_filename());
        //     } else {
        //         // Handle the problem however you deem necessary.
        //     }
        // }
        return $this;
    }
    /**
     * Convert file to Webp
     *
     * @return self
     */
    public function convertToWebp()
    {
        // if (!$this->isFileExists()) {
        //     return false;
        // }
        // $image = $this->imageCreateFromAny($this->getSrc());
        // $uploadsPath = Utils::getArrayValue('path', wp_upload_dir());
        // if (false !== $image && is_string($uploadsPath) && strlen($uploadsPath) > 0) {
        //     $newFileName = Utils::replaceExtension($this->getSrc(), 'webp');
        //     $filePath = $uploadsPath . '/' . $newFileName;
        //     imagewebp($image, $filePath);
        //     $this->setSrc($filePath);
        //     imagedestroy($image);
        // }
        return $this;
    }
    /**
     * Optimize image with resizing and compressing
     *
     * @param int $width
     * @param int $maxFileSize
     * @param int $minQuality
     *
     * @return self
     */
    public function optimize($width = self::DEFAULT_MAX_IMAGE_WIDTH, $maxFileSize = self::MAX_IMAGE_FILE_SIZE, $minQuality = self::DEFAULT_MIN_IMAGE_QUALITY)
    {
        // $this->setFileSize(true);
        // $quality = 80;
        // $last = false;
        // $this->resize($width);
        // while ($this->getFileSize() > $maxFileSize) {
        //     $this->compress($quality);
        //     $this->setFileSize(true);
        //     if ($last) {
        //         break;
        //     }
        //     $quality = $quality - 10;
        //     if ($quality <= $minQuality) {
        //         $quality = $minQuality;
        //         $last = true;
        //     }
        // }
        return $this;
    }
    /**
     * Get image resoure from GIF, JP(E)G, PNG or BMP image file
     *
     * @param string $filepath
     *
     * @return resource
     */
    function imageCreateFromAny($filepath) : false|GdImage
    {
        $type = exif_imagetype($filepath);
        $allowedTypes = array(
            1,
            // [] gif
            2,
            // [] jpg
            3,
            // [] png
            6,
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        $im = false;
        switch ($type) {
            case 1:
                $im = imageCreateFromGif($filepath);
                break;
            case 2:
                $im = imageCreateFromJpeg($filepath);
                break;
            case 3:
                $im = imageCreateFromPng($filepath);
                break;
            case 6:
                $im = imageCreateFromBmp($filepath);
                break;
        }
        return $im;
    }
}
