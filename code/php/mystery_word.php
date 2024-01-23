<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    // Vous devez faire un select pour afficher le mot mystere affiché en bdd ! =)
    $servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mystery_world";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer le mot mystère
$sql = "SELECT world FROM mystery_world WHERE id_mystery_world = 1"; // Assurez-vous que l'id_mystery_world correspond à votre mot mystère

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mystery_word = $row["world"];
} else {
    $mystery_word = "Mot mystère non trouvé.";
}

// Fermer la connexion à la base de données
$conn->close();
    ?>

    <p> Je veux connaitre le mot mystere, donc affichez le ici : <?php echo $mystery_word; ?></p>
    
</body>
</html>