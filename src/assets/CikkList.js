
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