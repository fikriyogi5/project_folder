<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill Form with Ajax</title>
</head>
<body>

    <label for="nik">NIK:</label>
    <input type="text" id="nik" name="nik" onchange="getDataByNIK()">

    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" readonly>

    <label for="kk">KK:</label>
    <input type="text" id="kk" name="kk" readonly>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat" readonly>

    <script>
        function getDataByNIK() {
            var nik = document.getElementById('nik').value;

            // Make an Ajax request
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('kk').value = data.kk;
                    document.getElementById('alamat').value = data.alamat;
                }
            };

            xhr.open("GET", "ajax/get_data.php?nik=" + nik, true);
            xhr.send();
        }
    </script>

</body>
</html>
