<?php
session_start();
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
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="helpdesk.php">Help Desk</a></li>
            <?php if (!isset($_SESSION['email'])): ?>
                <li><a class="btn" href="signup.php">Sign Up</a></li>
                <li><a class="btn" href="login.php">Login</a></li>
            <?php else: ?>
                <li><a class="btn" href="account.php">Account</a></li>
                <li><a class="btn danger" href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main class="hero">
    <section>
        <h2>Find a Ride</h2>
        <p>Connect with people going your way. Save money and the planet.</p>
        <a class="cta" href="search.php">Search Rides</a>
    </section>
    <section>
        <h2>Offer a Ride</h2>
        <p>Have empty seats? Share your route and split costs easily.</p>
        <a class="cta" href="add.php">Add a Ride</a>
    </section>
</main>
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> IMNU Car Sharing</p>
</footer>
</body>
</html>