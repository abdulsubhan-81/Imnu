<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact - IMNU Car Sharing</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
    <h1>IMNU Car Sharing</h1>
    <nav>
        <ul>
            <li><a href="<?php echo isset($_SESSION['email']) ? 'index1.php' : 'index.php'; ?>">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="search.php">Search Rides</a></li>
            <li><a href="add.php">Add Ride</a></li>
            <li class="active"><a href="contact.php">Contact</a></li>
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
    <h2>Contact Us</h2>
    <form method="POST">
        <label>Your Name</label>
        <input type="text" name="name" required>
        <label>Your Email</label>
        <input type="email" name="email" required>
        <label>Message</label>
        <textarea name="message" rows="5" required></textarea>
        <button type="submit" name="send" class="btn">Send</button>
    </form>
    <?php
    if (isset($_POST['send'])) {
        echo "<div class='notice success'>Your message has been sent. Thank you!</div>";
    }
    ?>
</section>
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> IMNU Car Sharing</p>
</footer>
</body>
</html>