<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }
require 'db_config.php';
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
if (!$user) { echo "<script>alert('User not found');window.location='index1.php';</script>"; exit(); }
$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Account - IMNU Car Sharing</title>
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="account-container">
    <h1>My Account</h1>
    <table>
        <tr><th>Name</th><td><?php echo htmlspecialchars($user['name']); ?></td><td><a href="edit.php?field=name"><i class="fa fa-pencil"></i></a></td></tr>
        <tr><th>Email</th><td><?php echo htmlspecialchars($user['email']); ?></td><td><a href="edit.php?field=email"><i class="fa fa-pencil"></i></a></td></tr>
        <tr><th>Phone</th><td><?php echo htmlspecialchars($user['phone']); ?></td><td><a href="edit.php?field=phone"><i class="fa fa-pencil"></i></a></td></tr>
        <tr><th>Date of Birth</th><td><?php echo htmlspecialchars($user['dob']); ?></td><td><a href="edit.php?field=dob"><i class="fa fa-pencil"></i></a></td></tr>
    </table>
    <div style="text-align:center;margin-top:10px">
        <a class="btn" href="change_password.php">Change Password</a>
        <a class="btn" href="index1.php">Back to Home</a>
    </div>
</div>
</body>
</html>