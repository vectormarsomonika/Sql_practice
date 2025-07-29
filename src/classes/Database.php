<?php

namespace App\classes;


use Dotenv\Dotenv;

class Database
{
    private $connection;

    public function __construct()
    {


        $serverName = 'GEP0174';
        $connectionInfo = array(
            "UID" => 'web',
            "PWD" => 'web123',
            "Database" => 'vyw_6029',
            "APP" => "WebVectory",
            "MultipleActiveResultSets" => false,
            'CharacterSet' => 'UTF-8',
            "Encrypt" => 1,
            "TrustServerCertificate" => 1
        );
        $this->connection = sqlsrv_connect($serverName, $connectionInfo);

        if (!$this->connection) {
            $errors = sqlsrv_errors();
            $errorMessage = "Connection to database failed:\n" . print_r($errors, true);
            throw new \RuntimeException($errorMessage);
        }


    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function destruct()
    {
        if ($this->connection) {
            sqlsrv_close($this->connection);
        }
    }
}