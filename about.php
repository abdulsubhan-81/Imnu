<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>About - IMNU Car Sharing</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
    <h1>IMNU Car Sharing</h1>
    <nav>
        <ul>
            <li><a href="<?php echo isset($_SESSION['email']) ? 'index1.php' : 'index.php'; ?>">Home</a></li>
            <li class="active"><a href="about.php">About</a></li>
            <li><a href="search.php">Search Rides</a></li>
            <li><a href="add.php">Add Ride</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['email'])): ?>
                <li><a class="btn" href="account.php">Account</a></li>
                <li><a class="btn danger" href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a class="btn" href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<section class="container">
    <h2>About IMNU Car Sharing</h2>
    <p>Community-driven ride sharing to save money and reduce emissions.</p>
    <ul>
        <li>Easy ride search and posting</li>
        <li>Real-time chat with other users</li>
        <li>Admin-managed platform</li>
        <li>Advanced filters for date and time</li>
    </ul>
</section>
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> IMNU Car Sharing</p>
</footer>
</body>
</html>