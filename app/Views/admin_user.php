<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin - Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">

    <?php include 'partials/admin_header.php'; ?>

    <main class="flex-grow max-w-5xl mx-auto w-full p-6">

        <h1 class="text-3xl font-bold mb-6">
            Gestion des utilisateurs
        </h1>

        <div class="bg-white shadow rounded overflow-hidden">

            <table class="w-full text-left">

                <thead class="bg-[#00497c] text-white">
                    <tr>
                        <th class="p-3">Nom</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Rôle</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($users as $user): ?>

                        <tr class="border-b">

                            <td class="p-3">
                                <?= $user['firstname'] ?> <?= $user['lastname'] ?>
                            </td>

                            <td class="p-3">
                                <?= $user['email'] ?>
                            </td>

                            <td class="p-3">
                                <?= $user['role'] ?>
                            </td>

                            <td class="p-3">

                                <?php if ($user['role'] !== 'ADMIN'): ?>

                                    <form method="POST" action="?url=delete-user">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

                                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Supprimer
                                        </button>
                                    </form>

                                <?php else: ?>
                                    <span class="text-gray-400">Protégé</span>
                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </main>

    <?php include 'partials/footer.php'; ?>

</body>

</html>