<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<header>
    <a href="?url=home"><img src="images/logo.png" alt="logo de voiture pour le coivoiturage" class="w-32"></a>
</header>

<body>

    <?php if (isset($_SESSION['user'])): ?>

        <p>Bienvenue <?= $_SESSION['user']['firstname'] ?></p>

        <a href="?url=create-trip">Créer un trajet</a>
        <a href="?url=my-reservations">Mes réservations</a>
        <a href="?url=logout">Déconnexion</a>

    <?php else: ?>

        <a href="?url=login">Connexion</a>

    <?php endif; ?>


    <form method="GET" action="">
        <input type="hidden" name="url" value="home">

        <input type="text" name="search" placeholder="Ville de départ">

        <button type="submit">Rechercher</button>
    </form>

    <h2>Liste des trajets</h2>

    <?php if (empty($trips)): ?>
        <p>Aucun trajet disponible</p>
    <?php else: ?>

        <?php foreach ($trips as $trip): ?>

            <div style="border:1px solid black; margin:10px; padding:10px;">

                <p>
                    <strong><?= $trip['departure_city'] ?></strong> →
                    <strong><?= $trip['arrival_city'] ?></strong>
                </p>

                <p>
                    Départ : <?= $trip['departure_datetime'] ?>
                </p>

                <p>
                    Nombres de places : <?= $trip['available_seats'] ?>
                </p>

                <p>
                    Conducteur :
                    <?= $trip['firstname'] ?> <?= $trip['lastname'] ?>
                </p>

                <form method="POST" action="?url=reserve">
                    <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
                    <button type="submit">Réserver</button>
                </form>

                <?php if (isset($_SESSION['user']) && $trip['is_reserved']): ?>

                    <button
                        onclick="toggleDetails(<?= $trip['id'] ?>)"
                        class="mt-2 bg-gray-500 text-white px-3 py-1 rounded">
                        Voir détails
                    </button>

                    <div id="details-<?= $trip['id'] ?>" class="hidden mt-2 bg-gray-100 p-2 rounded">

                        <p>Nom : <?= $trip['firstname'] ?> <?= $trip['lastname'] ?></p>
                        <p>Email : <?= $trip['email'] ?></p>
                        <p>Téléphone : <?= $trip['phone'] ?></p>
                        <p>Places totales : <?= $trip['total_seats'] ?></p>

                    </div>

                <?php endif; ?>



            </div>

        <?php endforeach; ?>

    <?php endif; ?>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'ADMIN'): ?>

        <p>Mode ADMIN activé</p>
        <a href="?url=admin">Panel Admin</a>

    <?php endif; ?>

    <script>
        function toggleDetails(id) {
            const el = document.getElementById("details-" + id);
            el.classList.toggle("hidden");
        }
    </script>

</body>

</html>