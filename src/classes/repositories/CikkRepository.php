<?php

namespace App\classes\repositories;


class CikkRepository
{

    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    public function getCikkek($start = 0, $length = 10, $searchValue = null)
    {
        $params = [];
        $sqlData = "SELECT ETK, CIKKNEV1, Kiszereles, MEROV1, CUTBESZAR, CUTBEDN 
                FROM cikk";

        if (!empty($searchValue)) {
            $sqlData .= " WHERE CIKKNEV1 LIKE ? OR ETK LIKE ?";
            $params[] = '%' . $searchValue . '%';
            $params[] = '%' . $searchValue . '%';
        }

        $sqlData .= " ORDER BY ETK OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $params[] = $start;
        $params[] = $length;

        $stmtData = sqlsrv_query($this->connection, $sqlData, $params);

        if ($stmtData === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $data = [];
        while ($row = sqlsrv_fetch_array($stmtData, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
}