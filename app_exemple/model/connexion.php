<?php
function connectDatabase() {
    try {
        // Connexion à la base de données
        $db = new PDO("mysql:host=localhost;dbname=app_exemple", "root", "root");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création de la base de données si elle n'existe pas
        $db->exec("CREATE DATABASE IF NOT EXISTS `app_exemple` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
        
        // Utilisation de la base de données
        $db->exec("USE `app_exemple`");

        // Création de la table `users` si elle n'existe pas
        $db->exec("
            CREATE TABLE IF NOT EXISTS `users` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nom` varchar(25) NOT NULL,
                `prenom` varchar(25) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
        return $db; // Retourne l'objet PDO
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur : " . $e->getMessage();
        exit;
    }
}
