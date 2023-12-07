<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script JavaScript -->
<script type="text/javascript">
$(document).ready(function() {
    // Fungsi yang dipanggil saat tombol filter diklik
    $('#filterButton').on('click', function() {
        // Ambil nilai filter dari input pengguna
        var filterValue = $('#filterInput').val();

        // Kirim permintaan AJAX ke file filter_data.php
        $.ajax({
            type: 'POST',
            url: 'includes/ajax/filter_data.php',
            data: {
                table: 'users',
                filterField: 'username',
                filterValue: filterValue
            },
            success: function(response) {
                // Proses dan tampilkan data dari respons JSON
                var table = "<table><tr><th>username</th><th>Usia</th></tr>";
                $.each(response, function(index, row) {
                    table += "<tr><td>" + row.username + "</td><td>" + row.password + "</td></tr>";
                });
                table += "</table>";
                $('#resultContainer').html(table);
            }
        });
    });
});
</script>

<!-- Input filter -->
<input type="text" id="filterInput" placeholder="Filter">
<button id="filterButton">Filter</button>

<!-- Container untuk menampilkan hasil -->
<div id="resultContainer"></div>
