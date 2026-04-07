<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin - Agences</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">

    <?php include 'partials/admin_header.php'; ?>

    <main class=" flex-grow max-w-5xl mx-auto w-full p-6">
    <h1 class="text-3xl text-[#00497c] mt-4 mb-8 font-bold">Gestion des agences</h1>

    <form method="POST" action="?url=create-agency" class="flex justify-end">
        <input type="text" name="city" placeholder="Ville" class="border rounded">
        <button class="bg-[#00497c] px-3 py-1 rounded text-white">Ajouter</button>
    </form>

    <?php foreach ($agencies as $agency): ?>

        <p class="font-medium"><?= $agency['city'] ?></p>

        <form method="POST" action="?url=delete-agency">
            <input type="hidden" name="agency_id" value="<?= $agency['id'] ?>">
            <button class="bg-[#cd2c2e] rounded px-3 py-1 text-white">Supprimer</button>
        </form>

    <?php endforeach; ?>
    </main>

    <?php include 'partials/footer.php'; ?>

</body>

</html>