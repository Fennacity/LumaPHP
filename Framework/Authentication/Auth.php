<?php

namespace Framework\Authentication;

class Auth
{
    private $users = [];

    public function register(string $username, string $password): string
    {
        if (isset($this->users[$username])) {
            throw new \Exception("User already exists.");
        }
        $this->users[$username] = password_hash($password, PASSWORD_BCRYPT);
        return "User registered successfully.";
    }

    public function login(string $username, string $password): string
    {
        if (!isset($this->users[$username]) || !password_verify($password, $this->users[$username])) {
            throw new \Exception("Invalid username or password.");
        }
        return "Login successful.";
    }
}