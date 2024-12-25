<?php
// inclure des model 
require_once '../models/User.php';

class UsersController {
    private $usermodel;

    public function __construct(){
        $this->usermodel = new UserModel();
    }


    // methode pour gérer les inscriptions 
    public function inscription(){
        
    }

}













?>