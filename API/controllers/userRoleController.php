<?php

namespace API\controllers;

require_once '../dataAccess/repository/userRoleRepository.php';

class userRoleController
{
    public function getAll()
    {
        $response = new \API\dataAccess\userRoleRepository;
        return $response->getRoles();
    }
}
