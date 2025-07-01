<?php

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . "/src/";
    $framework_dir = $base_dir . "Framework/";

    $appBase = $base_dir . str_replace("\\", "/", $class) . ".php";
    $frameworkBase = $framework_dir . str_replace("\\", "/", $class) . ".php";

    if (file_exists($appBase)) {
        require $appBase;
    } elseif (file_exists($frameworkBase)) {
        require $frameworkBase;
    } else {
        throw new Exception("Class $class not found.");
    }
});

$app = new App(new Framework);