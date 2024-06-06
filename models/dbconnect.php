<?php

/**
 * Gère la connexion à la BDD
 */
class DBConnect {

    private $pdo;

    public function __construct($dsn, $user, $password)
    {
        try {
            $this -> pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch (PDOException $e) {
            echo 'Connection failed' . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
    
}
