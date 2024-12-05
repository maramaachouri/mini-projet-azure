<?php
$host = "tcp:societe1.database.windows.net,1433";
$db_name = "mv-mini"; 
$username = "maram";
$password = "azerty123@";
$conn = new PDO("sqlsrv:server=$host;Database=$db_name;Encrypt=true;TrustServerCertificate=false", $username, $password);


$clients = [];
$searchQuery = "";


if (isset($_GET['search'])) {
    
    $searchQuery = "%" . $_GET['search'] . "%"; 
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region 
            WHERE c.nom LIKE ? OR c.prenom LIKE ?";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchQuery, $searchQuery]); 
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    
    $sql = "SELECT c.ID_client, c.nom, c.prenom, c.age, r.libelle AS region 
            FROM client c 
            LEFT JOIN region r ON c.ID_region = r.ID_region";
    
    $stmt = $conn->query($sql);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="../../public/styles/index.css">
</head>
<body class="df-c">
    <div class="df">
        <h1>Liste des Clients</h1>
        <a href="add.php">Ajouter un client</a>
    </div>
    
    <!-- Search Form -->
    <form method="GET" class="df" action="">
        <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Rechercher par nom">
        <button type="submit">Rechercher</button>
        <a href="list.php">Effacer</a> <!-- Clear search -->
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Région</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['ID_client']) ?></td>
                        <td><?= htmlspecialchars($client['nom']) ?></td>
                        <td><?= htmlspecialchars($client['prenom']) ?></td>
                        <td><?= htmlspecialchars($client['age']) ?></td>
                        <td><?= htmlspecialchars($client['region']) ?></td>
                        <td>
                            <a style="background:white;" href="edit.php?action=editClient&id=<?= htmlspecialchars($client['ID_client']) ?>"><img width="20" height="20" src="https://icons.veryicon.com/png/o/miscellaneous/linear-small-icon/edit-246.png" alt=""></a>
                            <a style="background:white;" href="delete.php?action=deleteClient&id=<?= htmlspecialchars($client['ID_client']) ?>"><img width="20" height="20"  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJoAAACUCAMAAABcK8BVAAAAZlBMVEX///8AAADGxsb39/f8/Pzx8fEwMDDPz89VVVXj4+N5eXk5OTkICAiurq7CwsKGhoYSEhIYGBjX19ehoaE+Pj4fHx9lZWVaWlq4uLiTk5MrKytNTU2NjY2amprd3d2np6dwcHBGRkYY/DTYAAADuUlEQVR4nO2c63qiMBCGGzBgBOUgILUV6/3fZFcz0QVTcpCBPrvz/ZSEvOQ0SczM25ufeLlvkpwZVCTNueSeRXjq/GGiemi9nREsiOzBrqriuchaN7CrgnnI9u5kjM3SqLEPGWMlPplIHsXlhUF/DeEL/kD9vHNl2yA2KDhnqUp/wibjqqSDsMvQ3aeZEJfs7QTlfNlnaWYaCQdZTOXQcwTMgg0e1a0YGARnl0zv7p/jobiWxTiVImSeyLJ3emonSyncckEmXHMFNipxywUTyA6HCQRolVuu/Pei/f5am2z5EYo4eBLMA9HzkzFBrZ2en8TC2UaEu6aK6vxZyoA66edMdVQ1wcoFbOu4jH1NSWtddfwwJ9hVjeUU7rlWfEl5Z0Mm6gXQWGRRb2GxBNmfDmceDO/LkDG2N5F1asFcbzq+QhcvN2pqqU0LE1Vp9Qw7IKlYVYZpDQjJjrhrq55K6N35eDJh2/BTSrXU+CA9y0TFrKc7wmrRpMz3TFCg2qazwQb4MBMTCPZC45voRWttHG0LfQ17p92TXV8rmc0HTCx1jGKYsBac15ghXaZM2nzWgFm2lGpRVmQxD9HF47sNNS/Z7tU2t96N9cuNfwbg6GhhgJZYfzOWWq3AdwuQ5Zbb5/I4N1liVWdX8ZP5bRMq37sYH3FWZ/Dp6FtfkHpxsnWd3mE0XEzn794KoNu4HwgGMuMazdCHcHjhfn6EjsYJzUOE5iNC8xEWWtjp1jBCN69zoT+eQkILqmPyOXzSHaJjM4QLN9FRf2EBB00+2wyKuu0+okH65kdjhIMmyyv6NQTHJf3NZJnrvgIRTT5K+y/dyF+z3o/w74zufAoVrV9BWjQ4DdBtMQmN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0AiN0H4p2uX2aOAuBv4w/ZA/sbxhqgu2g4PW6sqTbsx1/5bzan37VedeiXSbeV+k+VPIhiBJ08vwcrBY52mtDZ6EdQdcBBrPpzCONde9y0Dv8vYf3pyfQP8yWoLmnM/TF9Hcol+5SEVyc/c+K8EZHc1fGsI5JO4FiEpmbRGoboJAix/uzbKCYHNoMQ2ktWNfHlnBUb5A8jIH6+oVnkO5mWfmpB5awULFry+roEAovQ08YVwDfw1y19aOwvZSzen53fyi2Cavt1aR+RobtURl+eekEy9/RCTwjhbX3F/BsjbuxATq4nbzeKvOv8pOohdL+JhMoF70tPVoY3wDvNRX9F2Rb9wAAAAASUVORK5CYII=" alt=""></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No clients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
