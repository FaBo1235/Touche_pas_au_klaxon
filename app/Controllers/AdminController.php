<?php require_once '../app/Models/User.php';
class AdminController
{
    public function users()
    {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        require __DIR__ . '/../Views/admin_user.php';
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
    public function agencies()
    {
        $agencyModel = new Agency();
        $agencies = $agencyModel->getAll();
        require '../app/Views/admin_agencies.php';
    }
    public function createAgency()
    {
        if ($_POST['city']) {
            $agencyModel = new Agency();
            $agencyModel->create($_POST['city']);
        }
        header('Location: ?url=admin-agencies');
    }
    public function deleteAgency()
    {
        $agencyModel = new Agency();
        $agencyModel->delete($_POST['agency_id']);
        header('Location: ?url=admin-agencies');
    }
}
