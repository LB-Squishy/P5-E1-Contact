<?php

require_once './config/config.php';
require_once './database/DBConnect.php';
require_once './models/ContactManager.php';
require_once './utils/colorTerminal.php';

// Créé une instance de DBConnect et get l'objet PDO
$db = new DBConnect($dsn, $user, $password);
$pdo = $db->getPDO();

// Initialise ContactManager
$contactManager = new ContactManager($pdo);

// Boucle des commandes utilisateur
echo colorerTerminal(
    "\n\n" 
    . "==| BIENVENUE |================================================================================" . "\n\n" 
    . "    => Vous retrouverez ici la liste de tout vos contacts." . "\n"
    . "    => Saisissez 'help' pour accéder à l'aide." . "\n\n"
    . "===============================================================================================" . "\n"
    , $openCloseColor
);

while (true) {
    echo "\n" . "-----------------------------------------------------------------------------------------------" . "\n\n";
    $line = readline("Entrez votre commande (help, list, detail, creat, delete, quit) : ");
    switch ($line) {
        case "help":          
            echo colorerTerminal( "\n" . "DETAIL DE LA LISTE DES COMMANDES : " . "\n", $titleColor);
            echo "\n" . "- help : Affiche cet espace d'aide" . "\n";
            echo "\n" . "- list : Liste les contacts" . "\n";
            echo "\n" . "- detail [id] : Fourni le détail d'un contact" . "\n";
            echo "\n" . "- creat [name], [email], [phone_number] : Crée un nouveau contact" . "\n";
            echo "\n" . "- delete [id] : Supprime un contact" . "\n";
            echo "\n" . "- quit : Quitter l'application" . "\n";       
            break;
        case "list":        
            echo colorerTerminal("\n" . "LISTE DES CONTACTS : " . "\n", $titleColor);
            $contacts = $contactManager->findAll();
            foreach ($contacts as $contact) {
                echo "\n" . $contact->__toString() . "\n";
            }        
            break;
        case "quit":   
            echo colorerTerminal("\n" . "==| AU REVOIR |================================================================================"  . "\n\n", $openCloseColor);
            exit();      
            break;
        default:
            echo colorerTerminal("\n" . "Vous avez saisi : $line" . "\n" . "==> $line n'est pas une commande de la liste." . "\n" . "==> n'hésitez pas à saisir 'help' pour accéder à l'aide." . "\n", $errorColor);
            break;
    } 
}