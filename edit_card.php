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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $link = $_POST['link'];

    if (!empty($id) && !empty($title) && !empty($description) && !empty($image_url) && !empty($link)) {
        $stmt = $conn->prepare("UPDATE cards SET title = ?, description = ?, image_url = ?, link = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $image_url, $link, $id);

        if ($stmt->execute()) {
            echo "Movie updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT title, description, image_url, link FROM cards WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($title, $description, $image_url, $link);
        $stmt->fetch();

        $stmt->close();
    } else {
        $id = $title = $description = $image_url = $link = '';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Movie</h2>
        <form method="get" action="edit_card.php">
            <div class="form-group">
                <label for="movie">Select Movie:</label>
                <select name="id" id="movie" class="form-control" onchange="this.form.submit()">
                    <option value="">Select a movie</option>
                    <?php foreach ($movies as $movie): ?>
                        <option value="<?php echo htmlspecialchars($movie['id']); ?>" <?php if ($movie['id'] == $id) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($movie['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <?php if (!empty($id)): ?>
            <form method="post" action="edit_card.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" rows="5" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" class="form-control" name="image_url" id="image_url" value="<?php echo htmlspecialchars($image_url); ?>" required>
            </div>
            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" class="form-control" name="link" id="link" value="<?php echo htmlspecialchars($link); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Movie</button>
            </form>
        <?php endif; ?>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
