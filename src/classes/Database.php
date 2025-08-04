<?php

namespace App\classes;

require_once __DIR__ . '/../../config.php';

use config\config;

class Database
{

    protected $_connection = false;
    protected $_connectionInfo = [];
    public function __construct()
    {
        $this->_connectionInfo = array(
            "UID" => config::DB_LOGIN,
            "PWD" => config::DB_PASSWORD,
            "Database" => config::DB_CATALOG,
            "APP" => "WebVectory",
            "MultipleActiveResultSets" => false,
            'CharacterSet' => 'UTF-8',
            "Encrypt" => 1,
            "TrustServerCertificate" => 1
        );

    }

    /**
     * @return false|resource
     */
    protected function getConnection(){
        if(empty($this->_connection)){
            $this->_connection = sqlsrv_connect(config::DB_HOST, $this->_connectionInfo);

        }
        return $this->_connection;
    }


    public function query($query, $params)
    {

        $connection = $this->getConnection();
        if(empty($connection)){
            return false;
        }

        return $this->prepare($connection, $query, $params);
    }

    public function prepare($connection,$query, $params): array
    {
        $stmtData = sqlsrv_query($connection, $query, $params);

        if ($stmtData === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmtData, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data ?? [];
    }

    public function execute(string $query, array $params = []): array | bool
    {
        $connection = $this->getConnection();
        if(empty($connection)){
            return false;
        }

        $stmt = sqlsrv_query($connection, $query, $params);

        if ($stmt === false) {
            $errors = sqlsrv_errors();
            $message = "SQL Server Error: " . print_r($errors, true);
            throw new \RuntimeException($message);
        }

        return true;
    }


}