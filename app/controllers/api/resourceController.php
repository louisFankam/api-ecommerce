<?php

class ResourceController
{
    public function index()
    {
        echo json_encode(["message" => "Liste des ressources"]);
    }

    public function show($id)
    {
        echo json_encode(["message" => "Afficher la ressource avec l'ID $id"]);
    }

    public function store()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(["message" => "Créer une ressource", "data" => $data]);
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(["message" => "Mettre à jour la ressource $id", "data" => $data]);
    }

    public function destroy($id)
    {
        echo json_encode(["message" => "Supprimer la ressource avec l'ID $id"]);
    }
}
