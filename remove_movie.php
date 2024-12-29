<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: admin.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'gomutv');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$movies = [];
$result = $conn->query("SELECT id, title FROM cards");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM cards WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Movie removed successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Movie ID is required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Movie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Remove Movie</h2>
        <form method="post" action="remove_movie.php">
            <div class="form-group">
                <label for="movie">Select Movie:</label>
                <select name="id" id="movie" class="form-control">
                    <option value="">Select a movie</option>
                    <?php foreach ($movies as $movie): ?>
                        <option value="<?php echo htmlspecialchars($movie['id']); ?>">
                            <?php echo htmlspecialchars($movie['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Remove Movie</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
