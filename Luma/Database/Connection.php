<?php
namespace Luma\Database;

use PDO;
use RuntimeException;

class Connection
{
    private string $host;
    private string $username;
    private string $password;
    private string $database;
    private ?PDO $connection = null;

    /**
     * Constructor to initialize connection properties.
     */
    public function __construct(string $host, string $username, string $password, string $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    /**
     * Establishing connection to the database.
     */
    private function connect(): PDO
    {
        if ($this->connection !== null) {
            return $this->connection;
        }

        try {
            $this->connection = new PDO(
                "{$_ENV['DB_DRIVER']}:host={$this->host};dbname={$this->database}",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (\PDOException $e) {
            throw new RuntimeException("Database connection failed: " . $e->getMessage());
        }

        return $this->connection;
    }

    /**
     * Get the PDO connection instance.
     */
    public function getConnection(): PDO
    {
        return $this->connect();
    }

    /**
     * Creates a table in the database if it does not already exist.
     */
    public function createTable(string $tableName, array $columns): void
    {
        // Basic sanitization - you should validate table/column names more thoroughly
        $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);
        
        $query = "CREATE TABLE IF NOT EXISTS `$tableName` (" . implode(", ", $columns) . ")";
        $this->connect()->exec($query);
    }

    /**
     * Destroys connection to the database.
     */
    public function destroyConnection(): void
    {
        $this->connection = null;
    }
}