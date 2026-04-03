<?php

require_once '../config/database.php';
require_once '../app/Models/User.php';

class AuthController
{
    public function loginForm()
    {
        require '../app/Views/login.php';
    }

    public function login()
    {
        global $pdo;

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new User($pdo);
        $user = $userModel->findByEmail($email);

        if ($user && $user['password'] === $password) {

            $_SESSION['user'] = $user;

            header("Location: /klaxon/public");
            exit;
        }

        echo "Email ou mot de passe incorrect";
    }

    public function logout()
    {
        session_destroy();

        header("Location: /klaxon/public");
        exit;
    }
}
