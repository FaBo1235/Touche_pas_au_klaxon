<?php

class Trip
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAvailableTrips($search = null, $userId = null)
    {
        $sql = "
        SELECT 
            t.id,
            t.departure_datetime,
            t.arrival_datetime,
            t.available_seats,
            t.available_seats AS total_seats,
            a1.city AS departure_city,
            a2.city AS arrival_city,
            u.firstname,
            u.lastname,
            u.email,
            u.phone,
            CASE WHEN r.id IS NOT NULL THEN 1 ELSE 0 END AS is_reserved
        FROM trips t
        JOIN agencies a1 ON t.departure_agency_id = a1.id
        JOIN agencies a2 ON t.arrival_agency_id = a2.id
        LEFT JOIN users u ON t.driver_id = u.id
        LEFT JOIN reservations r 
            ON r.trip_id = t.id AND r.user_id = ?

    ";

        if ($search) {
            $sql .= " WHERE a1.city LIKE ?";
        }

        $sql .= " ORDER BY t.departure_datetime ASC";

        $stmt = $this->pdo->prepare($sql);

        if ($search) {
            $stmt->execute([$userId, "%$search%"]);
        } else {
            $stmt->execute([$userId]);
        }

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
            u.lastname,
            u.email,
            u.phone
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
