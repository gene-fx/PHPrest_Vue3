<?php

namespace API\dataAccess;

require_once $_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/dataaccess/data/dbcontext.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/logs/logMaker.php';

class userRoleRepository
{
    public static $_connDb;

    public static $_logMaker;

    public function __construct()
    {
        $temp = new dbcontext();
        self::$_connDb = $temp::$conn;
        self::$_logMaker = new \API\logs\logMaker;
    }

    public function getRoles()
    {
        $sql = 'SELECT * FROM user_role';
        $teste = self::$_connDb;
        $data = $teste->query($sql);
        $data = $data->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}
