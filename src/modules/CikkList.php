<?php

namespace App\modules;
use App\classes\Database;

class CikkList
{

    /**
     * @return string
     */
    public static function getCikkTemplate(): string
    {
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../src/templates/CikkList.html");

    }


    public static function getJs(): string{
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../src/assets/CikkList.js");
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

        $database = new Database();
        $data = $database->query($sqlData, $params);

        return $data;
    }
}