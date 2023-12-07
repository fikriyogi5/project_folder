<?php
// Include or require your class/file containing the read function
require_once 'YourClassOrFile.php';

// Instantiate your class (assuming it has a database connection)
$yourClass = new YourClass();

// Specify the table name and optional condition and where clause
$tableName = 'your_table_name'; // Replace with your actual table name
$condition = 'column_name = :value'; // Replace with your actual condition
$where = ['ORDER BY column_name ASC', 'LIMIT 10']; // Replace with your actual where clause

// Call the read function
$result = $yourClass->read($tableName, $condition, $where);

// Check the result and handle accordingly
if (isset($result['error'])) {
    echo 'Error: ' . $result['error'];
} else {
    // Process the result data (assuming it's an array of records)
    foreach ($result as $record) {
        // Do something with each record
        echo 'ID: ' . $record['id'] . ', Name: ' . $record['name'] . '<br>';
    }
}
?>


<?php
// Include or require your class/file containing the read function
require_once 'YourClassOrFile.php';

// Instantiate your class (assuming it has a database connection)
$yourClass = new YourClass();

// Specify the table name
$tableName = 'your_table_name'; // Replace with your actual table name

// Fetch all data from the specified table
$resultAll = $yourClass->read($tableName);
echo '<h2>Data Results (fetchAll)</h2>';
print_r($resultAll);

// Fetch one row based on a condition
$condition = 'column_name = :value'; // Replace with your actual condition
$resultOne = $yourClass->read($tableName, $condition, [], 'fetch');
echo '<h2>Data Result (fetch)</h2>';
print_r($resultOne);
?>
