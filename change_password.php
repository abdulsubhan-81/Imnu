<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }
require 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = $_POST['old_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $email = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();
    $stmt->close();
    if (!$hash || !password_verify($old, $hash)) echo "<script>alert('Old password incorrect');</script>";
    elseif ($new !== $confirm) echo "<script>alert('New passwords do not match');</script>";
    else {
        $newHash = password_hash($new, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $newHash, $email);
        if ($stmt->execute()) { echo "<script>alert('Password updated');window.location='account.php';</script>"; exit(); }
        else echo "<script>alert('Update failed');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/change_password.css">
</head>
<body>
<div class="password-container">
    <h1>Change Password</h1>
    <form method="POST">
        <label>Old Password</label>
        <input type="password" name="old_password" required>
        <label>New Password</label>
        <input type="password" name="new_password" required>
        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" required>
        <button class="btn" type="submit">Update Password</button>
        <a class="btn cancel" href="account.php">Cancel</a>
    </form>
</div>
</body>
</html>