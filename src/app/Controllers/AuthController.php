<?php

namespace App\Controllers;

use App\Classes\User;
use App\Classes\View;

class AuthController {
    private User $user;

    public function __construct() {
        $this->user = new User();
    }

    public function showLogin(): void {
        View::render('auth/login');
    }

    public function login(): void {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $user = $this->user->login($email, $password);
            
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: /Dev25Expenies/public/');
                exit;
            }

            View::render('auth/login', ['error' => 'Invalid credentials']);
        } catch (\Exception $e) {
            View::render('auth/login', ['error' => $e->getMessage()]);
        }
    }

    public function showRegister(): void {
        View::render('auth/register');
    }

    public function register(): void {
        try {
            $userData = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phone' => $_POST['phone'] ?? null
            ];

            if ($this->user->register($userData)) {
                header('Location: /Dev25Expenies/public/login');
                exit;
            }

            View::render('auth/register', ['error' => 'Registration failed']);
        } catch (\Exception $e) {
            View::render('auth/register', ['error' => $e->getMessage()]);
        }
    }

    public function logout(): void {
        session_destroy();
        header('Location: /Dev25Expenies/public/login');
        exit;
    }
}
