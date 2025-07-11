<?php

namespace Framework;

use Framework\Database\Connection;
use Dotenv\Dotenv;

class Framework
{
    private $dbConnection;

    private function loadEnvironmentVariables()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    public function run()
    {
        $this->loadEnvironmentVariables();
        $this->dbConnection = new Connection($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
    }
}