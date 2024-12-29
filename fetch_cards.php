<?php
$host = 'localhost';
$dbname = 'gomutv';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    if ($searchTerm) {
        $stmt = $pdo->prepare("SELECT * FROM cards WHERE title LIKE :search OR description LIKE :search LIMIT 20");
        $stmt->execute(['search' => "%$searchTerm%"]);
    } else {
        $stmt = $pdo->query("SELECT * FROM cards LIMIT 20");
    }

    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cards);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
