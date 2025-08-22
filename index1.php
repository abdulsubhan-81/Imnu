<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IMNU Car Sharing - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
    <h1>IMNU Car Sharing</h1>
    <nav>
        <ul>
            <li><a href="index1.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="search.php">Search Rides</a></li>
            <li><a href="add.php">Add Ride</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a class="btn" href="account.php">Account</a></li>
            <li><a class="btn danger" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<section class="container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>Use the navigation to manage rides, search, or chat.</p>
</section>
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> IMNU Car Sharing</p>
</footer>
</body>
</html>