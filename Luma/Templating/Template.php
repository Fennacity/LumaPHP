<?php
namespace Luma\Templating;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template
{
    private static $twig = null;
    private static $routes = null;

    /**
     * Returns the Twig Environment instance, creating it if necessary.
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
        
        // Add routes as a global variable if they're set
        if (self::$routes !== null) {
            self::$twig->addGlobal('routes', self::$routes);
        }
        
        return self::$twig;
    }

    /**
     * Renders a Twig template with the given data.
     */
    public static function render(string $template, array $data = []): string
    {
        $twig = self::getTwig();
        return $twig->render($template, $data);
    }

    /**
     * Adds routes to be accessible in Twig templates.
     */
    public static function addRoutesToTemplate(?array $routes): void
    {
        self::$routes = $routes;
    }
}