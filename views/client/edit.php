<?php
$host = "tcp:societe1.database.windows.net,1433";
$db_name = "mv-mini"; 
$username = "maram";
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);

$id = $_GET['id'] ?? null;
if ($id) {
    $query = "SELECT * FROM client WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ID_region = $_POST['ID_region'];
    $query = "UPDATE client SET nom = ?, prenom = ?, age = ?, ID_region = ? WHERE ID_client = ?";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$nom, $prenom, $age, $ID_region, $_POST['id']])) {
        header('Location: list.php');
        exit();
    } else {
        echo "Error updating client.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier le Client</title>
</head>
<body>
    <h1>Modifier le Client</h1>
    <?php if ($client): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $client['ID_client'] ?>">
            <label>Nom:</label>
            <input type="text" name="nom" value="<?= $client['nom'] ?>"><br>
            <label>Prénom:</label>
            <input type="text" name="prenom" value="<?= $client['prenom'] ?>"><br>
            <label>Age:</label>
            <input type="number" name="age" value="<?= $client['age'] ?>"><br>
            <label>Région:</label>
            <select name="ID_region">
                <?php
                $regions = $conn->query("SELECT ID_region, libelle FROM region");
                while ($region = $regions->fetch(PDO::FETCH_ASSOC)) {
                    $selected = $region['ID_region'] == $client['ID_region'] ? 'selected' : '';
                    echo "<option value='{$region['ID_region']}' $selected>{$region['libelle']}</option>";
                }
                ?>
            </select><br>
    <button type="submit">Mettre à jour</button>
</form>
<?php else: ?>
    <p>Client introuvable.</p>
<?php endif; ?>
<a href="list.php">Retour à la liste</a>
</body>
</html>
