<!DOCTYPE HTML>
<html>
<head>
    <title>Liste des utilisateurs</title>
</head>
<body>

<h1>Exemple simple de site en PHP</h1>

<?php
// Inclure le fichier de connexion
require 'connexion.php';

// Inclure les fonctions
require_once 'modele/fonctions.php';

// Connexion à la base de données
$db = connectDatabase();

// Fonction pour sauvegarder les données utilisateur
function saveUser($db, $id, $nom, $prenom) {
    if ($id != null) {
        $query = $db->prepare("UPDATE users SET nom = ?, prenom = ? WHERE id = ?");
        $query->execute(array($nom, $prenom, $id));
    } else {
        $query = $db->prepare("INSERT INTO users (nom, prenom) VALUES (?, ?)");
        $query->execute(array($nom, $prenom));
    }
}

// Fonction pour obtenir un utilisateur par ID
function getUserById($db, $id) {
    $query = $db->prepare("SELECT * FROM users WHERE id = ?");
    $query->execute(array($id));
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour obtenir tous les utilisateurs
function getAllUsers($db) {
    $query = $db->prepare("SELECT * FROM users");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Gestion des actions
if (isset($_GET["action"])) {
    if ($_GET["action"] == "save") {
        saveUser($db, $_GET["id"] ?? null, $_GET["nom"], $_GET["prenom"]);
        header('Location: index.php'); // Rediriger après la sauvegarde
        exit();
    } elseif ($_GET["action"] == "ajouter" || $_GET["action"] == "modifier") {
        $nom = "";
        $prenom = "";
        $id = "";

        if ($_GET["action"] == "modifier" && isset($_GET["id"])) {
            $user = getUserById($db, $_GET["id"]);
            if ($user) {
                $nom = $user["nom"];
                $prenom = $user["prenom"];
                $id = $user["id"];
            }
        }
        include 'vues/edit.php'; // Inclure le formulaire pour ajouter ou modifier
    } else {
        // Charger la liste des utilisateurs par défaut
        $users = getAllUsers($db);
        include 'vues/list.php';
    }
} else {
    // Charger la liste des utilisateurs par défaut
    $users = getAllUsers($db);
    include 'vues/list.php';
}
?>

</body>
</html>
