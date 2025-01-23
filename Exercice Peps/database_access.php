<?php session_start(); 
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/dbconnect.php');
require_once(__DIR__ . '/functions.php');
?>

<?php require_once(__DIR__ . '/header.php'); ?>
<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <?php require_once(__DIR__ . '/login.php'); ?>
<?php else : ?>
    

    <div class="container">
        <h1>Liste des demandes de devis</h1>
        <div style="padding-bottom:20px">
            <h3>Filtrer</h3>
            <form method="GET">
            <label for="keyword">Recherche par mot clé :</label>
            <input type="text" id="keyword" name="keyword" value="<?php echo htmlspecialchars($_GET['keyword'] ?? ''); ?>"><br>
            <input class="form-check-input showAnswered" type="checkbox" id="showAnswered" name="showAnswered" value="true" <?php if (isset($_GET['showAnswered']) && $_GET['showAnswered'] === 'true') echo 'checked'; ?>>
            <label for="showAnswered">&nbsp;Afficher les devis traités</label> <br>
            <label class="form-label">Trier par date :</label><br>
                <input type="radio" id="dsc" name="dateFilter" value="dsc" <?php if (!isset($_GET['dateFilter']) || $_GET['dateFilter'] === 'dsc') echo 'checked'; ?>>
                <label for="dsc">Plus récent</label> <br>
                <input type="radio" id="asc" name="dateFilter" value="asc" <?php if (isset($_GET['dateFilter']) && $_GET['dateFilter'] === 'asc') echo 'checked'; ?>>
                <label for="asc">Plus ancien</label><br>
            <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>

<?php $query = 'SELECT u.*,r.user_id, r.answered, r.needs, r.budget, r.deadline, r.description, DATE_FORMAT(r.created_at, "%d/%m/%Y") as date, r.answered 
    FROM users u 
    LEFT JOIN requests r on u.user_id = r.user_id
    WHERE 1 = 1';

$getData = $_GET;

if (!isset($getData["showAnswered"]) || ($getData["showAnswered"] !== "true")){
    $query .= " AND r.answered = 0";
}

if (!empty($getData["keyword"])) {
    $keyword = htmlspecialchars($getData['keyword']);
    $query .= " AND (u.lastname LIKE :keyword 
               OR u.firstname LIKE :keyword 
               OR r.description LIKE :keyword 
               OR r.needs LIKE :keyword)";
}

if (!isset($getData["dateFilter"]) || ($getData["dateFilter"]) === "dsc"){
    $query .= " ORDER BY date DESC";
}

elseif ($getData["dateFilter"] === "asc"){
    $query .= " ORDER BY date ASC";
}

$filterStatement = $mysqlClient->prepare($query);
if (!empty($keyword)) {
    $filterStatement->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
}
$filterStatement->execute();
$listeDevis = $filterStatement->fetchAll(PDO::FETCH_ASSOC);
?> 

        
        <table class="table table-hover table-bordered">
            <thead style="position: sticky;top: 0; height:50px; background:#0d6efd; color:white">
                <tr>
                <th scope="col">    </th>
                <th scope="col">Traité</th>
                <th scope="col">Date</th>
                <th scope="col">Besoin</th>
                <th scope="col">Budget</th>
                <th scope="col">Echéance</th>
                <th scope="col">Description</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Entreprise</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($listeDevis as $devis): ?>
                <tr height = 100px>
                    <td style="vertical-align: middle">
                        <?php if($devis["answered"] === 0): ?>
                        <button class="btn btn-primary btn-traiter" id="devis-<?php echo $devis['user_id']; ?>">Traiter</button>
                        <?php elseif($devis["answered"] === 1): ?>
                        <button class="btn btn-secondary btn-traiter" id="devis-<?php echo $devis['user_id']; ?>">Traité</button>
                        <?php endif ?>
                    </td>
                    <td style="vertical-align: middle"><?php if($devis["answered"] === 0) {
                        echo "Non";
                    }
                        elseif($devis["answered"] === 1){
                            echo "Oui";
                        } ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["date"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["needs"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["budget"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["deadline"] ?></td>
                    <td class="col-2 text-truncate" style="max-width: 150px; vertical-align: middle"><?php echo $devis["description"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["lastname"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["firstname"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["company"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["phone"] ?></td>
                    <td style="vertical-align: middle"><?php echo $devis["email"] ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>

</table>
    </div>

<?php endif; ?>
<script src="JS/database_access_update_script.js"></script>
<?php require_once(__DIR__ . '/footer.php'); ?>