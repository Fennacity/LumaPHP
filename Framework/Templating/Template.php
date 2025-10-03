<?php

namespace Framework\Templating;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template
{
    private static $twig = null;

    private static function getTwig(): Environment
    {
        if (self::$twig === null) {
            $loader = new FilesystemLoader([
                __DIR__ . '/../../App/Views/Pages',
                __DIR__ . '/../../App/Views/Components',
            ]);
            self::$twig = new Environment($loader);
        }
        return self::$twig;
    }

    public static function render(string $template, array $data = []): string
    {
        $twig = self::getTwig();
        return $twig->render($template, $data);
    }
}
