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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
</head>
<body>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#cikkTableBox">Cikk</a></li>
    <li><a data-toggle="tab" href="#ugyfelTableBox">Ügyfél</a></li>
</ul>

<div class="tab-content">
    <div id="cikkTableBox" class="tab-pane fade in active">
        <?php print CikkList::getCikkTemplate(); ?>
    </div>
    <div id="ugyfelTableBox" class="tab-pane fade">
        <?php print UgyfelList::getUgyfelTemplate(); ?>
    </div>
</div>

<!-- Scripts: jQuery → Bootstrap → DataTables -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

<script>
    $(document).ready(function () {
        // A Bootstrap data-toggle automatikusan kezeli a tab váltást
        // Nem szükséges: $(...).tab('show')
    });

    <?php
    print CikkList::getJs();
    print UgyfelList::getjs();
    ?>
</script>

</body>
</html>