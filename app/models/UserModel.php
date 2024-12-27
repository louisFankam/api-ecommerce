<?php 

require_once __DIR__ . '../../config/database.php';

class UserModel {
    private $conn;

    function __construct(){
        $this->conn = (new Database())->getCon();
    }

    // fontion qui recupere la table utilisateur
    public function getAll(){
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // fonction qui vérifie si l'utilisateur existe a partir de l'email
    public function getUserByEmail($email){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    // fonction qui ajoute un utilisateur
    public function add($nom, $prenom, $username, $email, $password){
        $stmt = $this->conn->prepare("INSERT INTO users (nom, prenom, username, username, email, password) VALUES (?, ?, ?, ?, ?)");

        return $stmt->execute([$nom, $prenom, $username, $email, $password]);
    }
}







































?>