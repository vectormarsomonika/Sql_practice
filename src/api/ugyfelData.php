<?php


require_once __DIR__ . '/../../vendor/autoload.php';

$repo = new \App\modules\UgyfelList();

$start = $_GET['start'] ?? 0;
$length = $_GET['length'] ?? 10;
$searchValue = $_GET['search']['value'] ?? null;

$data = $repo->getUgyfelek((int)$start, (int)$length,$searchValue);

header('Content-Type: application/json');
try {
    echo json_encode([
        "recordsTotal" => 100,
        "recordsFiltered" => 100,
        "data" => $data
    ], JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
    throw new Exception($e->getMessage());

}