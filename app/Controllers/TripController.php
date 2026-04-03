<?php

require_once '../config/database.php';
require_once '../app/Models/Agency.php';
require_once '../app/Models/Trip.php';

class TripController
{
    public function create()
    {
        global $pdo;

        if (!isset($_SESSION['user'])) {
            header("Location: ?url=login");
            exit;
        }

        $agencyModel = new Agency($pdo);
        $agencies = $agencyModel->getAll();

        if ($_SESSION['user']['role'] !== 'ADMIN') {
            echo "Accès refusé";
            exit;
        }

        require '../app/Views/create_trip.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?url=login");
            exit;
        }

        global $pdo;

        $userId = $_SESSION['user']['id'];

        $stmt = $pdo->prepare("
            INSERT INTO trips 
            (departure_agency_id, arrival_agency_id, departure_datetime, arrival_datetime, available_seats, driver_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $_POST['departure_agency_id'],
            $_POST['arrival_agency_id'],
            $_POST['departure_datetime'],
            $_POST['arrival_datetime'],
            $_POST['available_seats'],
            $userId
        ]);

        header("Location: /klaxon/public");
        exit;
    }

    public function reserve()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?url=login");
            exit;
        }

        global $pdo;

        $userId = $_SESSION['user']['id'];
        $tripId = $_POST['trip_id'];

        $stmt = $pdo->prepare("
        SELECT * FROM reservations 
        WHERE user_id = ? AND trip_id = ?
        ");

        $stmt->execute([$userId, $tripId]);

        if ($stmt->fetch()) {
            echo "Ce trajet a déjà été réservé";
            exit;
        }

        $stmt = $pdo->prepare("
        SELECT available_seats FROM trips WHERE id = ?
        ");

        $stmt->execute([$tripId]);
        $trip = $stmt->fetch();

        if ($trip['available_seats'] <= 0) {
            echo "Plus aucune place disponible";
            exit;
        }

        $stmt = $pdo->prepare("
            INSERT INTO reservations (user_id, trip_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$userId, $tripId]);

        
        $stmt = $pdo->prepare("
            UPDATE trips
            SET available_seats = available_seats - 1
            WHERE id = ?
        ");
        $stmt->execute([$tripId]);

        header("Location: ?url=home");
        exit;
    }

    public function myReservations()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?url=login");
            exit;
        }

        global $pdo;

        $userId = $_SESSION['user']['id'];

        $tripModel = new Trip($pdo);
        $reservations = $tripModel->getUserReservations($userId);

        require '../app/Views/my_reservations.php';
    }

    public function cancelReservation()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?url=login");
            exit;
        }

        global $pdo;

        $reservationId = $_POST['reservation_id'];
        $tripId = $_POST['trip_id'];

  
        $stmt = $pdo->prepare("
        DELETE FROM reservations WHERE id = ?
    ");
        $stmt->execute([$reservationId]);

       
        $stmt = $pdo->prepare("
        UPDATE trips
        SET available_seats = available_seats + 1
        WHERE id = ?
    ");
        $stmt->execute([$tripId]);

        header("Location: ?url=my-reservations");
    }

    public function delete()
    {
        global $pdo;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ADMIN') {
            header("Location: ?url=home");
            exit;
        }

        $stmt = $pdo->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->execute([$_POST['trip_id']]);

        header("Location: ?url=admin");
        exit;
    }
}
