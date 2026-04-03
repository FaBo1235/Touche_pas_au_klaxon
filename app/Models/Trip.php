<?php

class Trip
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAvailableTrips()
    {
        $sql = "
        SELECT
            t.id,
            t.departure_datetime,
            t.arrival_datetime,
            t.available_seats,
            a1.city AS departure_city,
            a2.city AS arrival_city,
            u.firstname,
            u.lastname
        FROM trips t
        JOIN agencies a1 ON t.departure_agency_id = a1.id
        JOIN agencies a2 ON t.arrival_agency_id = a2.id
        LEFT JOIN users u ON t.driver_id = u.id
        ORDER BY t.departure_datetime ASC
    ";

        $stmt = $this->pdo->query($sql);
        

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserReservations($userId)
    {
        $sql = "
        SELECT
            r.id AS reservation_id,
            t.id AS trip_id,
            t.departure_datetime,
            t.arrival_datetime,
            a1.city AS departure_city,
            a2.city AS arrival_city,
            u.firstname,
            u.lastname
        FROM reservations r
        JOIN trips t ON r.trip_id = t.id
        JOIN agencies a1 ON t.departure_agency_id = a1.id
        JOIN agencies a2 ON t.arrival_agency_id = a2.id
        LEFT JOIN users u ON t.driver_id = u.id
        WHERE r.user_id = ?
        ORDER BY t.departure_datetime ASC
    ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
