
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DataTables MSSQL</title>

</head>
<body>
<table id='cikkekTable'>
    <thead>
    <tr>
        <th>Cikkszám</th>
        <th>Cikknév</th>
        <th>Kiszerelés</th>
        <th>Mérték egység</th>
        <th>Beszerzési ár</th>
        <th>Pénznem</th>
    </tr>
    </thead>
</table>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cikkekTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "api/cikkData.php",
            "columns": [
                { "data": "ETK" },
                { "data": "CIKKNEV1" },
                { "data": "Kiszereles" },
                { "data": "MEROV1" },
                { "data": "CUTBESZAR" },
                { "data": "CUTBEDN" }

            ]
        });
    });
</script>
</html>
