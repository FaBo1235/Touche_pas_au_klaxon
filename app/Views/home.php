<?php if (isset($_SESSION['user'])): ?>

    <p>
        Bienvenue <?= $_SESSION['user']['firstname'] ?>
    </p>

    <a href="?url=create-trip">Créer un trajet</a>
    <a href="?url=my-reservations">Mes réservations</a>
    <a href="?url=logout">Déconnexion</a>

<?php else: ?>

    <a href="?url=login">Connexion</a>

<?php endif; ?>


<hr>

<form method="GET" action="">
    <input type="hidden" name="url" value="home">

    <input type="text" name="search" placeholder="Ville de départ">

    <button type="submit">Rechercher</button>
</form>

<br>

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
                Places : <?= $trip['available_seats'] ?>
            </p>

            <p>
                Conducteur :
                <?= $trip['firstname'] ?> <?= $trip['lastname'] ?>
            </p>

            <form method="POST" action="?url=reserve">
                <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
                <button type="submit">Réserver</button>
            </form>


        </div>

    <?php endforeach; ?>

<?php endif; ?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'ADMIN'): ?>

    <p>Mode ADMIN activé</p>
    <a href="?url=admin">Panel Admin</a>

<?php endif; ?>