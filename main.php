<?php

require_once './config/config.php';
require_once './models/DBConnect.php';
require_once './models/ContactManager.php';

// Créé une instance de DBConnect et get l'objet PDO
$db = new DBConnect($dsn, $user, $password);
$pdo = $db->getPDO();

// Initialise ContactManager
$contactManager = new ContactManager($pdo);

// Boucle des commandes utilisateur
echo(
    "\n\n" 
    . "--BIENVENUE--------------------------------------------------------------------------------" 
    . "\n\n" . "Attention à la syntaxe des commandes, les espaces et virgules sont importantes." 
    . "\n\n"
);

while (true) {
    $line = readline("Entrez votre commande (help, list, detail, creat, delete, quit) : ");
    switch ($line) {
        case "list":
            echo "\n" . "Liste des contacts : " . "\n\n";
            $contacts = $contactManager->findAll();
            foreach ($contacts as $contact) {
                echo $contact->__toString() . "\n\n";
            }
            break;
        default:
            echo "Vous avez saisi : $line" . "\n\n";
            break;
    } 
}