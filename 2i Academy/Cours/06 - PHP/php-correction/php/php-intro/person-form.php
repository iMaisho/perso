<form method="post" action="form-process.php">
    <fieldset>
        <legend>Contact</legend>
        <label>Civilité</label><br>
        <input type="radio" id="civF" name="contact[civilite]" value="madame">
        <label for="civF">Madame</label><br>
        <input type="radio" id="civM" name="contact[civilite]" value="monsieur">
        <label for="civM">Monsieur</label><br>
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="contact[nom]"><br>
    </fieldset>
    <fieldset>
        <legend>Adresse</legend>
        <label for="voie">Adresse</label>
        <input type="text" id="voie" name="adresse[voie]"><br>
        <label for="code_postal">Code postal</label>
        <input type="text" id="code_postal" name="adresse[code_postal]"><br>
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="adresse[ville]"><br>
    </fieldset>
    <button type="submit">Valider</button>
</form>