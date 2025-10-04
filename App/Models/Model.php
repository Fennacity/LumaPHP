<?php

use Framework\Framework;

class Model implements ModelInterface
{
    protected $database;

    public function __construct()
    {
        $this->database = Framework::getDbConnection();
    }
}