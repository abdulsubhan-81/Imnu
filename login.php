<?php
session_start();
require 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id,name,password,is_verified FROM user WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id,$name,$hash,$ver);
    if ($stmt->fetch()) {
        if ((int)$ver !== 1) { echo "<script>alert('Please verify your email first.');</script>"; }
        elseif (password_verify($password, $hash)) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['user_id'] = $id;
            header("Location: index1.php"); exit();
        } else echo "<script>alert('Invalid credentials');</script>";
    } else echo "<script>alert('Account not found');</script>";
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <label>Email</label><input type="email" name="email" required>
        <label>Password</label><input type="password" name="password" required>
        <button class="btn" type="submit">Login</button>
        <a class="btn secondary" href="signup.php">Create account</a>
        <a class="btn secondary" href="admin_login.php">Admin</a>
    </form>
</div>
</body>
</html>