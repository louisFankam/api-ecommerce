<?php

function dispatch($method, $uri)
{
    // Définir les routes
    $routes = [
        // Ressource
        ['GET', '/api/resource', 'ResourceController@index'],
        ['GET', '/api/resource/{id}', 'ResourceController@show'],
        ['POST', '/api/resource', 'ResourceController@store'],
        ['PUT', '/api/resource/{id}', 'ResourceController@update'],
        ['DELETE', '/api/resource/{id}', 'ResourceController@destroy'],
        // Authentification
        ['POST', '/api/connexion/', 'UserController@connexion'],
        ['POST', '/api/inscription/', 'UserController@inscription'],
    ];

    foreach ($routes as $route) {
        [$httpMethod, $path, $action] = $route;

        // Remplace les paramètres dynamiques par des regex
        $pattern = preg_replace('#\{[^\}]+\}#', '([^/]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        if ($method === $httpMethod && preg_match($pattern, $uri, $matches)) {
            array_shift($matches); // Supprime la correspondance complète
            [$controller, $method] = explode('@', $action);
            $controllerPath = __DIR__ . "/../controllers/api/$controller.php";

            if (file_exists($controllerPath)) {
                require_once $controllerPath;
                $controllerInstance = new $controller();
                if (method_exists($controllerInstance, $method)) {
                    return call_user_func_array([$controllerInstance, $method], $matches);
                }
            }
            http_response_code(500);
            echo "Erreur : méthode ou contrôleur introuvable.";
            return;
        }
    }

    http_response_code(404);
    echo "404 - Route non trouvée.";
};
