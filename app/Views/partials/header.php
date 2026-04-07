<header class="flex justify-between items-center bg-[#f1f8fc] shadow p-2">

    <a href="?url=home">
        <img src="images/logo.png" class="hidden md:block w-20">
        <img src="images/logo_m.png" class="block md:hidden w-20">
    </a>

    <?php if (isset($_SESSION['user'])): ?>

        <div class="flex gap-5">
            <nav class="flex gap-4">
                <a href="?url=home" class="hover:bg-[#00497c]-60"><span class="font-semibold text-[#00497c]">
                        <p>Bienvenue <?= $_SESSION['user']['firstname'] ?> <?= $_SESSION['user']['lastname'] ?> !</p>
                    </span></a>
                <a href="?url=create-trip" class="hover:underline">Créer un trajet</a>
                <a href="?url=my-reservations" class="hover:underline">Mes réservations</a>
                <a href="?url=logout" class="hover:underline">Déconnexion</a>
            </nav>

        </div>

    <?php else: ?>

        <a href="?url=login" class="flex items-center gap-2">
            <img src="images/user.png" class="w-4">
            Connexion
        </a>

    <?php endif; ?>

</header>