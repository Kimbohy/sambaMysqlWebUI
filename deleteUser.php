<?php
$servername = "localhost";
$username = "kim"; // le user anle mysql
$password = "kimbohy"; // le mot de passe anle user anle mysql
$pass="kimbohy";
$databasename = "authentication"; // le nom de la base de donnée
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    // recupere le username de l'utilisateur a supprimer
    $user=$_POST['username'];
    // supprimer l'utilisateur
    $sql = "DELETE FROM users WHERE login='$user'";
    $conn->exec($sql);
    $result = system("(echo $pass)|sudo sh ./smb.sh");
    // echo $result;
    echo "<script src='./front/move.js'></script>";

    // echo "User :'.$user.'deleted successfully <br>";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}