<?php

require_once __DIR__ . '/../models/ContactManager.php';

class Command {

    private $contactManager;

    public function __construct($contactManager)
    {
        $this->contactManager = $contactManager;
    }

    public function help() 
    {
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
        $contacts = $this->contactManager->findAll();
        foreach ($contacts as $contact) {
            echo "\n" . $contact->__toString() . "\n";
        }  
    }

    public function detail($id, $errorColor) 
    {
        // gère l'absence d'id saisi
        if ($id === null) {
            echo colorerTerminal("\n" . "ID du contact manquant. Utilisez la commande comme ceci : detail [id] - ex : 'detail 3' ." . "\n", $errorColor);
            return;
        }
        // gère l'absence d'id correspondant dans la base
        $contact = $this->contactManager->findById((int)$id);       
        if ($contact) {
            echo "\n" . $contact->__toString() . "\n";    
        } else {
            echo colorerTerminal("\n" . "Le contact avec l'ID $id n'a pas été trouvé. Il est probable qu'il n'en existe pas." . "\n", $errorColor);
        }        
    }

    public function creat() 
    {
        
    }

    public function delete() 
    {
        
    }

    public function quit() 
    {
        exit(); 
    }

}