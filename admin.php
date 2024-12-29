<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="admin.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $dsn = 'mysql:host=localhost;dbname=finalproject';
        $pdo = new PDO($dsn, 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $stmt = $pdo->prepare('SELECT password FROM user WHERE username = :username');
        $stmt->execute(['username' => $username]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();

            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                header('Location: admin-panel.php');
                exit();
            } else {
                echo '<p>Invalid username or password.</p>';
            }
        } else {
            echo '<p>Invalid username or password.</p>';
        }
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}
?>
