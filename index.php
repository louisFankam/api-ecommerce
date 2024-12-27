<?php

require_once("./app/config/database.php");
require_once __DIR__ . '/app/routes/routes.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/apiprojet', '', $uri); // Ajustez selon le chemin de votre projet

dispatch($requestMethod, $uri);