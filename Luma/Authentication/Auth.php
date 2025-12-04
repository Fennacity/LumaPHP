<?php

namespace Luma\Authentication;

use Luma\Database\Connection;

class Auth
{
    private Connection $connection;
    private \PDO $db;

    /**
     * Auth constructor.
     * @param Connection $connection The database connection instance.
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->db = $connection->getConnection();
    }

    /**
     * Registers a new user with a username, password, and optional additional info.
     *
     * @param string $username The username to register
     * @param string $password The plain-text password
     * @param array|null $userInfo Optional associative array with additional user info
     * @return string          Success message
     * @throws \Exception      If the user already exists
     */
    public function register(string $username, string $password, array $userInfo = []): string
    {
        // Ensure the users table exists
        $standardColumns = [
            "id INT AUTO_INCREMENT PRIMARY KEY",
            "username VARCHAR(255) NOT NULL UNIQUE",
            "password VARCHAR(255) NOT NULL",
            "email VARCHAR(255)",
            "fullname VARCHAR(255)",
            "address VARCHAR(255)",
            "phone VARCHAR(50)"
        ];

        $this->connection->createTable('users', !empty($userInfo) ? $userInfo : $standardColumns);

        // Check if the username is already taken
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        if ($stmt->fetchColumn() > 0) {
            throw new \Exception("User already exists.");
        }

        // Prepare insert statement with dynamic columns
        $fields = ['username', 'password'];
        $params = [
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_BCRYPT)
        ];

        if (is_array($userInfo) && !empty($userInfo)) {
            foreach ($userInfo as $key => $value) {
                if (in_array($key, ['email', 'fullname', 'address', 'phone'])) {
                    $fields[] = $key;
                    $params[":$key"] = $value;
                }
            }
        }

        $fieldsSql = implode(', ', $fields);
        $placeholders = implode(', ', array_keys($params));
        $sql = "INSERT INTO users ($fieldsSql) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return "User registered successfully.";
    }

    /**
     * Attempts to log in a user with the given credentials.
     *
     * @param string $username The username
     * @param string $password The plain-text password
     * @return string          Success message
     * @throws \Exception      If authentication fails
     */
    public function login(string $username, string $password): string
    {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $hash = $stmt->fetchColumn();

        if (!$hash || !password_verify($password, $hash)) {
            throw new \Exception("Invalid username or password.");
        }
        return "Login successful.";
    }
}