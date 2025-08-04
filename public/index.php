<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';
use App\classes\DebugBarSingleton;
use App\modules\CikkList;
use App\modules\UgyfelList;

$debugbar = \App\classes\debugBarSingleton::getDebugBar();


$debugbar["messages"]->addMessage("DebugBar működik!");

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

if (str_starts_with($path, '/api/')) {
    $apiName = basename($path, '.php');
    $apiPath = __DIR__ . '/../src/api/' . $apiName . '.php';

    if (file_exists($apiPath)) {
        require_once $apiPath;
        exit;
    }

    http_response_code(404);
    try {
        echo json_encode(['error' => 'API not found'], JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        echo '{"error": "JSON encoding error"}';
    }
    exit;
}



?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>DataTables MSSQL</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
    <?php   echo $debugbar->getJavascriptRenderer()->renderHead(); ?>
</head>
<body>
<button id="form-btn" type="button" class="btn btn-primary">
    Új ügyfél hozzáadása
</button>
<?php print UgyfelList::getUgyfelFormTemplate(); ?>
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


<script>
    $(document).ready(function () {
        $('#form-btn').click(function () {
            $('#formModal').modal('show');
        });
    });

    <?php
    print CikkList::getJs();
    print UgyfelList::getJs();
    ?>
</script>
<?php echo $debugbar->getJavascriptRenderer()->render(); ?>
<script src="js/ugyfel.js"></script>

</body>
</html>