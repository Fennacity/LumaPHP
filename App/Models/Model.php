<?php

use Framework\Framework;

class Model implements ModelInterface
{
    protected $db;

    public function __construct(Framework $framework)
    {
        $this->db = $framework->getDbConnection();
    }
}