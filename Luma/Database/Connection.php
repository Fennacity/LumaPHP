<?php

namespace Luma\Database;

class Connection
{
    // Database connection properties
    private $host;
    private $username;
    private $password;
    private $database;

    /**
     * Constructor to initialize connection properties.
     *
     * @param string $host     The database host
     * @param string $username The database username
     * @param string $password The database password
     * @param string $database The database name
     */
    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    /**
     * Simulates connecting to the database.
     * In a real implementation, this would establish a DB connection.
     */
    public function connect(): void
    {
        echo "Connecting to database at {$this->host}...\n";
    }
}