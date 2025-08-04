<?php

namespace App\modules;

use App\classes\Database;

class UgyfelList
{

    public static function getUgyfelTemplate(): string
    {
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../src/templates/UgyfelList.html");
    }
    public static function getUgyfelFormTemplate(): string
    {
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../src/templates/UgyfelForm.html");
    }

    public static function getJs(): string{
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../src/assets/UgyfelList.js");
    }

    public function getUgyfelek($start = 0, $length = 10, $searchValue = null)
    {
        $params = [];
        $sqlData = "SELECT UGYFELKOD, UGYFNEV, TUTCA, BANKKOD, PENZNEM, Besorolas 
                FROM ugyfel";

        if (!empty($searchValue)) {
            $sqlData .= " WHERE UGYFELKOD LIKE ? OR UGYFNEV LIKE ?";
            $params[] = '%' . $searchValue . '%';
            $params[] = '%' . $searchValue . '%';
        }

        $sqlData .= " ORDER BY UGYFELKOD OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $params[] = $start;
        $params[] = $length;

        $database = new Database();
        $data = $database->query($sqlData, $params);

        return $data;
    }
}