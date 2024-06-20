<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "mysqlUser";
$password = "Tsuchida";

try {
    $conn = new PDO("mysql:host=$servername;dbname=authentication", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$requete = $conn->prepare("SELECT login FROM users");
$requete->execute();

$resultats = $requete->fetchAll();
// var_dump($resultats);

$retour["users"] = $resultats;

echo json_encode($retour);
?>