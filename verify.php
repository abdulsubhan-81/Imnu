<?php
require 'db_config.php';
$email = $_GET['email'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'] ?? '';
    $otp = $_POST['otp'] ?? '';
    $stmt = $conn->prepare("SELECT id FROM user WHERE email=? AND email_otp=? LIMIT 1");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0){
        $upd = $conn->prepare("UPDATE user SET is_verified=1, email_otp=NULL WHERE email=?");
        $upd->bind_param("s", $email);
        $upd->execute();
        echo "<script>alert('Email verified! You can login now.');window.location='login.php';</script>"; exit();
    } else echo "<script>alert('Invalid OTP');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Verify Your Email</h2>
    <form method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <label>Enter OTP</label>
        <input type="text" name="otp" required>
        <button class="btn" type="submit">Verify</button>
    </form>
</div>
</body>
</html>