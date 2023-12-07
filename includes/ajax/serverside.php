<?php
include '../../class/Database/Database.php';

$dbConfig = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'desaku',
);

$db = new Database($dbConfig);

// Tabel yang akan diambil data-nya
$table = $_GET['table']; // Ambil nama tabel dari permintaan

// Kolom yang akan ditampilkan dalam hasil DataTable
$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'nik', 'dt' => 1),
    array('db' => 'alamat', 'dt' => 2),
    array('db' => 'tanggal_lahir', 'dt' => 3)
);

// Query untuk mengambil data dari tabel
$query = "SELECT " . implode(', ', array_column($columns, 'db')) . " FROM $table";

// Implement WHERE conditions, searching, etc., if needed


// Lakukan pengolahan tambahan sesuai kebutuhan, seperti filter dan sorting
if (!empty($_GET['search']['value'])) {
    $query .= " WHERE nama LIKE :search_value OR nik LIKE :search_value";
}

if (!empty($_GET['order'])) {
    $column = $columns[$_GET['order'][0]['column']];
    $query .= " ORDER BY " . $column['db'] . " " . $_GET['order'][0]['dir'];
}
// Hitung jumlah data keseluruhan sebelum filtering (tanpa LIMIT)
$totalData = $db->query("SELECT COUNT(*) FROM $table")->fetchColumn();

// Hitung jumlah data setelah filtering (jika ada filtering)
$queryFiltered = $db->prepare($query);
if (!empty($_GET['search']['value'])) {
    $searchValue = '%' . $_GET['search']['value'] . '%';
    $queryFiltered->bindParam(':search_value', $searchValue, PDO::PARAM_STR);
}
$queryFiltered->execute();
$totalFiltered = $queryFiltered->rowCount();


// Batasi data yang ditampilkan berdasarkan paging
$query .= " LIMIT " . $_GET['start'] . ", " . $_GET['length'];

// Eksekusi query untuk mengambil data
$stmt = $db->query($query);

$data = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// Format respons JSON yang akan dikirimkan ke DataTables
$response = array(
    'draw' => intval($_GET['draw']),
    'recordsTotal' => $totalData,
    'recordsFiltered' => $totalFiltered,
    'data' => $data
);

echo json_encode($response);
?>
