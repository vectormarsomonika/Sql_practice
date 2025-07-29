<?php

use App\classes\Database;
use App\classes\repositories\CikkRepository;
require_once __DIR__ . '/../../vendor/autoload.php';

$db = new Database();
$conn = $db->getConnection();
$repo = new CikkRepository($conn);

$start = $_GET['start'] ?? 0;
$length = $_GET['length'] ?? 10;
$searchValue = $_GET['search']['value'] ?? null;

$data = $repo->getCikkek((int)$start, (int)$length,$searchValue);

header('Content-Type: application/json');
echo json_encode([
    "recordsTotal" => 1000,
    "recordsFiltered" => 1000,
    "data" => $data
]);