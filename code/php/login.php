
<?php
session_start(); // Démarrer la session

// Assurez-vous de mettre les informations de connexion correctes
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mystery_world";

// Initialiser la variable d'erreur
$error_message = "";

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer une connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Préparer et exécuter la requête SQL pour vérifier les informations d'identification
    $sql = "SELECT id_user, first_name, last_name, email, password FROM User WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Vérifier le mot de passe
        if (password_verify($password, $row["password"])) {
            // Informations d'identification correctes, connecter l'utilisateur
            $_SESSION["user_id"] = $row["id_user"];
            $_SESSION["user_first_name"] = $row["first_name"];
            $_SESSION["user_last_name"] = $row["last_name"];
            $_SESSION["user_email"] = $row["email"];

            // Rediriger l'utilisateur vers la page de profil
            header("Location: mystery_word.php");
            exit();
        } else {
            // Mot de passe incorrect
            $error_message = "Mot de passe incorrect.";
        }
    } else {
        // L'utilisateur avec cet e-mail n'existe pas
        $error_message = "Aucun utilisateur trouvé avec cet e-mail.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mettez ici les balises meta, les liens CSS, etc. -->
    <title>Login</title>
</head>
<body>
    <!-- Mettez ici le contenu HTML de votre page de connexion -->
    <h1>Login</h1>
    <?php
    if (!empty($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
    <form method="post" action="login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>
