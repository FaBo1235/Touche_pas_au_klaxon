<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">

    <?php include 'partials/header.php'; ?>

    <main class="flex-grow flex items-center justify-center">

        <div class="bg-[#f1f8fc] shadow p-6 rounded w-full max-w-md">

            <h1 class="text-3xl font-bold mb-4 text-center">Connexion</h1>

            <?php if (isset($_SESSION['error'])): ?>

                <div class="bg-[#cd2c2e]/30 text-[#cd2c2e] p-3 rounded mb-4 text-center">

                    <?= $_SESSION['error'] ?>

                    <div class="mt-2">
                        <a href="?url=login" class="bg-[#cd2c2e] text-white px-3 py-1 rounded">
                            Réessayer
                        </a>
                    </div>

                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>



            <form method="POST" action="?url=do-login" class="space-y-4">

                <div>
                    <label>Email :</label>
                    <input type="email" name="email" class="w-full border p-2 rounded" required>
                </div>

                <div>
                    <label>Mot de passe :</label>
                    <input type="password" name="password" class="w-full border p-2 rounded" required>
                </div>

                <button class="w-full bg-[#00497c] text-white py-2 rounded">
                    Se connecter
                </button>

            </form>

        </div>

    </main>

    <?php include 'partials/footer.php'; ?>

</body>

</html>