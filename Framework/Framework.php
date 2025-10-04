<?php

namespace Framework;

use Framework\Database\Connection;

class Framework
{
    // Holds the database connection instance
    private $dbConnection;

    /**
     * Returns the current database connection instance.
     *
     * @return Connection|null
     */
    public static function getDbConnection()
    {
        return self::$dbConnection;
    }

    /**
     * Initializes the framework.
     * Establishes a database connection using environment variables.
     */
    public function run(): void
    {
        // Create a new database connection using credentials from .env
        $this->dbConnection = new Connection(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']
        );
    }
}
