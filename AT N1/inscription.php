<!DOCTYPE html>
<html>
<head>
    <title>Inscription Page</title>
</head>
<body>
    <form action="inscription.php" method="post">
        <fieldset>
            <legend>Informations personnelles</legend>
            <label for="CIN">CIN:</label><br>
            <input type="text" id="CIN" name="CIN"><br>
            <label for="Nom">Nom:</label><br>
            <input type="text" id="Nom" name="Nom"><br>
            <label for="Prenom">Prenom:</label><br>
            <input type="text" id="Prenom" name="Prenom"><br>
            <fieldset>
                <legend>Filiere</legend>
                <input type="radio" id="DD" name="Filiere" value="DD">
                <label for="DD">DD</label><br>
                <input type="radio" id="ID" name="Filiere" value="ID">
                <label for="ID">ID</label><br>
            </fieldset>
            <fieldset>
                <legend>Niveau</legend>
                <input type="radio" id="Niveau_1" name="Niveau" value="1">
                <label for="Niveau_1">1</label><br>
                <input type="radio" id="Niveau_2" name="Niveau" value="2">
                <label for="Niveau_2">2</label><br>
            </fieldset>
            <label for="groupe">Groupe:</label><br>
            <input type="text" id="groupe" name="groupe"><br>
            <label for="nom_utilisateur">Nom d'utilisateur:</label><br>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur"><br>
            <label for="password">Mot de passe:</label><br>
            <input type="password" id="password" name="password"><br>
            <label for="confirm_password">Confirmer le mot de passe:</label><br>
            <input type="password" id="confirm_password" name="confirm_password"><br>
            <input type="submit" value="S'inscrire">
        </fieldset>
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CIN = $_POST['CIN'];
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Filiere = $_POST['Filiere'];
    $Niveau = $_POST['Niveau'];
    $groupe = $_POST['groupe'];
    $Nuser = $_POST['nom_utilisateur'];
    $Puser = $_POST['password'];
    
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=stag', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Vérification de l'unicité du CIN
        $stmt = $pdo->prepare("SELECT * FROM Tstag WHERE CIN = ?");
        $stmt->execute([$CIN]);
        $cinExists = $stmt->fetch();

        if ($cinExists) {
            echo "Ce CIN existe déjà.";
        } else {
            // Vérification de l'unicité du nom d'utilisateur
            $stmt = $pdo->prepare("SELECT * FROM Tstag WHERE Nom_utilisateur = ?");
            $stmt->execute([$Nuser]);
            $usernameExists = $stmt->fetch();

            if ($usernameExists) {
                echo "Ce nom d'utilisateur est déjà pris.";
            } else {
                // Insertion des données dans la base de données
                $stmt = $pdo->prepare("INSERT INTO Tstag (CIN, Nom, Prenom, Filier, Niveau, groupe, Nom_utilisateur, Mot_de_passe) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$CIN, $Nom, $Prenom, $Filiere, $Niveau, $groupe, $Nuser, $Puser]);
                
                echo "Inscription réussie.";
            }
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
