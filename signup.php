<?php
session_start();
require 'db_config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $dob = trim($_POST['dob']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);
    $chk = $conn->prepare("SELECT id FROM user WHERE email=? LIMIT 1");
    $chk->bind_param("s", $email);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows > 0) {
        echo "<script>alert('Email already registered');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO user (name,email,phone,dob,password,email_otp,is_verified) VALUES (?,?,?,?,?,?,0)");
        $stmt->bind_param("ssssss", $name,$email,$phone,$dob,$password,$otp);
        if ($stmt->execute()) {
            @mail($email, "IMNU Car Sharing - Your OTP", "Hello $name,\nYour OTP is: $otp", "From: no-reply@imnu.local");
            echo "<script>alert('Signup successful! Check your email for OTP.');window.location='verify.php?email=".urlencode($email)."';</script>";
            exit();
        } else echo "<script>alert('Signup failed');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/reg.css">
</head>
<body>
<div class="container">
    <h2>Create Account</h2>
    <form method="POST">
        <label>Full Name</label><input type="text" name="name" required>
        <label>Email</label><input type="email" name="email" required>
        <label>Phone</label><input type="text" name="phone" required>
        <label>Date of Birth</label><input type="date" name="dob" required>
        <label>Password</label><input type="password" name="password" required>
        <button class="btn" type="submit">Sign Up</button>
        <a class="btn secondary" href="login.php">Already have an account?</a>
    </form>
</div>
</body>
</html>