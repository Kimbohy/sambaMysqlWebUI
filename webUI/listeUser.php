<html>
<head>
    <title>LISTE DES UTILISATEURS</title>
    <link rel="stylesheet" type="text/css" href="styleList.css">
</head>
<body>
<?php
$servername = "localhost"; 
$username = "mysqlUser"; // le user anle mysql le lier amn samba
$password = "liantsoa0803"; // le mot de passe anle user anle mysql
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=samba", $username, $password); // db ovaina anle samba
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    $sql = "SELECT username FROM users";
    $result = $conn->query($sql);
    //nombre de ligne dan $resultat
    if( $result->rowCount()>0){
        //afficher les lignes
        $i=1;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            
            //ETO NO APETRAKA DAHOLO NY UTILISATEURS REHETRA AO ANATIN'NY BASE DE DONNEES
            echo '<h3> USER '.$i.' </h3> ';
            echo '<table border="1">';
            echo '<tr><th>Username</th></tr><br>';
            echo '<tr><td>'.$row['username'].'</td></tr><br>';
            echo '<form action="deleteUser.php" method="post">';
            echo '<input id="cache"type="hidden" name="username" value="'.$row['username'].'">';
            echo '<button type="submit">DELETE</button>';
            echo '</form>';            
            echo '</table>';
            $i+=1;
        }
        echo '<br>';
        //ajouter un utilisateur dans la base de donnée
        echo '<h3>AJOUTER UN UTILISATEUR</h3>';
        echo '<button onclick="window.location.href=\'ajouterUser.html\'">Ajouter un utilisateur</button>';
    } else {
        //ajouter un utilisateur dans la base de donnée
        echo '<button onclick="window.location.href=\'ajouterUser.html\'">Ajouter un utilisateur</button>';
    };
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
</body>
</html>