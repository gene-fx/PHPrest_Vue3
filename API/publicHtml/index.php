<?php

header('Content-Type: application/json');

require_once '../controllers/userController.php';


use API\controllers\userController;


$url = explode('/', $_GET['url']);

$controller = new userController();

switch ($url['0']) {
    case 'users':
        try {
            $response = call_user_func(array(new \API\controllers\userController, 'getAll'));
            echo json_encode(array('data' => $response));
        } catch (\Exception $e) {
            $logMaker = new \API\logs\logMaker;
            $logMaker->logMaker('ERRO DE CONEXAO -> ' . $e, 'APIConnectionLogs', 'APIConnectionLog');
        }
        break;
}
