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
        // Appel d'un contact par Id dans la BDD
        $contact = $this->contactManager->findById((int)$id);   
        
        // Vérification du résultat
        if ($contact) {
            echo "\n" . $contact->__toString() . "\n";    
        } else {
            echo colorerTerminal("\n" . "Le contact avec l'ID $id n'a pas été trouvé. Il est probable qu'il n'en existe pas." . "\n", $errorColor);
        }        
    }

    public function creat($name, $email, $phone_number, $errorColor, $successColor) 
    {
        // Création d'un nouveau contact
        $successCreate = $this->contactManager->create((string)$name, (string)$email, (string)$phone_number);

        // Vérification du résultat
        if ($successCreate) {
            echo colorerTerminal("\n" . "Le contact $name a été créé avec succès." . "\n", $successColor);
        } else {
            echo colorerTerminal("\n" . "Erreur lors de la création du contact." . "\n", $errorColor);
        }
    }

    public function delete() 
    {
        
    }

    public function quit() 
    {
        exit(); 
    }

}