<?php
/**
 * Simple class used to sanitize, filter and cast data
 *
 * @version     1.0.0
 * @link        https://github.com/bayfrontmedia/php-sanitize
 * @license     MIT https://opensource.org/licenses/MIT
 * @copyright   2020 Bayfront Media https://www.bayfrontmedia.com
 * @author      John Robinson <john@bayfrontmedia.com>
 */

namespace Bayfront\Sanitize;

class Sanitize
{

    /**
     * Ensures a given variable will be returned as a specific type.
     * Defaults to "string"
     *
     * @param mixed $var
     * @param string $type (Types include: int, float, bool, object, array, string)
     *
     * @return mixed
     */

    public static function cast($var, string $type = 'string')
    {

        switch ($type) {

            case 'int':

                return (int)$var;

            case 'float':

                return (float)$var;

            case 'bool':

                return (bool)$var;

            case 'object':

                return (object)$var;

            case 'array':

                return (array)$var;

            default: // string

                return (string)$var;
        }

    }

    /**
     * Filters string for valid email characters
     *
     * @param string $email
     *
     * @return string
     */

    public static function email(string $email): string
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Filters string for valid URL characters
     *
     * @param string $url
     *
     * @return string
     */

    public static function url(string $url): string
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * Filters string for valid path syntax, with optional trailing slash
     *
     * @param string $path
     * @param bool $trailing (Require trailing slash)
     *
     * @return string
     */

    public static function path(string $path, bool $trailing = true): string
    {

        // Remove whitespace, spaces, leading and trailing slashes

        $path = preg_replace('/\s+/', '', $path);

        $path = trim($path, '/');

        // Convert all invalid slashes to one single forward slash

        $replacements = [
            '//' => '/',
            '\\' => '/',
            '\\\\' => '/'
        ];

        $path = strtr($path, $replacements);

        if (true === $trailing) {

            return $path . '/';

        }

        return $path;

    }

    /**
     * Escape string
     *
     * @param string $string
     * @param string $encoding
     *
     * @return string
     */

    private static function _escapeString(string $string, string $encoding): string
    {
        return htmlspecialchars($string, ENT_QUOTES, $encoding);
    }

    /**
     * Escape recursively
     *
     * @param $value
     *
     * @return void (recursive)
     */

    private static function _escapeRecursive(&$value)
    { // & to pass by reference
        $value = htmlspecialchars($value, ENT_QUOTES, self::$encoding);
    }

    // Encoding method used when escaping recursively

    private static $encoding;

    /**
     * Escape strings and arrays. Other data types return their original value.
     *
     * @param mixed $value
     * @param string $encoding
     *
     * @return mixed
     */

    public static function escape($value, string $encoding = 'UTF-8')
    {
        if (is_string($value)) {

            return self::_escapeString($value, $encoding);

        } else if (is_array($value)) {

            self::$encoding = $encoding;

            /** @uses _escapeRecursive */

            array_walk_recursive($value, 'self::_escapeRecursive');

            return $value;

        }

        return $value; // Do nothing, return original

    }

}