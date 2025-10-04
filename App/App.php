<?php

namespace App;

use Luma\Framework;

class App
{
    public function __construct(Framework $framework)
    {
        $framework->run();
        $this->initializeRoutes();
    }

    public function initializeRoutes(): void
    {
        // Load routes from the routes file
        require_once __DIR__ . '/routes.php';
    }
}