<?php

require_once __DIR__ . '/../config/database.php';
class Agency
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getPDO();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM agencies");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($city)
    {
        $stmt = $this->pdo->prepare("INSERT INTO agencies (city) VALUES (?)");
        $stmt->execute([$city]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM agencies WHERE id = ?");
        $stmt->execute([$id]);
    }
}
