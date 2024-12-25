<?php

// je commence par inclure les fichiers des controllers néccessaire
require_once './app/controllers/ArticlesController.php';
require_once './app/controllers/CartsController.php';
require_once './app/controllers/UsersController.php';


// initialisation des controllers
$usersController = new UsersController();

// je détermine le routage articles
// dans un premier temps si la méthode de request est post
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    return json_encode($_POST['endpoint']);
    if (isset($_POST['endpoint'])) {
        switch ($_POST['endpoint']) {
            case 'inscription':
                // Inscription de l'utilisateur
                // Ajoutez ici le code pour gérer l'inscription
                break;

            case 'connexion':
                // connexion de l'utilisateur
                // Ajoutez ici le code pour gérer l'inscription
                break;

            default:
                echo 'Page not found.';
                break;
        }
    } else {
        http_response_code(400); // Requête mal formée
        echo json_encode(['error' => 'Aucun endpoint spécifié']);
    }
} else {
    http_response_code(405); // Méthode non autorisée
    echo json_encode(['error' => 'Méthode non autorisée']);
}

// dans un premier temps si la méthode de request est get

if (isset($_SERVER['REQUEST_METHOD']) === 'GET') {
    switch ($_POST['endpoit']) {
        case 'panier':
            # code...
            break;

        default:
            # code...
            break;
    }
}
