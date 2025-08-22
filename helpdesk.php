<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Help Desk - IMNU Car Sharing</title>
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
            <li><a href="contact.php">Contact</a></li>
            <li class="active"><a href="helpdesk.php">Help Desk</a></li>
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
    <h2>Help Desk</h2>
    <details open><summary>How do I search for rides?</summary>
        <p>Open <strong>Search Rides</strong>, enter start and end locations, and filter by date/time.</p>
    </details>
    <details><summary>How do I add my ride?</summary>
        <p>Login, go to <strong>Add Ride</strong>, fill details, and submit.</p>
    </details>
    <details><summary>How can I contact another user?</summary>
        <p>Use the <strong>Call</strong> or <strong>Chat</strong> buttons in search results.</p>
    </details>
    <details><summary>I forgot my password</summary>
        <p>Contact admin via Contact page. (Forgot password flow can be added later.)</p>
    </details>
</section>
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> IMNU Car Sharing</p>
</footer>
</body>
</html>