


$('#ugyfelekTable').DataTable({
    "processing": true,
    "serverSide": true,
    "responsive": true,
    "ajax": "api/ugyfelData.php",
    "columns": [
        {"data": "UGYFELKOD"},
        {"data": "UGYFNEV"},
        {"data": "TUTCA"},
        {"data": "BANKKOD"},
        {"data": "PENZNEM"},
        {"data": "Besorolas"}
    ]
});
