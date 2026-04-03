<a href="?url=home">Retour à l'accueil</a>

<h1>Panel ADMIN</h1>

<?php foreach ($trips as $trip): ?>

    <div style="border:1px solid red; margin:10px; padding:10px;">

        <p>
            <?= $trip['departure_city'] ?> → <?= $trip['arrival_city'] ?>
        </p>

        <p><?= $trip['departure_datetime'] ?></p>

        <form method="POST" action="?url=delete-trip">
            <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
            <button type="submit">Supprimer</button>
        </form>

    </div>

<?php endforeach; ?>