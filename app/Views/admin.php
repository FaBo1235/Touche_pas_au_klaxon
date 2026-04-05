<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<header>
    <a href="?url=home"><img src="images/logo.png" alt="logo de voiture pour le coivoiturage" class="w-32"></a>
</header>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-10 p-4">

        <h1 class="text-3xl font-bold mb-4">Panel Admin</h1>



        <h2 class="text-2xl font-semibold mt-6 mb-4">Liste des trajets</h2>

        <?php foreach ($trips as $trip): ?>

            <div class="bg-[#f1f8fc] p-4 mb-4 rounded shadow">

                <p class="text-lg font-bold">
                    <?= $trip['departure_city'] ?> → <?= $trip['arrival_city'] ?>
                </p>

                <p class="text-gray-600">
                    Départ : <?= date('d/m/Y H:i', strtotime($trip['departure_datetime'])) ?>

                </p>

                <p>
                    Arrivée : <?= date('d/m/Y H:i', strtotime($trip['arrival_datetime'])) ?>
                </p>

                <p class="text-sm text-gray-500">
                    Conducteur :
                    <?= $trip['firstname'] ?> <?= $trip['lastname'] ?>
                </p>

                <form method="POST" action="?url=delete-trip" class="mt-2">
                    <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">

                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Supprimer
                    </button>
                </form>

            </div>

        <?php endforeach; ?>

        <a href="?url=home" class="bg-gray-500 text-white px-3 py-1 m-6 rounded">
            Retour
        </a>
    </div>

</body>

</html>