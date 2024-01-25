
<?php
    session_start(); 

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "mystery_world";


    $error_message = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $conn = new mysqli($servername, $username, $password, $dbname);

    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $email = $_POST["email"];
        $password = $_POST["password"];

        
        $sql = "SELECT id_user, first_name, last_name, email, password FROM User WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            
            if (password_verify($password, $row["password"])) {
                
                $_SESSION["user_id"] = $row["id_user"];
                $_SESSION["user_first_name"] = $row["first_name"];
                $_SESSION["user_last_name"] = $row["last_name"];
                $_SESSION["user_email"] = $row["email"];

                
                header("Location: mystery_word.php");
                exit();
            } else {
                
                $error_message = "Mot de passe incorrect.";
            }
        } else {
            
            $error_message = "Aucun utilisateur trouvé avec cet e-mail.";
        }

        
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Login</title>
</head>
<body>
    
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
