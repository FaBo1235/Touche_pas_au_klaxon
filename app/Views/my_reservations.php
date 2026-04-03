<h1>Mes réservations</h1>

<a href="?url=home">Retour</a>

<?php if (empty($reservations)): ?>
    <p>Aucune réservation</p>
<?php else: ?>

    <?php foreach ($reservations as $r): ?>

        <div style="border:1px solid black; margin:10px; padding:10px;">
            <p><?= $r['departure_city'] ?> → <?= $r['arrival_city'] ?></p>
            <p>Départ : <?= $r['departure_datetime'] ?></p>
            <p>Conducteur : <?= $r['firstname'] ?> <?= $r['lastname'] ?></p>
        </div>

        <form method="POST" action="?url=cancel-reservation">
            <input type="hidden" name="reservation_id" value="<?= $r['reservation_id'] ?>">
            <input type="hidden" name="trip_id" value="<?= $r['trip_id'] ?>">
            <button type="submit">Annuler</button>
        </form>
    <?php endforeach; ?>

    


<?php endif; ?>