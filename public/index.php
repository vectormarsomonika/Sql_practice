<?php


$requestUri = $_SERVER['REQUEST_URI'];

if (str_starts_with($requestUri, '/api/ugyfelData')) {
    require_once __DIR__ . '/../src/api/ugyfelData.php';
    exit;
}

if (str_starts_with($requestUri, '/api/cikkData')) {
    require_once __DIR__ . '/../src/api/cikkData.php';
    exit;
}

// Ha nem API, akkor jöhet a normál oldal betöltés
define('ROOT', substr(($_SERVER['DOCUMENT_ROOT'] ?? ""), 0, 0));

require_once __DIR__ . '/../src/modules/CikkList.php';
require_once __DIR__ . '/../src/modules/UgyfelList.php';

use App\modules\CikkList;
use App\modules\UgyfelList;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DataTables MSSQL</title>

</head>
<body>
<button id="btnCikkekTable">Cikkek</button>
<button id="btnUgyfelekTable">Ügyfelek</button>
<?php
print UgyfelList::getUgyfelTemplate();
print CikkList::getCikkTemplate();
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script>

    $(document).ready(function () {
        $('#btnCikkekTable').click(function () {
            $('#cikkTableBox').show();
            $('#ugyfelTableBox').hide()
        })
        $('#btnUgyfelekTable').click(function () {
            $('#ugyfelTableBox').show();
            $('#cikkTableBox').hide();
        })
        <?php
        print CikkList::getJs();
        print UgyfelList::getjs();
        ?>
    });
</script>
</html>
