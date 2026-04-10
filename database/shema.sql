INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `phone`, `role`) VALUES
(1, 'Jean', 'Dupont', 'jean@entreprise.com', 'test', '0600000000', 'ADMIN');

INSERT INTO `agencies` (`id`, `name`, `city`) VALUES
(1, 'Agence Paris', 'Paris'),
(2, 'Agence Lyon', 'Lyon'),
(5, 'Agence Marseille', 'Marseille'),
(6, 'Agence Lille', 'Lille'),
(7, 'Agence Bordeaux', 'Bordeaux'),
(8, 'Agence Toulouse', 'Toulouse'),
(9, 'Agence Nice', 'Nice'),
(10, 'Agence Nantes', 'Nantes'),
(11, 'Agence Strasbourg', 'Strasbourg'),
(12, 'Agence Montpellier', 'Montpellier');


INSERT INTO `trips` (`id`, `departure_agency_id`, `arrival_agency_id`, `departure_datetime`, `arrival_datetime`, `total_seats`, `available_seats`, `user_id`, `driver_id`) VALUES
(10, 1, 10, '2026-04-05 12:00:00', '2026-04-16 11:00:00', NULL, 3, NULL, 1);


INSERT INTO `reservations` (`id`, `user_id`, `trip_id`, `created_at`) VALUES
(6, 1, 6, '2026-04-03 12:38:03'),
(7, 1, 7, '2026-04-03 12:38:05'),
(11, 1, 9, '2026-04-05 10:16:59'),
(14, 1, 10, '2026-04-07 17:17:10');