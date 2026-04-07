<?php

require_once __DIR__ . '/../config/database.php';
require_once '../app/Models/User.php';

class AuthController
{
    public function loginForm()
    {
        require '../app/Views/login.php';
    }

    public function login()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && $user['password'] === $password) {

            $_SESSION['user'] = $user;

            header("Location: /klaxon/public");
            exit;
        }

        $_SESSION['error'] = "Email ou mot de passe incorrect";
        $_SESSION['old_email'] = $_POST['email'];
        header('Location: ?url=login');
        exit;

        echo "Email ou mot de passe incorrect";
    }

    public function logout()
    {
        session_destroy();

        header("Location: /klaxon/public");
        exit;
    }
}
