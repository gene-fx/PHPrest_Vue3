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
        $sql = 'SELECT * FROM users';
        $teste = self::$_connDb;
        $data = $teste->query($sql);
        $data = $data->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function getUser(int $id)
    {
    }

    public function addUser($user)
    {
        $sql = 'INSERT INTO "users"("name", "email", "pass", "user_role") 
        VALUES (' . $user['nome'] . ',' . $user['email'] . ',' . $user['pass'] . ',"2")';

        echo $sql;

        try {
            $stmt = self::$_connDb->prepare($sql);
            $stmt->execute();
            self::$_logMaker->logMaker('USER SUCCESSFULLY ADDED', 'dbConnectionLogs', 'sqlLogs');
        } catch (\Exception $e) {
            self::$_logMaker->logMaker('ERRO AO ADICIONAR USUARIO -> ' . $e->getMessage(), 'dbConnectionLogs', 'sqlLogs');
        }
    }
}
