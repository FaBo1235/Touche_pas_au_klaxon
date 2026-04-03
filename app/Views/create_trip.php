<h1>Créer un trajet</h1>

<form method="POST" action="?url=store-trip">

    <label>Agence de départ :</label>
    <select name="departure_agency_id">
        <?php foreach ($agencies as $agency): ?>
            <option value="<?= $agency['id'] ?>">
                <?= $agency['city'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Agence d'arrivée :</label>
    <select name="arrival_agency_id">
        <?php foreach ($agencies as $agency): ?>
            <option value="<?= $agency['id'] ?>">
                <?= $agency['city'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label>Date de départ :</label>
    <input type="datetime-local" name="departure_datetime" required>

    <br><br>

    <label>Date d’arrivée :</label>
    <input type="datetime-local" name="arrival_datetime" required>

    <br><br>

    <label>Places disponibles :</label>
    <input type="number" name="available_seats" required>

    <br><br>

    <button type="submit">Créer</button>

</form>