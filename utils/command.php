<?php

require_once './models/ContactManager.php';

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

    public function detail() 
    {
        
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