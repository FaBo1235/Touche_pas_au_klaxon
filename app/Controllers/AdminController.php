<?php

require_once '../app/Models/User.php'; 

class AdminController
{
    public function users()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();

        require '../app/Views/admin_users.php';
    }

    public function deleteUser()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ADMIN') {
            die("Accès refusé");
        }

        if (isset($_POST['user_id'])) {
            $userModel = new User();
            $userModel->deleteUser($_POST['user_id']);
        }

        header('Location: ?url=admin-users');
        exit; 
    }
}
