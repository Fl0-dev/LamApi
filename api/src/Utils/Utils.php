<?php

namespace App\Utils;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class contains usefull functions
 */
class Utils
{
    /**
     * Get Host URL
     */
    public static function getHost(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    }

    /**
     * Get current URL
     */
    public static function getCurrentUrl(): string
    {
        return self::getHost() . $_SERVER['REQUEST_URI'];
    }

    /**
     * Check if $url is a valid URL
     */
    public static function isUrl(string $url): bool
    {
        if (!(strlen($url) > 0)) {
            return false;
        }

        // To allow URLs with accent
        $path = parse_url($url, PHP_URL_PATH);
        $encoded_path = array_map('urlencode', explode('/', $path));
        $url = str_replace($path, implode('/', $encoded_path), $url);

        return filter_var($url, FILTER_VALIDATE_URL) > -1;
    }

    /**
     * Check if $email is a valid Email Address
     */
    public static function isEmail(string $email): bool
    {
        return (is_string($email) && strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    /**
     * Check given color is a valid hexadecimal color value
     */
    public static function isHexColor(string $color): bool
    {
        return is_string($color)
            && preg_match('/^#([0-9A-F]{3}){1,2}$/i', $color)
            && Constants::LAMACOMPTA_PRIMARY_COLOR !== $color;
    }

    /**
     * Get property object without error
     */
    public static function getProp(string $prop, object $object): mixed
    {
        if (is_object($object) && property_exists($object, $prop)) {
            return $object->{$prop};
        }

        return null;
    }

    /**
     * Get value in an array without error
     */
    public static function getArrayValue(string|int $key, array $array): mixed
    {
        if (is_int($key) || is_string($key)) {
            if (is_array($array) && array_key_exists($key, $array)) {
                return $array[$key];
            }
        }

        return null;
    }

    /**
     * Get key from given value in the given array without error
     */
    public static function getArrayKeyFromValue(mixed $value, array $array): mixed
    {
        if (!empty($value)) {
            if (is_array($array)) {
                return array_search($value, $array);
            }
        }

        return null;
    }

    /**
     * Get date in string with given format
     */
    public static function getDateTimeFormatted(mixed $date, string $format = 'Y-m-d H:i:s'): mixed
    {
        if ($date instanceof \DateTime) {
            return $date->format($format);
        }

        return $date;
    }

    /**
     * Create DateTime from given string
     */
    public static function createDateTimeFromString(string $string): \DateTime|false
    {
        if (false !== strtotime($string)) {
            return new \DateTime($string);
        }

        return false;
    }

    /**
     * Check if all array values are instance of given expected object
     */
    public static function checkArrayValuesObject(array|ArrayCollection $array, string $expectedClass): bool
    {
        if ($array instanceof ArrayCollection) {
            $array = $array->toArray();
        }

        foreach ($array as $value) {
            if (!($value instanceof $expectedClass)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get values of given column, like array_column() PHP function but with save original key
     */
    public static function arrayColumnWithKeys(array $array, string $column): array
    {
        $result = [];

        if (is_array($array)) {
            foreach ($array as $key => $item) {
                if (array_key_exists($column, $item)) {
                    $result[$key] = $item[$column];
                }
            }
        }

        return $result;
    }

    /**
     * Create an array collection with given $array
     */
    public static function createArrayCollection(mixed $array): ArrayCollection
    {
        if ($array instanceof ArrayCollection) {
            return $array;
        }

        return (is_array($array) ?
            new ArrayCollection($array)
            : new ArrayCollection());
    }

    /**
     * Convert array to a string list
     */
    public static function tabToListString(array $tab): string
    {
        $result = '';
        $comma = '';

        foreach ($tab as $item) {
            $result .= $comma . $item;
            $comma = ',';
        }

        return $result;
    }

    /**
     * Convert all <br> to \r\n
     */
    public static function br2nl(string $string): string
    {
        $breaks = array('<br />', '<br>', '<br/>');

        return str_ireplace($breaks, '\n', $string);
    }

    /**
     * Search and replace the first occurence in string of the given $search by the $replace value
     */
    public static function strReplaceFirstOccurence(string $subject, string $search, string $replace): string
    {
        $pos = strpos($subject, $search);

        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }

    /**
     * Do PHP array_search without case sensitive
     */
    public static function arraySearchInsensitive(string $search, array $array): bool
    {
        if (is_array($array)) {
            return array_search(strtolower($search), array_map('strtolower', $array));
        }

        return false;
    }

    /**
     * Get given URL with http:// if no exists
     */
    public static function addHttp(string $url): string
    {
        if (!is_string($url) || !strlen($url) > 1) {
            return false;
        }

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = str_replace('//', '', $url);

            return "http://$url";
        }

        return $url;
    }

    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     *
     * This function uses type hints now (PHP 7+ only), but it was originally
     * written for PHP 5 as well.
     *
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     *
     * @param int    $length   How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     */
    public static function generateRandomString(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }

        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
