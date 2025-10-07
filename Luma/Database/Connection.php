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
     * Creates a table in the database if it does not already exist.
     *
     * @param string $tableName The name of the table to create.
     * @param array $columns    An array of column definitions, e.g. ["id INT PRIMARY KEY", "name VARCHAR(255)"].
     *
     * This method builds a CREATE TABLE IF NOT EXISTS SQL statement using the provided
     * table name and columns, then executes it using PDO. It outputs a message indicating
     * the table creation attempt.
     */
    public function createTable(string $tableName, array $columns): void
    {
        $query = "CREATE TABLE IF NOT EXISTS $tableName (" . implode(", ", $columns) . ")";

        $db = new \PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
        $db->exec($query);
        $db = null; // Close the connection
       
        echo "Creating table '$tableName' with columns: " . implode(", ", $columns) . "\n";
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