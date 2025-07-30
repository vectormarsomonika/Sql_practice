<?php

namespace App\modules;
class CikkList
{

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/src/templates/CikkList.html");

    }

}