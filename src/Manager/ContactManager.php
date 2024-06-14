<?php
require_once __DIR__ . '/../Entity/Contact.php';

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
            echo 'Echec de récupération des données' . $e->getMessage();
            die();
        }
    }

    public function findById(int $id): ?Contact
    {
        try {
            $requete = $this->pdo->prepare('SELECT * FROM contact WHERE id = :id');
            $requete->bindParam(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            $oneContact = $requete->fetch();
            if ($oneContact) {
                $contact = new Contact();
                $contact->setId($oneContact['id']);
                $contact->setName($oneContact['name']);
                $contact->setEmail($oneContact['email']);
                $contact->setPhoneNumber($oneContact['phone_number']);
                return $contact;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Echec de récupération des données' . $e->getMessage();
            die();
        }
    }

    public function create(string $name, string $email, string $phone_number)
    {
        try {
            $requete = $this->pdo->prepare('INSERT INTO contact (name, email, phone_number) VALUES (?, ?, ?)');
            $requete->execute([$name, $email, $phone_number]);
            return true;
        } catch (PDOException $e) {
            echo 'Echec d\'envoie des données' . $e->getMessage();
            return false;
        }
    }

    public function deleteById(int $id)
    {
        try {
            $requete = $this->pdo->prepare('DELETE FROM contact WHERE id = :id');
            $requete->bindParam(':id', $id, PDO::PARAM_INT);
            $requete->execute();
            return true;
        } catch (PDOException $e) {
            echo 'Echec de suppression des données' . $e->getMessage();
            return false;
        }
    }

}