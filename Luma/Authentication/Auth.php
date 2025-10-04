<?php

namespace Luma\Authentication;

class Auth
{
    // Stores registered users as username => hashed password
    private $users = [];

    /**
     * Registers a new user with a username and password.
     *
     * @param string $username The username to register
     * @param string $password The plain-text password
     * @return string          Success message
     * @throws \Exception      If the user already exists
     */
    public function register(string $username, string $password): string
    {
        // Check if the username is already taken
        if (isset($this->users[$username])) {
            throw new \Exception("User already exists.");
        }
        // Hash the password and store the user
        $this->users[$username] = password_hash($password, PASSWORD_BCRYPT);
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
        // Check if the user exists and the password is correct
        if (!isset($this->users[$username]) || !password_verify($password, $this->users[$username])) {
            throw new \Exception("Invalid username or password.");
        }
        return "Login successful.";
    }
}