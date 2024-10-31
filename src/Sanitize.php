<?php /** @noinspection PhpUnused */

namespace Bayfront\Sanitize;

class Sanitize
{

    /*
     * Cast type constants
     */

    public const CAST_ARRAY = 'array';
    public const CAST_BOOL = 'bool';
    public const CAST_FLOAT = 'float';
    public const CAST_INT = 'int';
    public const CAST_OBJECT = 'object';
    public const CAST_STRING = 'string';

    /**
     * Ensures a given variable will be returned as a specific type.
     * Defaults to "string"
     *
     * @param mixed $var
     * @param string $type (Any CAST_* constant)
     * @return mixed
     */
    public static function cast(mixed $var, string $type = self::CAST_STRING): mixed
    {

        return match ($type) {
            'array' => (array)$var,
            'bool' => (bool)$var,
            'float' => (float)$var,
            'int' => (int)$var,
            'object' => (object)$var,
            default => (string)$var,
        };

    }

    /**
     * Filters string for valid email characters.
     *
     * @param string $email
     * @return string
     */
    public static function email(string $email): string
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Filters string for valid URL characters.
     *
     * @param string $url
     * @return string
     */
    public static function url(string $url): string
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * Filters string for valid path syntax, with optional trailing slash.
     *
     * @param string $path
     * @param bool $trailing (Require trailing slash)
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
     * Escape string.
     *
     * @param string $string
     * @param string $encoding
     * @return string
     */
    private static function _escapeString(string $string, string $encoding): string
    {
        return htmlspecialchars($string, ENT_QUOTES, $encoding);
    }

    /**
     * Escape recursively.
     *
     * @param $value
     * @return void (recursive)
     */
    private static function _escapeRecursive(&$value): void
    { // & to pass by reference
        $value = htmlspecialchars($value, ENT_QUOTES, self::$encoding);
    }

    // Encoding method used when escaping recursively

    private static mixed $encoding;

    /**
     * Escape strings and arrays. Other data types return their original value.
     *
     * @param mixed $value
     * @param string $encoding
     * @return mixed
     */
    public static function escape(mixed $value, string $encoding = 'UTF-8'): mixed
    {
        if (is_string($value)) {

            return self::_escapeString($value, $encoding);

        } else if (is_array($value)) {

            self::$encoding = $encoding;

            array_walk_recursive($value, [self::class, '_escapeRecursive']);

            return $value;

        }

        return $value; // Do nothing, return original

    }

}