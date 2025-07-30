<?php

define('ROOT', substr(($_SERVER['DOCUMENT_ROOT'] ?? ""), 0, 0));

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/modules/CikkList.php';

use App\modules\CikkList;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DataTables MSSQL</title>

</head>
<body>
<button id="btnCikkekTable">Ügyfelek</button>
<button id="btnUgyfelekTable">Cikkek</button>
<?php

print CikkList::getTemplate();
?>

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#cikkekTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": "api/cikkData.php",
            "columns": [
                {"data": "ETK"},
                {"data": "CIKKNEV1"},
                {"data": "Kiszereles"},
                {"data": "MEROV1"},
                {"data": "CUTBESZAR"},
                {"data": "CUTBEDN"}

            ]
        });
    });
</script>
</html>
