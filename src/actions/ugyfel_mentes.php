<?php

use App\classes\Database;

require_once __DIR__ . '/../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kod = $_POST['kod'] ?? null;
    $nev = $_POST['nev'] ?? '';
    $ugyfelNev = $_POST['ugyfelNev'] ?? '';
    $fizmodVevo = $_POST['fizetesiModVevo'] ?? '';
    $fizmodSzallito = $_POST['fizetesiModSzallito'] ?? '';
    $irsz = $_POST['irsz'] ?? '';
    $utca = $_POST['utcaHazSzam'] ?? '';
    $adoszam = $_POST['adoSzam'] ?? '';
    $bankszamla = $_POST['bankszamlaSzam'] ?? '';
    $kozpontKod = $_POST['kozpontKod'] ?? '';
    $besorolas = $_POST['besorolas'] ?? '';
    $kapcsolok = $_POST['kapcsolok'] ?? 0001020;

    try {
        $db = new Database();
        $sql = "INSERT INTO ugyfel 
                (UGYFELKOD, UGYFNEV, UGYFTNEV, FIZMOD, SFIZMOD, TCIMKOD, TUTCA, UGYFADOSZ, BANKKOD, VEVOKOD, BESOROLAS, KAPCSOLOK) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $kod,
            $nev,
            $ugyfelNev,
            $fizmodVevo,
            $fizmodSzallito,
            $irsz,
            $utca,
            $adoszam,
            $bankszamla,
            $kozpontKod,
            $besorolas,
            $kapcsolok
        ];

        $db->execute($sql, $params);
        echo "Mentés sikerült, params: " . print_r($params, true);
        echo 'Sikeres mentés';
    } catch (Exception $e) {
        http_response_code(500);
        echo 'Hiba: ' . $e->getMessage();
    }

    exit;
}

http_response_code(405);
echo 'Nem támogatott kérés';
exit;