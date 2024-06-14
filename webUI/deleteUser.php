<?php
$servername = "localhost";
$username = "mysqlUser"; // le user anle mysql
$password = "liantsoa0803"; // le mot de passe anle user anle mysql
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=samba", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    // recupere le username de l'utilisateur a supprimer
    $user=$_POST['username'];
    // supprimer l'utilisateur
    $sql = "DELETE FROM users WHERE username='$user'";
    $conn->exec($sql);
    echo "User :'.$user.'deleted successfully <br>";
    echo '<button onclick="window.location.href=\'listeUser.php\'">REVENIR AU LISTE</button>';
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}