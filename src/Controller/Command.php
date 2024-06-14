<?php

require_once __DIR__ . '/../Manager/ContactManager.php';
require_once __DIR__ . '/../Utils/colorTerminal.php';

class Command {

    private $contactManager;

    public function __construct($contactManager)
    {
        $this->contactManager = $contactManager;
    }

    public function title() 
    {
        echo ColorTerminal::colorTerminal (
            "\n\n" 
            . "==| BIENVENUE |================================================================================" . "\n\n" 
            . "    => Vous retrouverez ici la liste de tous vos contacts." . "\n"
            . "    => Saisissez 'help' pour accéder à l'aide." . "\n\n"
            . "===============================================================================================" . "\n"
            , ColorTerminal::OPEN_CLOSE_COLOR
        );
    }

    public function help() 
    {
        echo ColorTerminal::colorTerminal( "\n" . "DETAIL DE LA LISTE DES COMMANDES : " . "\n", ColorTerminal::TITLE_COLOR);
        echo 
        "\n" . 
        "- help : Affiche cet espace d'aide" 
        . "\n". "\n" . 
        "- list : Liste les contacts" 
        . "\n". "\n" . 
        "- detail [id] : Fourni le détail d'un contact" 
        . "\n". "\n" . 
        "- creat [name], [email], [phone_number] : Crée un nouveau contact" 
        . "\n". "\n" . 
        "- delete [id] : Supprime un contact" 
        . "\n". "\n" . 
        "- quit : Quitter l'application" 
        . "\n";        
    }

    public function list() 
    {
        echo ColorTerminal::colorTerminal("\n" . "LISTE DES CONTACTS : " . "\n", ColorTerminal::TITLE_COLOR);
        $contacts = $this->contactManager->findAll();
        foreach ($contacts as $contact) {
            echo "\n" . $contact->__toString() . "\n";
        }  
    }

    public function detail($id) 
    {
        echo ColorTerminal::colorTerminal("\n" . "DETAIL D'UN CONTACT : " . "\n", ColorTerminal::TITLE_COLOR);
        if ($id) {
            // Appel d'un contact par Id dans la BDD
            $contact = $this->contactManager->findById((int)$id);            
            // Vérification du résultat
            if ($contact) {
                echo "\n" . $contact->__toString() . "\n";    
            } else {
                echo ColorTerminal::colorTerminal("\n" . "Le contact avec l'ID $id n'a pas été trouvé. Il est probable qu'il n'en existe pas." . "\n", ColorTerminal::ERROR_COLOR);
            } 
        } else {
            echo ColorTerminal::colorTerminal("\n" . "Cette commande doit possèder des données." . "\n" . "Utilisez la commande comme ceci : detail [id] - ex : 'detail 3' ." . "\n", ColorTerminal::ERROR_COLOR);
        }           
    }

    public function creat($name, $email, $phone_number) 
    {
        echo ColorTerminal::colorTerminal("\n" . "PROCESSUS DE CREATION DE CONTACT : " . "\n", ColorTerminal::TITLE_COLOR);
        if ($name && $email && $phone_number) {
            // Création d'un nouveau contact
            $successCreate = $this->contactManager->create((string)$name, (string)$email, (string)$phone_number);
            // Vérification du résultat
            if ($successCreate) {
                echo ColorTerminal::colorTerminal("\n" . "Le contact $name a été créé avec succès." . "\n", ColorTerminal::TITLE_COLOR);
            } else {
                echo ColorTerminal::colorTerminal("\n" . "Erreur lors de la création du contact." . "\n", ColorTerminal::SUCCESS_COLOR);
            }
        } else {
            echo ColorTerminal::colorTerminal("\n" . "Cette commande doit possèder des données." . "\n" . "Utilisez la commande comme ceci : creat [name], [email], [phone_number] - ex : 'creat Buffy Summer, buffy@sunnydale.com, 01091901' ." . "\n", ColorTerminal::ERROR_COLOR);
        }    
    }

    public function delete() 
    {
        
    }

    public function quit() 
    {
        echo ColorTerminal::colorTerminal("\n" . "==| AU REVOIR |================================================================================"  . "\n\n", ColorTerminal::OPEN_CLOSE_COLOR);
        exit(); 
    }

    public function default($line) 
    {
        echo ColorTerminal::colorTerminal("\n" . "Vous avez saisi : $line" . "\n" . "==> $line n'est pas une commande de la liste." . "\n" . "==> n'hésitez pas à saisir 'help' pour accéder à l'aide." . "\n", ColorTerminal::ERROR_COLOR);  
    }

}