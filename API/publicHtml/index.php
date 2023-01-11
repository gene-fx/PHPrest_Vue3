<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../controllers/userController.php';
require_once '../controllers/userRoleController.php';

$recievedRequest = json_decode(file_get_contents('php://input'), true);

$url = explode('/', $_REQUEST['url']);

switch ($url['0']) {
        //!----------------------------------USERS
    case 'users':
        $response = call_user_func(array(new \API\controllers\userController, 'getAll'));
        echo json_encode($response);
        break;
    case 'addUser':
        $response = call_user_func(array(new \API\controllers\userController, 'addUser'), $recievedRequest['_value']);
        break;
    case 'userInfo':
        $response = call_user_func(array(new \API\controllers\userController, 'getUser'), $recievedRequest);
        echo json_encode($response);
        break;
    case 'login':
        $response = call_user_func(array(new \API\controllers\userController, 'getUser'), $recievedRequest);
        echo json_encode($response);
        break;
        //!----------------------------------ROLES
    case 'roles':
        $response = call_user_func(array(new \API\controllers\userRoleController, 'getAll'));
        echo json_encode($response);
        break;
}
