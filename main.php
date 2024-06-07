<?php

require_once './config/config.php';
require_once './database/DBConnect.php';
require_once './models/ContactManager.php';

// Créé une instance de DBConnect et get l'objet PDO
$db = new DBConnect($dsn, $user, $password);
$pdo = $db->getPDO();

// Initialise ContactManager
$contactManager = new ContactManager($pdo);

// Boucle des commandes utilisateur
echo(
    "\n\n" 
    . "==| BIENVENUE |================================================================================" 
    . "\n\n" . "Attention à la syntaxe des commandes, les espaces et virgules sont importantes." 
    . "\n"
);

while (true) {
    echo "\n" . "-------------------------------------------------------------------------------------------" . "\n\n";
    $line = readline("Entrez votre commande (help, list, detail, creat, delete, quit) : ");
    echo "\n" . "-------------------------------------------------------------------------------------------" . "\n";
    switch ($line) {
        case "help":          
            echo "\n" . "DETAIL DE LA LISTE DES COMMANDES : " . "\n";
            echo "\n" . "- help : Affiche cet espace d'aide" . "\n";
            echo "\n" . "- list : Liste les contacts" . "\n";
            echo "\n" . "- detail [id] : Fourni le détail d'un contact" . "\n";
            echo "\n" . "- creat [name], [email], [phone_number] : Crée un nouveau contact" . "\n";
            echo "\n" . "- delete [id] : Supprime un contact" . "\n";
            echo "\n" . "- quit : Quitter l'application" . "\n";       
            break;
        case "list":        
            echo "\n" . "LISTE DES CONTACTS : " . "\n";
            $contacts = $contactManager->findAll();
            foreach ($contacts as $contact) {
                echo "\n" . $contact->__toString() . "\n";
            }        
            break;
        case "quit":   
            echo "\n" . "==| AU REVOIR |================================================================================"  . "\n\n";
            exit();      
            break;
        default:
            echo "\n" . "Vous avez saisi : $line" . "\n" . "==> $line n'est pas une commande de la liste." . "\n" . "==> n'hésitez pas à saisir 'help' pour accéder à l'aide." . "\n";
            break;
    } 
}