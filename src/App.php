<?php

class App
{
    public function __construct(Framework $framework)
    {
        $framework->run();
    }
}