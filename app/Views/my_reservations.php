<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>



<body class="flex flex-col min-h-screen">

    <?php include 'partials/header.php' ?>

    <main class="flex-grow max-w-4xl mx-auto w-full p-4">
        <h1 class="text-2xl bold">Mes réservations</h1>

       

        <?php if (empty($reservations)): ?>
            <p>Aucune réservation</p>
        <?php else: ?>

            <?php foreach ($reservations as $r): ?>

                <div class="bg-white p-4 mb-4 rounded shadow">
                    <p><?= $r['departure_city'] ?> → <?= $r['arrival_city'] ?></p>
                    <p>Départ : <?= $r['departure_datetime'] ?></p>
                    <p>Conducteur : <?= $r['firstname'] ?> <?= $r['lastname'] ?></p>
                </div>

                <form method="POST" action="?url=cancel-reservation">
                    <input type="hidden" name="reservation_id" value="<?= $r['reservation_id'] ?>">
                    <input type="hidden" name="trip_id" value="<?= $r['trip_id'] ?>">
                    <button type="submit" class="bg-[#cd2c2e] text-white rounded px-3 py-1">Annuler</button>
                </form>
            <?php endforeach; ?>

        <?php endif; ?>
        <a href="?url=home" class="bg-[#0074c7] text-white rounded px-3 py-1 mx-2 my-4">Retour</a>
        </main>

        <?php include 'partials/footer.php' ?>
</body>


</html>