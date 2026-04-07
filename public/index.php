

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../app/Controllers/HomeController.php';
require_once '../app/Controllers/AuthController.php';
require_once '../app/Controllers/TripController.php';
require_once '../app/Controllers/AdminController.php'; // ✅ AJOUT

$url = $_GET['url'] ?? 'home';

if ($url === 'login') {

    $controller = new AuthController();
    $controller->loginForm();
} elseif ($url === 'do-login') {

    $controller = new AuthController();
    $controller->login();
} elseif ($url === 'logout') {

    $controller = new AuthController();
    $controller->logout();
} elseif ($url === 'create-trip') {

    $controller = new TripController();
    $controller->create();
} elseif ($url === 'store-trip') {

    $controller = new TripController();
    $controller->store();
} elseif ($url === 'reserve') {

    $controller = new TripController();
    $controller->reserve();
} elseif ($url === 'my-reservations') {

    $controller = new TripController();
    $controller->myReservations();
} elseif ($url === 'cancel-reservation') {

    $controller = new TripController();
    $controller->cancelReservation();
} elseif ($url === 'admin') {

    $controller = new HomeController();
    $controller->admin();
} elseif ($url === 'delete-trip') {

    $controller = new TripController();
    $controller->deleteTrip();
} elseif ($url === 'admin_user') {

    $controller = new AdminController();
    $controller->users();
} elseif ($url === 'delete-user') {

    $controller = new AdminController();
    $controller->deleteUser();
} else {

    $controller = new HomeController();
    $controller->index();
}
