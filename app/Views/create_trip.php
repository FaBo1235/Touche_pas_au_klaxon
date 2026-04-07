<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>



<body class="flex flex-col min-h-screen">
    <?php include 'partials/header.php' ?>

    <main class="flex-grow max-w-4xl mx-auto w-full p-4">

        <h1>Créer un trajet</h1>

        <form method="POST" action="?url=store-trip">
            <div class="flex flex-col mt-6">
                <div>
                    <label>Agence de départ :</label>
                    <select name="departure_agency_id">
                        <?php foreach ($agencies as $agency): ?>
                            <option value="<?= $agency['id'] ?>">
                                <?= $agency['city'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label>Agence d'arrivée :</label>
                    <select name="arrival_agency_id">
                        <?php foreach ($agencies as $agency): ?>
                            <option value="<?= $agency['id'] ?>">
                                <?= $agency['city'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label>Date de départ :</label>
                    <input type="datetime-local" name="departure_datetime" min="<?= date('Y-m-d\TH:i') ?>" required>
                </div>

                <div>
                    <label>Date d’arrivée :</label>
                    <input type="datetime-local" name="arrival_datetime" min="<?= date('Y-m-d\TH:i') ?>" required>
                </div>

                <div>
                    <label>Places disponibles :</label>
                    <input type="number" name="available_seats" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-[#cd2c2e] text-white px-3 py-1 ml-4 rounded">Créer</button>
                </div>
            </div>
        </form>
        <a href="?url=home">Retour à l'accueil</a>
    </main>
    <?php include 'partials/footer.php' ?>
</body>



</html>