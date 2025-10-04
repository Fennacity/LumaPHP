<?php

namespace Luma\Templating;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template
{
    // Holds the singleton Twig environment instance
    private static $twig = null;

    /**
     * Returns the Twig Environment instance, creating it if necessary.
     * Configures the template loader with Pages and Components directories.
     * Adds 'base_path' as a global variable for all templates.
     */
    private static function getTwig(): Environment
    {
        // Initialize Twig only once (singleton pattern)
        if (self::$twig === null) {
            // Set up Twig to load templates from Pages and Components directories
            $loader = new FilesystemLoader([
                __DIR__ . '/../../App/Views/Pages',
                __DIR__ . '/../../App/Views/Components',
            ]);
            self::$twig = new Environment($loader);
        }

        // Add 'base_path' global variable for use in all Twig templates
        self::$twig->addGlobal('base_path', '/' . $_ENV['BASE_PATH']);

        return self::$twig;
    }

    /**
     * Renders a Twig template with the given data.
     *
     * @param string $template The template filename (relative to the loader paths)
     * @param array $data      Data to pass to the template
     * @return string          Rendered HTML
     */
    public static function render(string $template, array $data = []): string
    {
        $twig = self::getTwig();
        return $twig->render($template, $data);
    }
}