
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Server-Side Processing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
</head>

<body>
    <h2>DataTables Server-Side Processing Example</h2>

    <table id="userTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modal for displaying detailed information -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "datatable-serverside-server.php", // Adjust the path to your PHP script
                "columns": [
                    { "data": "id" },
                    { "data": "nama" },
                    { "data": "nik" },
                    { "data": "kk" }
                ]
            });
        });
    </script> -->
    <script>
        $(document).ready(function () {
            var table = $('#userTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "ajax/datatable-serverside-server.php",
                    "type": "POST",
                    "data": {
                        "table": "warga", // Ganti dengan nama tabel yang diinginkan
                        "columns": ["id", "nama", "nik", "kk", "status"],
                        "links": ["nama", "nik"]
                    }
                },
                "columns": [
                    { "data": "id" },
                    {
                        "data": "nama",
                        "render": function (data, type, row) {
                            return type === 'display' || type === 'filter' ? data : $('<div>').html(data).text();
                        }
                    },
                    {
                        "data": "nik",
                        "render": function (data, type, row) {
                            return type === 'display' || type === 'filter' ? data : $('<div>').html(data).text();
                        }
                    },
                    { "data": "kk" },
                    { "data": "status" }
                ]
            });


            		// Handle radio button click for user status change
                    $('#userTable tbody').on('change', '.statusRadio', function () {
                        var userId = $(this).data('id');
                        var newStatus = $(this).val();

                        // Display a message before clicking
                        alert('Changing status for user ID ' + userId + ' to ' + newStatus);

                        // Send AJAX request to update user status
                        $.ajax({
                            type: 'POST',
                            url: 'ajax/updateStatus.php', // Adjust the path to your PHP script handling status updates
                            data: { id: userId, status: newStatus },
                            success: function (response) {
                                // Display a message after the status is updated
                                alert('Status for user ID ' + userId + ' updated to ' + newStatus);
                            },
                            error: function () {
                                alert('Error updating status');
                            }
                        });
                    });

            // Handle row click to open modal
            $('#userTable tbody').on('click', 'tr', function () {
                var data = table.row(this).data();
                openModal(data);
            });

            // Close the modal when clicking the close button
            $('.close').click(function () {
                closeModal();
            });
        });

        // Function to open the modal with detailed information
        function openModal(data) {
            $('#modalContent').html('<p>ID: ' + data.id + '</p><p>Nama: ' + data.nama + '</p><p>NIK: ' + data.nik + '</p>');
            $('#userModal').show();
        }

        // Function to close the modal
        function closeModal() {
            $('#modalContent').html('');
            $('#userModal').hide();
        }
    </script>
</body>

</html>
