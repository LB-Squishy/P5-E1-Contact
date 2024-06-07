<?php

require_once './config/config.php';
require_once './database/DBConnect.php';
require_once './models/ContactManager.php';
require_once './utils/colorTerminal.php';
require_once './utils/command.php';

// Initialise les instances
$db = new DBConnect($dsn, $user, $password);
$pdo = $db->getPDO();

$contactManager = new ContactManager($pdo);
$command = new Command($contactManager);

// Affiche le message de démarrage
echo colorerTerminal(
    "\n\n" 
    . "==| BIENVENUE |================================================================================" . "\n\n" 
    . "    => Vous retrouverez ici la liste de tout vos contacts." . "\n"
    . "    => Saisissez 'help' pour accéder à l'aide." . "\n\n"
    . "===============================================================================================" . "\n"
    , $openCloseColor
);

// Boucle des commandes utilisateur
while (true) {
    echo "\n" . "-----------------------------------------------------------------------------------------------" . "\n\n";
    $line = readline("Entrez votre commande (help, list, detail, creat, delete, quit) : ");
    switch ($line) {
        case "help":          
            echo colorerTerminal( "\n" . "DETAIL DE LA LISTE DES COMMANDES : " . "\n", $titleColor);
            $command->help();
            break;
        case "list":        
            echo colorerTerminal("\n" . "LISTE DES CONTACTS : " . "\n", $titleColor);
            $command->list();      
            break;
        case "quit":   
            echo colorerTerminal("\n" . "==| AU REVOIR |================================================================================"  . "\n\n", $openCloseColor);
            $command->quit();       
            break;
        default:
            echo colorerTerminal("\n" . "Vous avez saisi : $line" . "\n" . "==> $line n'est pas une commande de la liste." . "\n" . "==> n'hésitez pas à saisir 'help' pour accéder à l'aide." . "\n", $errorColor);
            break;
    } 
}