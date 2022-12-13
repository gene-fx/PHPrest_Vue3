<?php

namespace API\dataAccess;

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("BASE", "osoriostreetblog");

require_once($_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/logs/logMaker.php');

class dbcontext
{
    public static $conn;

    public static $logMaker;

    function __construct()
    {
        self::$logMaker = new \API\logs\logMaker;

        try {
            self::$conn = new \mysqli(HOST, USER, PASS, BASE);
            self::$logMaker->logMaker('Conexão estabelecida com sucesso!', 'dbConnectionLogs', 'connectionLog');
        } catch (\Exception $e) {
            self::$logMaker->logMaker('ERRO - ' . $e->getMessage(), 'dbConnectionLogs', 'connectionLog');
        }
    }
}

// if ($conn->connect_errno) {
//     echo "Failed to connect to MySQL: (" .
//         $conn->connect_errno .
//         ") " .
//         $conn->connect_errno;
// }
