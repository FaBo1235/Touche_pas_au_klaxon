<?php

require_once '../config/database.php';
require_once '../app/Models/Trip.php';

class HomeController
{
    public function index()
    {
        global $pdo;

        $tripModel = new Trip($pdo);

        $trips = $tripModel->getAvailableTrips();

        require '../app/Views/home.php';
    }
}
