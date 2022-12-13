<?php

namespace API\logs;

class logMaker
{
    public function logMaker($message, $folderName, $fileName)
    {
        $logsPath =
            $_SERVER['DOCUMENT_ROOT'] . '/osoriostreetblog/api/logs/' . $folderName . '/';

        $file = fopen($logsPath . $fileName . 'txt', "a");

        date_default_timezone_set('America/Sao_Paulo');

        $log = date('d-m-Y--h:i:s A') . ' LOG ->' . $message . PHP_EOL;

        if ($file) {
            fwrite($file, $log);
            fclose($file);
        }
    }
}
