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
}
