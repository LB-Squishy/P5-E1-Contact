<?php
require_once './entities/Contact.php';

class ContactManager {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        try {

            $requete = $this->pdo->prepare('SELECT * FROM contact');
            $requete->execute();
            $allContacts = $requete->fetchAll();

            foreach ($allContacts as $oneContact) {
                $contact = new Contact();
                $contact->setId($oneContact['id']);
                $contact->setName($oneContact['name']);
                $contact->setEmail($oneContact['email']);
                $contact->setPhoneNumber($oneContact['phone_number']);
                $contacts[] = $contact;
            }

            return $contacts;

        } catch (PDOException $e) {

            echo 'Echec de récupération des données' . $e->getMessage() . "<br/>";
            die();

        }
    }

}