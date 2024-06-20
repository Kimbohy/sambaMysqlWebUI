<?php
$servername = "localhost";
$username = "kim"; // le user anle mysql
$password = "kimbohy"; // le mot de passe anle user anle mysql
$pass="kimbohy";
$databasename = "authentication"; // le nom de la base de donnée
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);  // eto ovay anle bd samba
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    // recupere le username de l'utilisateur a ajouter
    $user=$_POST['username'];
    $passwd=$_POST['password'];
    $checkAsAdmin=$_POST['admin'];
    // ajouter l'utilisateur
    $sql = "INSERT INTO users (login, password) VALUES ('$user', '$passwd')";
    $conn->exec($sql);
    $result = system("(echo $pass)|sudo sh ./smb.sh");
    // echo $result;
    echo "<script src='./front/move.js'></script>";
    // echo "User :'.$user.'added successfully";
    //revenir au listeUser.php
} catch(PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
?>