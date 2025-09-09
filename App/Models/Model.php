<?php

use Framework\Framework;

class Model 
{
    protected $db;

    public function __construct(Framework $framework)
    {
        $this->db = $framework->getDbConnection();
    }
}