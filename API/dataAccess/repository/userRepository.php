<?php

namespace API\dataAccess;

require_once $_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/dataaccess/data/dbcontext.php';

class user extends dbcontext
{
    public static $_connDb;

    public function __construct()
    {
        $temp = new dbcontext();
        self::$_connDb = $temp::$conn;
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
}
