<?php
$servername = "localhost";
$username = "mysqlUser"; // le user anle mysql
$password = "liantsoa0803"; // le mot de passe anle user anle mysql
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=samba", $username, $password);  // eto ovay anle bd samba
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    // recupere le username de l'utilisateur a ajouter
    $user=$_POST['username'];
    $passwd=$_POST['password'];
    $checkAsAdmin=$_POST['admin'];
    // ajouter l'utilisateur
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$passwd')";
    $conn->exec($sql);
    echo "User :'.$user.'added successfully";
    //revenir au listeUser.php
    echo '<button onclick="window.location.href=\'listeUser.php\'">REVENIR AU LISTE</button>';
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>