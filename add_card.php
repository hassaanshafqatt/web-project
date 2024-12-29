<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $link = $_POST['link'];

    if (!empty($title) && !empty($description) && !empty($image_url) && !empty($link)) {
        $conn = new mysqli('localhost', 'root', '', 'gomutv');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO cards (title, description, image_url, link) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $image_url, $link);

        if ($stmt->execute()) {
            echo "New card added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}
?>
