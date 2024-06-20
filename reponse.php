<?php


$servername = "localhost";
$username = "kim";  // hanamboaro base de donnée ana admin 
$password = "kimbohy"; // mot de passe anle admin ana admnin
$database = "authentication"; // nom de la base de donnée
$table = "admin"; // nom de la table
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);// eto ovay anle bd admin
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    $user=$_POST['username'];
    $passwd=$_POST['password'];
    $checkAsAdmin=$_POST['admin'];
    // detecter si ce login est dans le database samba
    $sql = "SELECT * FROM $table WHERE username='$user' AND password='$passwd'";
    $result = $conn->query($sql);
    if ($result->rowCount() > 0) {
        $retour['userName'] = $user;
        echo '<script src="./front/move.js"></script>';
        // save the user name in to a json file
        $fp = fopen('./data/user.json', 'w');
        fwrite($fp, json_encode($retour));
        fclose($fp);
        // echo "Login success";
        // echo '<h2>BIENVENUE '.$user.'</h2>';
        // echo '<button onclick="window.location.href=\'listeUser.php\'">REVENIR AU LISTE</button>';
    } else {
        echo "Login failed";
    }



} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>



