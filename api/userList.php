<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "kim";
$password = "kimbohy";

try {
    $conn = new PDO("mysql:host=$servername;dbname=authentication", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully";
    $requete = $conn->prepare("SELECT login, user_group FROM users");
    $requete->execute();
    $resultats = $requete->fetchAll();
    $retour["users"] = $resultats;

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $retour = "";
}

echo json_encode($retour);
?>