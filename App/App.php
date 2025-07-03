<?php

namespace App;

use App\Framework\Framework;

class App
{
    public function __construct(Framework $framework)
    {
        $framework->run();
    }
}