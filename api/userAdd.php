<?php

var_dump(file_get_contents('php://input'));

// echo $_POST['login'];
// echo 'succes';

// $_SERVER['REQUEST_METHOD'] === 'POST';

// $servername = "localhost";
// $username = "mysqlUser";
// $password = "Tsuchida";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=authentication", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $requete = $conn->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
//     $requete->execute([$_POST['login'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
// } catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
?>