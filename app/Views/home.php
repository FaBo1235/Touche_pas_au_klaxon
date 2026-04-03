<?php if (isset($_SESSION['user'])): ?>

    <p>
        Bienvenue <?= $_SESSION['user']['firstname'] ?>
    </p>

    <a href="?url=create-trip">Créer un trajet</a>
    <a href="?url=logout">Déconnexion</a>

<?php else: ?>

    <a href="?url=login">Connexion</a>

<?php endif; ?>


<hr>

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

            <a href="?url=my-reservations">Mes réservations</a>

        </div>

    <?php endforeach; ?>

<?php endif; ?>