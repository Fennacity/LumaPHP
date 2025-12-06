<?php

namespace Luma\Utilities;

class Utilities
{
    /**
     * Gets the name of the current file without the extension and "Controller" suffix.
     *
     * @return string The current file name without extension and "Controller" suffix.
     */
    public static function getCurrentControllerName(string $currentFile): string
    {
        return str_replace("Controller", '', basename($currentFile, '.php'));
    }

    /**
     * Converts a string to Title Case.
     *
     * @param string $string The input string.
     * @return string The string converted to Title Case.
     */
    public static function toTitleCase(string $string): string
    {
        return ucwords(strtolower($string));
    }

    /**
     * Converts a string to snake_case.
     *
     * @param string $string The input string.
     * @return string The string converted to snake_case.
     */
    public static function toSnakeCase(string $string): string
    {
        $string = preg_replace('/[^\w]+/', ' ', $string);
        $string = strtolower($string);
        $string = str_replace(' ', '_', trim($string));
        return $string;
    }

    /**
     * Replaces spaces with underscores in a string.
     *
     * @param string $string The input string.
     * @return string The string with spaces replaced by underscores.
     */
    public static function spaceToUnderscore(string $string): string
    {
        return str_replace(' ', '_', $string);
    }

    /**
     * Replaces underscores with spaces in a string.
     *
     * @param string $string The input string.
     * @return string The string with underscores replaced by spaces.
     */
    public static function underscoreToSpace(string $string): string
    {
        return str_replace('_', ' ', $string);
    }
}
