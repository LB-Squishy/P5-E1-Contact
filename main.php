<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/src/Database/DBConnect.php';
require_once __DIR__ . '/src/Manager/ContactManager.php';
require_once __DIR__ . '/src/Utils/ColorTerminal.php';
require_once __DIR__ . '/src/Controller/Command.php';
require_once __DIR__ . '/src/Utils/LineDataExtractor.php';

// Initialise les instances
$db = new DBConnect($dsn, $user, $password);
$pdo = $db->getPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$contactManager = new ContactManager($pdo);
$command = new Command($contactManager);

// Affiche le message de démarrage
$command->title();

// Boucle des commandes utilisateur
while (true) {
    echo "\n" . "-----------------------------------------------------------------------------------------------" . "\n\n";
    $line = readline("Entrez votre commande (help, list, detail, creat, delete, quit) : ");

    // Utilisation de preg_match pour extraire la valeur de detail
    $lineData = LineDataExtractor::lineDataExtractor($line);
    // Continue la boucle si les données de commande sont incorrectes
    if ($lineData === "missCreatData") {
        continue; 
    }
    // extrait les variable du tableau retourné
    extract($lineData);

    // Utilisation de switch case pour gérer les commandes
    switch ($commandName) {
        case "help":          
            $command->help();
            break;
        case "list":        
            $command->list();      
            break;
        case "detail":        
            $command->detail($id);
            break;
        case "creat":        
            $command->creat($name, $email, $phone_number);
            break;
        case "delete":
            $command->delete($id);
            break;
        case "quit":   
            $command->quit();       
            break;
        default:
            $command->default($line); 
            break;
    } 
}