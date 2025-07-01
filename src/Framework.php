<?php

use Database\Connection;
use Routing\Routes;

class Framework
{
    private $dbConnection;

    public function run()
    {
        $this->dbConnection = new Connection('localhost', 'root', '', 'framework_db');
        echo "Application is running...\n";
    }
}