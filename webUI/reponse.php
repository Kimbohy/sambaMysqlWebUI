<?php
$servername = "localhost";
$username = "mysqlUser";  // hanamboaro base de donnée ana admin 
$password = "liantsoa0803"; // mot de passe anle admin ana admnin
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=samba", $username, $password);// eto ovay anle bd admin
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    $user=$_POST['username'];
    $passwd=$_POST['password'];
    $checkAsAdmin=$_POST['admin'];
    // detecter si ce login est dans le database samba
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$passwd'";
    $result = $conn->query($sql);
    if ($result->rowCount() > 0) {
        echo "Login success";
        echo '<h2>BIENVENUE '.$user.'</h2>';
        echo '<button onclick="window.location.href=\'listeUser.php\'">REVENIR AU LISTE</button>';
    } else {
        echo "Login failed";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}