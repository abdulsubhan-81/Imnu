<?php
session_start();
if (!isset($_SESSION['email'])) { header("Location: login.php"); exit(); }
require 'db_config.php';
$allowed = ['name','email','phone','dob'];
$field = $_GET['field'] ?? '';
if (!in_array($field, $allowed)) { echo "<script>alert('Invalid field');window.location='account.php';</script>"; exit(); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $val = trim($_POST['new_value']);
    if ($val === '') { echo "<script>alert('Value cannot be empty');</script>"; }
    else {
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("UPDATE user SET $field = ? WHERE email = ?");
        $stmt->bind_param("ss", $val, $email);
        if ($stmt->execute()) {
            if ($field === 'email') $_SESSION['email'] = $val;
            echo "<script>alert('Updated');window.location='account.php';</script>"; exit();
        } else { echo "<script>alert('Update failed');</script>"; }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit <?php echo htmlspecialchars(ucfirst($field)); ?></title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
<div class="edit-container">
    <h1>Edit <?php echo htmlspecialchars(ucfirst($field)); ?></h1>
    <form method="POST">
        <label>New <?php echo htmlspecialchars(ucfirst($field)); ?>:</label>
        <input type="<?php echo $field==='email'?'email':'text'; ?>" name="new_value" required>
        <br>
        <button class="btn" type="submit">Update</button>
        <a class="btn cancel" href="account.php">Cancel</a>
    </form>
</div>
</body>
</html>