<?php
// Assume you have a database connection established
require_once '../Load.php';

if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
    // Assuming $crud is an instance of your CRUD class
    $dataByNIK = $crud->viewRecords('users', PDO::FETCH_ASSOC, null, $nik);


    // Return data as JSON
    echo json_encode($data);
} else {
    // Handle the case when nik is not set
    echo json_encode(['error' => 'NIK not provided']);
}
?>
