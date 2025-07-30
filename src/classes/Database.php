<?php

namespace App\classes;

require_once  __DIR__ . '/../../config.php';
use Dotenv\Dotenv;
use config\config;
class Database
{
    private $connection;

    public function __construct()
    {


        $connectionInfo = array(
            "UID" => config::DB_LOGIN,
            "PWD" => config::DB_PASSWORD,
            "Database" => config::DB_CATALOG,
            "APP" => "WebVectory",
            "MultipleActiveResultSets" => false,
            'CharacterSet' => 'UTF-8',
            "Encrypt" => 1,
            "TrustServerCertificate" => 1
        );
        $this->connection = sqlsrv_connect(config::DB_HOST, $connectionInfo);

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