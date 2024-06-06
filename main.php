<?php

require_once './config/config.php';
require_once './models/dbconnect.php';

// Créé une instance de DBConnect et get l'objet PDO
$db = new DBConnect ($dsn, $user, $password);
$pdo = $db->getPDO();

// test de l'instance
// var_dump($pdo);

// requete test
// $requete = $pdo->prepare('SELECT * FROM contact');
// $requete->execute();
// $contact = $requete->fetchAll();
// var_dump($contact);

while (true) {
    $line = readline("Entrez votre commande : ");
    switch ($line) {
        case "list":
            echo "affichage de la liste\n";
            break;
        default:
            echo "Vous avez saisi : $line\n";
            break;
    } 
}