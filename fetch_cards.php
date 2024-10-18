<?php
// Database connection details
$host = 'localhost';
$dbname = 'gomutv';
$username = 'root';  // Update with your MySQL username
$password = '';      // Update with your MySQL password

try {
    // Establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the search term from the query parameters
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    if ($searchTerm) {
        // Fetch cards that match the search term in title or description
        $stmt = $pdo->prepare("SELECT * FROM cards WHERE title LIKE :search OR description LIKE :search LIMIT 20");
        $stmt->execute(['search' => "%$searchTerm%"]);
    } else {
        // Fetch all cards if no search term is provided
        $stmt = $pdo->query("SELECT * FROM cards LIMIT 20");
    }

    // Prepare the cards data as an array
    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data in JSON format
    echo json_encode($cards);

} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
