<?php

require_once './app/models/UserModel.php';

class UserController
{
    private $usermodel;

    public function __construct()
    {
        $this->usermodel = new UserModel();
    }
    public function inscription()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifie que tous les champs requis sont remplis
            $requiredFields = ['nom', 'prenom', 'username', 'email', 'password'];
            $missingFields = array_filter($requiredFields, fn($field) => empty($_POST[$field]));

            if (!empty($missingFields)) {
                echo "Les champs suivants sont manquants : " . implode(', ', $missingFields);
                exit;
            }
        }
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $username = htmlspecialchars(trim($_POST['username']));
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // creation de l'uilisateur 
        $user = $this->usermodel->add($nom, $prenom, $username, $email, $password);
        if (!$user) {
            echo json_encode(["message" => "Erreur lors de l'inscription"]);
            http_response_code(500);
            exit;
        } else {
            echo json_encode(["message" => "Inscription réussie"]);
            http_response_code(201);
            exit;
        }
    }
    public function connexion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifie que tous les champs requis sont remplis
            $requiredFields = ['email', 'password'];
            $missingFields = array_filter($requiredFields, fn($field) => empty($_POST[$field]));
            if (!empty($missingFields)) {
                echo "Les champs suivants sont manquants : " . implode(', ', $missingFields);
                exit;
            }
            $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];

            // recupérer l'utilisateur par email
            $user = $this->usermodel->getUserByEmail($email);
            if (!$user || !password_verify($password, $user['password'])) {
                echo json_encode(["message" => "email ou mot de passe incorrect"]);
                http_response_code(401);
                exit;
            } else {
                echo json_encode(["message" => "Connexion réussie"]);
                http_response_code(200);
            }
            // Création du token
            session_start();
            $_SESSION['id'] = $user['id'];
        }
    }
}
