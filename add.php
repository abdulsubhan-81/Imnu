<?php
session_start();
require 'db_config.php';
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $start_location = $conn->real_escape_string($_POST['start_location']);
    $end_location = $conn->real_escape_string($_POST['end_location']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $phone = $conn->real_escape_string($_POST['phone']);
    $stmt = $conn->prepare("INSERT INTO rides (user_id, name, email, start_location, end_location, date, time, phone) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssss", $user_id, $name, $email, $start_location, $end_location, $date, $time, $phone);
    if ($stmt->execute()) echo "<script>alert('Ride added');window.location='index1.php';</script>";
    else echo "<script>alert('Error adding ride');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Ride</title>
    <link rel="stylesheet" href="css/add.css">
</head>
<body>
<div class="container">
    <h2>Add a Ride</h2>
    <form method="POST" class="ride-form">
        <label>Start Location</label>
        <input type="text" id="start_location" name="start_location" required>
        <label>End Location</label>
        <input type="text" id="end_location" name="end_location" required>
        <label>Date</label>
        <input type="date" name="date" required>
        <label>Time</label>
        <input type="time" name="time" required>
        <label>Phone Number</label>
        <input type="tel" name="phone" pattern="[0-9]{10}" placeholder="10-digit phone" required>
        <button type="submit" class="btn">Add Ride</button>
    </form>
</div>
</body>
</html>