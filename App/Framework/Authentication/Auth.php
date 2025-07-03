<?php

namespace App\Framework\Authentication;

class Auth
{
    private $users = [];

    public function register($username, $password)
    {
        if (isset($this->users[$username])) {
            throw new \Exception("User already exists.");
        }
        $this->users[$username] = password_hash($password, PASSWORD_BCRYPT);
        return "User registered successfully.";
    }

    public function login($username, $password)
    {
        if (!isset($this->users[$username]) || !password_verify($password, $this->users[$username])) {
            throw new \Exception("Invalid username or password.");
        }
        return "Login successful.";
    }
}