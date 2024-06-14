<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/database/DBConnect.php';
require_once __DIR__ . '/models/ContactManager.php';
require_once __DIR__ . '/utils/colorTerminal.php';
require_once __DIR__ . '/utils/command.php';

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
    // Utilisation de preg_match pour extraire l'ID de detail et à default d'ID utiliser le nom de la commande
    if (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $commandName = 'detail';
        $id = $matches[1];
    } else {
        $commandName = $line;
        $id = null;
    }
    // Utilisation de switch case pour gérer les commandes
    switch ($commandName) {
        case "help":          
            echo colorerTerminal( "\n" . "DETAIL DE LA LISTE DES COMMANDES : " . "\n", $titleColor);
            $command->help();
            break;
        case "list":        
            echo colorerTerminal("\n" . "LISTE DES CONTACTS : " . "\n", $titleColor);
            $command->list();      
            break;
        case "detail":        
            echo colorerTerminal("\n" . "DETAIL D'UN CONTACTS : " . "\n", $titleColor);
            $command->detail($id, $errorColor);
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