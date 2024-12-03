<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $birthdate = htmlspecialchars(trim($_POST['birthdate']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Vérification des champs
    if (empty($name) || empty($birthdate) || empty($phone)) {
        die("Tous les champs sont obligatoires.");
    }

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root"; // Par défaut pour XAMPP
    $password = ""; // Par défaut pour XAMPP
    $dbname = "atelier_php";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparer et exécuter une requête SQL
    $stmt = $conn->prepare("INSERT INTO user (name, birthdate, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $birthdate, $phone);

    if ($stmt->execute()) {
        echo "Données enregistrées avec succès !";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>
