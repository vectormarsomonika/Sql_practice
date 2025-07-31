<?php

namespace App\classes;

require_once __DIR__ . '/../../config.php';

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


    public function query($query, $params)
    {

        // Logolás : dátum -  query- params

        return $this->prepare($query, $params);
    }

    public function prepare($query, $params): array
    {
        $stmtData = sqlsrv_query($this->connection, $query, $params);

        if ($stmtData === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmtData, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data ?? [];
    }


}