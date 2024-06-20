<?php
$servername = "localhost";
$username = "mysqlUser";
$password = "Tsuchida";

try {
    $conn = new PDO("mysql:host=$servername;dbname=authentication", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully";
    $requete = $conn->prepare("DELETE FROM user WHERE login='usr6'");
    $requete->execute();
    // $resultats = $requete->fetchAll();
    // $retour["users"] = $resultats;

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    // $retour = "";
}
?>