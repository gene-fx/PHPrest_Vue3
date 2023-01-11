<?php

namespace API\dataAccess;

require_once $_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/dataaccess/data/dbcontext.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/logs/logMaker.php';

class user extends dbcontext
{
    public static $_connDb;

    public static $_logMaker;

    public function __construct()
    {
        $temp = new dbcontext();
        self::$_connDb = $temp::$conn;
        self::$_logMaker = new \API\logs\logMaker;
    }

    public function getUsers()
    {
        $sql = 'SELECT users.id, users.name, users.email, user_role.role FROM users 
            LEFT JOIN user_role ON users.user_role = user_role.id';
        $teste = self::$_connDb;
        $data = $teste->query($sql);
        $data = $data->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function getUserByEmail($loginData)
    {
        $email = $loginData['user'];
        $pass = $loginData['pass'];

        if (empty($email) || empty($pass)) {
            return;
        }

        $sql = "SELECT * FROM users WHERE email = '{$email}'";

        try {
            $userData = self::$_connDb->query($sql);
            $userData = $userData->fetch_assoc();
            self::$_logMaker->logMaker('Consulta a usuário por email - LOGIN', 'dbConnectionLogs', 'sqlLogs');

            if (password_verify($pass, $userData['pass'])) {
                session_start();
                $_SESSION['user'] = $userData['name'];
                $_SESSION['email'] = $userData['email'];
                $_SESSION['user_role'] = $userData['user_role'];
                return array('login' => 'UserLoggedIn');
            }
        } catch (\Exception $e) {
            self::$_logMaker->logMaker('ERROR ->' . $e->getMessage(), 'dbConnectionLogs', 'sqlLogs');
            return http_response_code(400);
        }
    }

    public function getUserById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = ' . $id;

        try {
            $userData = self::$_connDb->query($sql);
            $userData = $userData->fetch_assoc();
            self::$_logMaker->logMaker('Consulta a usuário por ID - GETUSERBYID', 'dbConnectionLogs', 'sqlLogs');
            return $userData;
        } catch (\Exception $e) {
            self::$_logMaker->logMaker('ERROR ->' . $e->getMessage(), 'dbConnectionLogs', 'sqlLogs');
            return http_response_code(400);
        }
    }

    public function addUser($user)
    {
        if (empty($user['nome']) || empty($user['email']) || empty($user['pass'])) {
            return;
        }
        $name = htmlspecialchars($user['nome']);
        $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
        $pass = password_hash($user['pass'], PASSWORD_DEFAULT);
        $user_role = $user['user_role'];

        $sql = "INSERT INTO users (name, email, pass, user_role) VALUE ('{$name}', '{$email}', '{$pass}', '{$user_role}')";

        try {
            self::$_connDb->query($sql);
            self::$_logMaker->logMaker('USER SUCCESSFULLY ADDED', 'dbConnectionLogs', 'sqlLogs');
            echo json_encode(array('data' => 'success', 'code' => http_response_code(201)));
        } catch (\Exception $e) {
            self::$_logMaker->logMaker('ERRO-> ' . $e->getMessage(), 'dbConnectionLogs', 'sqlLogs');
            return http_response_code(400);
        }
    }
}
