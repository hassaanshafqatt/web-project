<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Admin Panel</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <button class="btn btn-primary btn-block" onclick="location.href='add_movie.php'">Add Movie</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-warning btn-block" onclick="location.href='edit_card.php'">Edit Movie</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger btn-block" onclick="location.href='remove_movie.php'">Remove Movie</button>
            </div>
            
        </div>
    <div class="row mt-4">
        <div class="col-md-4 offset-md-4">
            <button class="btn btn-secondary btn-block" onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
