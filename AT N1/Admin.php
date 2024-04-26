<!DOCTYPE html>
<html>
<head>
    <title>Create Table</title>
</head>
<body>
        <input type="submit" value="Create Table">
</body>
</html>
<?php
$serveur = "127.0.0.1";
$dbname = "stage";
$user = "root";
$pass = "";

try {
    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $form = "CREATE TABLE stag (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cin VARCHAR(50) UNIQUE NOT NULL,
        Nom CHAR(50) NOT NULL,
        prenom CHAR(50) NOT NULL,
        Filiere  VARCHAR(50) NOT NULL,
        Niveau INT NOT NULL,
        groupe VARCHAR(50) NOT NULL,
        Nuser VARCHAR(50) NOT NULL,
        Puser VARCHAR(50) NOT NULL
    )";

    $dbco->exec($form);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
