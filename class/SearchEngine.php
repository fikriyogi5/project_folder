<?php
require_once 'Database.php'; // Include the Database class
class SearchEngine {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function search($query) {
        $articleResults = $this->searchInTable('articles', 'title', $query);
        $imageResults = $this->searchInTable('images', 'description', $query);
        $videoResults = $this->searchInTable('videos', 'title', $query);

        // Aggregate and return the results
        return [
            'articles' => $articleResults,
            'images' => $imageResults,
            'videos' => $videoResults,
        ];
    }

    private function searchInTable($table, $column, $query) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column LIKE :query");
        $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function filterData($table, $filterField, $filterValue)
    {
        // Melakukan query untuk mengambil data berdasarkan filter
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $filterField LIKE :filterValue");
        $filterValue = "%$filterValue%"; // Menambahkan wildcard (%) agar mencari nilai yang cocok
        $stmt->bindParam(':filterValue', $filterValue, PDO::PARAM_STR);
        $stmt->execute();

        // Mengambil hasil query sebagai array asosiatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}

// // Usage
// try {
//     $pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
//     $searchEngine = new SearchEngine($pdo);

//     $query = isset($_GET['q']) ? $_GET['q'] : '';

//     if (!empty($query)) {
//         $results = $searchEngine->search($query);

//         // Display the results
//         echo '<h2>Article Results</h2>';
//         print_r($results['articles']);

//         echo '<h2>Image Results</h2>';
//         print_r($results['images']);

//         echo '<h2>Video Results</h2>';
//         print_r($results['videos']);
//     }
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }
?>