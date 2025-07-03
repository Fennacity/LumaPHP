<?php

namespace App\Framework;

use App\Framework\Database\Connection;
use App\Framework\Routing\Routes;
use App\Framework\Authentication\Auth;

class Framework
{
    private $dbConnection;

    public function run()
    {
        $this->dbConnection = new Connection('localhost', 'root', '', 'framework_db');
        echo "Application is running...\n";
    }
}