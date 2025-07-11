<?php

namespace Framework\Templating;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template {
    private static $twig = null;

    private static function getTwig() {
        if (self::$twig === null) {
            $loader = new FilesystemLoader(__DIR__ . '/../../App/Views');
            self::$twig = new Environment($loader);
        }
        return self::$twig;
    }

    public static function render($template, $data = []) {
        $twig = self::getTwig();
        return $twig->render($template, $data);
    }
}