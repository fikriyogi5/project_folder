<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Engine</title>
</head>
<body>

<h1>Search Engine</h1>

<form action="search.php" method="get">
    <label for="q">Search:</label>
    <input type="text" name="q" id="q" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>" required>
    <button type="submit">Search</button>
</form>

<?php
class SearchEngine {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function search($query) {
        $articleResults = $this->searchInTable('users', 'username', $query);
        $imageResults = $this->searchInTable('settings', 'setting_name', $query);
        $videoResults = $this->searchInTable('user_activities', 'user_id', $query);

        // Aggregate and return the results
        return [
            'users' => $articleResults,
            'settings' => $imageResults,
            'user_activities' => $videoResults,
        ];
    }

    private function searchInTable($table, $column, $query) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column LIKE :query");
        $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Usage
try {
    $pdo = new PDO("mysql:host=localhost;dbname=app", "root", "");
    $searchEngine = new SearchEngine($pdo);

    $query = isset($_GET['q']) ? $_GET['q'] : '';

    if (!empty($query)) {
        $results = $searchEngine->search($query);

        // Display the results
        echo '<h2>Article Results</h2>';
        print_r($results['users']);

        echo '<h2>Image Results</h2>';
        print_r($results['settings']);

        echo '<h2>Video Results</h2>';
        print_r($results['user_activities']);
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

</body>
</html>
