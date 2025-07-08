<?php

namespace App;

use Framework\Framework;

class App
{
    public function __construct(Framework $framework)
    {
        $framework->run();
    }
}