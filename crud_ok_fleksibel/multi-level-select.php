<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Data</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <header>
        <h1>Resident Data</h1>
    </header>

    <main>
        <!-- Region selection combo boxes -->
        <label for="selectProvinsi">Provinsi:</label>
        <select id="selectProvinsi" class="form-control"></select>

        <label for="selectKabupaten">Kabupaten:</label>
        <select id="selectKabupaten" class="form-control"></select>

        <label for="selectKecamatan">Kecamatan:</label>
        <select id="selectKecamatan" class="form-control"></select>

        <label for="selectDesa">Desa:</label>
        <select id="selectDesa" class="form-control"></select>

        <label for="selectDusun">Dusun:</label>
        <select id="selectDusun" class="form-control"></select>

        <!-- Resident data table -->
        <h2>Resident Data</h2>
        <table id="residentTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <!-- Resident data will be dynamically loaded here -->
            </tbody>
        </table>
    </main>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Add Bootstrap JS if needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Update options for the next levels based on selection
            $('#selectProvinsi').change(function() {
                var selectedProvinsi = $(this).val();
                updateRegionOptions(selectedProvinsi, 'kabupaten', 'selectKabupaten');
            });

            function updateRegionOptions(parentID, table, selectID) {
                $.ajax({
                    type: 'POST',
                    url: 'getData.php',
                    data: { parentID: parentID, table: table },
                    success: function(response) {
                        var regions = JSON.parse(response);

                        // Check if regions is an array before using forEach
                        if (Array.isArray(regions)) {
                            var options = '<option value="">Select</option>';
                            regions.forEach(function(region) {
                                options += '<option value="' + region.id + '">' + region.name + '</option>';
                            });
                            $('#' + selectID).html(options);
                        } else {
                            console.error('Invalid response format from getData.php');
                        }
                    },
                    error: function() {
                        alert('Error fetching region data');
                    }
                });
            }

            // Initial load for the first level (provinsi)
            updateRegionOptions(null, 'provinsi', 'selectProvinsi');

            $('#selectKabupaten').change(function() {
                var selectedKabupaten = $(this).val();
                updateRegionOptions(selectedKabupaten, 'kecamatan', 'selectKecamatan');
            });

            $('#selectKecamatan').change(function() {
                var selectedKecamatan = $(this).val();
                updateRegionOptions(selectedKecamatan, 'desa', 'selectDesa');
            });

            $('#selectDesa').change(function() {
                var selectedDesa = $(this).val();
                updateRegionOptions(selectedDesa, 'dusun', 'selectDusun');
            });

            // Load resident data based on the selected regions
            $('#selectDusun').change(function() {
                var selectedDusun = $(this).val();

                // Fetch resident data based on selected regions
                $.ajax({
                    type: 'POST',
                    url: 'getResidentData.php', // Replace with your PHP script handling resident data
                    data: { dusunID: selectedDusun },
                    success: function(response) {
                        var residents = JSON.parse(response);
                        displayResidentData(residents);
                    },
                    error: function() {
                        alert('Error fetching resident data');
                    }
                });
            });

            // Function to display resident data in the table
            function displayResidentData(residents) {
                var residentTable = $('#residentTable tbody');
                residentTable.empty();

                residents.forEach(function(resident) {
                    var row = '<tr>';
                    row += '<td>' + resident.id + '</td>';
                    row += '<td>' + resident.name + '</td>';
                    row += '<td>' + resident.address + '</td>';
                    // Add more columns as needed
                    row += '</tr>';
                    residentTable.append(row);
                });
            }
        });
    </script>
</body>
</html>
