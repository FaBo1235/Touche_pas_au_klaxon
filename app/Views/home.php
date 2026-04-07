<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="flex flex-col min-h-screen">

    <?php include 'partials/header.php' ?>

    <main class="flex-grow max-w-4xl mx-auto w-full p-4">

        <?php if (isset($_SESSION['user'])): ?>

            <p class="text-[#0074c7] text-4xl bold">Bienvenue <?= $_SESSION['user']['firstname'] ?> !</p>

        <?php endif; ?>


        <form method="GET" action="" class="flex justify-end m-4">
            <input type="hidden" name="url" value="home">

            <input type="text" name="search" placeholder="Ville de départ" class="border rounded focus:border-[#384050] mt-4 px-3 py-1">

            <button type="submit" class="bg-[#00497c] rounded text-white mt-4 px-3 py-1">Rechercher</button>
        </form>

        <h2 class="text-xl font-bold mb-4">Liste des trajets</h2>

        <?php if (empty($trips)): ?>
            <p>Aucun trajet disponible</p>
        <?php else: ?>

        <?php foreach ($trips as $trip): ?>

            <div class="border mt-4 px-5 py-1 rounded shadow">

                <p>
                    <strong><?= $trip['departure_city'] ?></strong> →
                    <strong><?= $trip['arrival_city'] ?></strong>
                </p>

                <p>
                    Départ : <?= date('d/m/Y H:i', strtotime($trip['departure_datetime'])) ?>
                </p>

                <p>
                    Arrivée : <?= date('d/m/Y H:i', strtotime($trip['arrival_datetime'])) ?>
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
                    <button type="submit" class="mt-2 bg-[#384050] text-white rounded px-3 py-1">Réserver</button>
                </form>

                <?php if (isset($_SESSION['user']) && $trip['is_reserved']): ?>

                    <button
                        onclick="toggleDetails(<?= $trip['id'] ?>)"
                        class="mt-2 bg-gray-500 text-white px-3 py-1 rounded">
                        Voir les détails
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


            <a href="?url=admin" class="hover:underline">Tableau de bord administrateur</a>

        <?php endif; ?>

    </main>

    <?php include 'partials/footer.php' ?>

    <script>
        function toggleDetails(id) {
            const el = document.getElementById("details-" + id);
            el.classList.toggle("hidden");
        }
    </script>

</body>


</html>