<?php

require_once '../config/database.php';
require_once '../app/Models/Trip.php';

class HomeController
{
    public function index()
    {
        global $pdo;

        $tripModel = new Trip($pdo);

        $search = $_GET['search'] ?? null;

        $userId = $_SESSION['user']['id'] ?? null;

        $trips = $tripModel->getAvailableTrips($_GET['search'] ?? null, $userId);



        require '../app/Views/home.php';
    }

    public function admin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ADMIN') {
            header("Location: ?url=home");
            exit;
        }

        global $pdo;

        $tripModel = new Trip($pdo);
        $trips = $tripModel->getAvailableTrips();

        require '../app/Views/admin.php';
    }
}
