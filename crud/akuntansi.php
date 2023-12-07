<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Ambil semua transaksi
$transactions = $crud->readAllRecords("transactions", PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akuntansi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Akuntansi</h1>
    <a href="tambah_transaksi.php">Tambah</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $saldo = 0;

            foreach ($transactions as $transaction) :
                $saldo += $transaction['debit'] - $transaction['kredit'];
            ?>
                <tr>
                    <td><?php echo $transaction['id']; ?></td>
                    <td><?php echo $transaction['tanggal']; ?></td>
                    <td><?php echo $transaction['keterangan']; ?></td>
                    <td><?php echo $transaction['debit']; ?></td>
                    <td><?php echo $transaction['kredit']; ?></td>
                    <td><?php echo $saldo; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
