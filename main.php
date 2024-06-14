<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/database/DBConnect.php';
require_once __DIR__ . '/models/ContactManager.php';
require_once __DIR__ . '/utils/colorTerminal.php';
require_once __DIR__ . '/utils/command.php';

// Initialise les instances
$db = new DBConnect($dsn, $user, $password);
$pdo = $db->getPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$contactManager = new ContactManager($pdo);
$command = new Command($contactManager);

// Affiche le message de démarrage
echo colorerTerminal(
    "\n\n" 
    . "==| BIENVENUE |================================================================================" . "\n\n" 
    . "    => Vous retrouverez ici la liste de tous vos contacts." . "\n"
    . "    => Saisissez 'help' pour accéder à l'aide." . "\n\n"
    . "===============================================================================================" . "\n"
    , $openCloseColor
);

// Boucle des commandes utilisateur
while (true) {
    echo "\n" . "-----------------------------------------------------------------------------------------------" . "\n\n";
    $line = readline("Entrez votre commande (help, list, detail, creat, delete, quit) : ");

    // Utilisation de preg_match pour extraire la valeur de detail
    if (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $commandName = 'detail';
        $id = $matches[1];
    // Utilisation de preg_match pour extraire les valeurs de creat
    } elseif (preg_match('/^creat (.+)$/', $line, $matches)) {
        $commandName = 'creat';
        $params = explode(',', $matches[1]);
        $params = array_map('trim', $params);
        if (count($params) === 3) {
            list($name, $email, $phone_number) = $params;
        } else {
            echo colorerTerminal("\n" . "Il manque une des trois données" . "\n" . "Utilisez la commande comme ceci : creat [name], [email], [phone_number] - ex : 'creat Buffy Summer, buffy@sunnydale.com, 01091901' ." . "\n", $errorColor);
            continue;
        }
    // A default de valeur utiliser le nom de la commande et définir les valeurs sur null
    } else {
        $commandName = $line;
        $id = null;
        $name = null;
        $email = null;
        $phone_number = null;
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
            echo colorerTerminal("\n" . "DETAIL D'UN CONTACT : " . "\n", $titleColor);
            if ($id) {
                $command->detail($id, $errorColor);
            } else {
                echo colorerTerminal("\n" . "Cette commande doit possèder des données." . "\n" . "Utilisez la commande comme ceci : detail [id] - ex : 'detail 3' ." . "\n", $errorColor);
            }
            break;
        case "creat":        
            echo colorerTerminal("\n" . "PROCESSUS DE CREATION DE CONTACT : " . "\n", $titleColor);
            if ($name && $email && $phone_number) {
                $command->creat($name, $email, $phone_number, $errorColor, $successColor);
            } else {
                echo colorerTerminal("\n" . "Cette commande doit possèder des données." . "\n" . "Utilisez la commande comme ceci : creat [name], [email], [phone_number] - ex : 'creat Buffy Summer, buffy@sunnydale.com, 01091901' ." . "\n", $errorColor);
            }
            break;
        case "delete":   
            // Logique pour la commande delete
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