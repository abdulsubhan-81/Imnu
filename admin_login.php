<?php
session_start();
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin_panel.php");
    exit();
}

require 'db_config.php';  // make sure $conn is available

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['admin_email']);
    $pass  = $_POST['admin_password'];

    // prepare statement
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE email = ? LIMIT 1");
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($aid, $hash);

    if ($stmt->fetch()) {
        // verify password
        if (password_verify($pass, $hash)) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_id'] = $aid;
            header("Location: admin_panel.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('Invalid email');</script>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin_login.css">
</head>
<body>
<div class="login-container">
    <h1>Admin Login</h1>
    <form method="POST">
        <label>Email</label>
        <input type="email" name="admin_email" required>
        <label>Password</label>
        <input type="password" name="admin_password" required>
        <button class="btn" type="submit">Login</button>
    </form>
</div>
</body>
</html>
