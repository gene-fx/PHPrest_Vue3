<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../controllers/userController.php';

use API\controllers\userController;

$recievedRequest = json_decode(file_get_contents('php://input'), true);

$url = explode('/', $_GET['url']);

switch ($url['0']) {
    case 'users':
        $response = call_user_func(array(new \API\controllers\userController, 'getAll'));
        echo json_encode(array('data' => $response));
        break;
    case 'add':
        $response = call_user_func(array(new \API\controllers\userController, 'addUser'), $recievedRequest['_value']);
        break;
    case 'info':
        /**
         * TODO nao consigo pegar a id quem vem na requisiçao... investigar userList.vue
         * TODO - continuar aqui, no userCOntroller.php e userRepository.php
         */
        $response = call_user_func(array(new \API\controllers\userController, 'getUser'), (int)$recievedRequest);
        break;
}
