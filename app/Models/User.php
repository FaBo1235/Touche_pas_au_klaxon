<?php

require_once __DIR__ . '/../config/database.php';
class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getPDO();
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, firstname, lastname, email, role FROM users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
