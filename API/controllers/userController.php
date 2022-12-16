<?php

namespace API\controllers;

require_once '../dataAccess/repository/userRepository.php';

class userController
{
    public function getAll()
    {
        $response = new \API\dataAccess\user();
        return $response->getUsers();
    }

    public function getUser($id){
        $response = new \API\dataAccess\user();
        return $response->getUser((int)$id);
    }

    public function addUser($user)
    {
        $response = new \API\dataAccess\user();
        return $response->addUser($user);
    }
}
