<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in']!==true){ header("Location: admin_login.php"); exit(); }
require 'db_config.php';
if (isset($_GET['delete_user'])){
    $id = (int)$_GET['delete_user'];
    $conn->query("DELETE FROM user WHERE id=$id");
    echo "<script>alert('User deleted');window.location='admin_panel.php';</script>"; exit();
}
if (isset($_GET['delete_ride'])){
    $id = (int)$_GET['delete_ride'];
    $conn->query("DELETE FROM rides WHERE id=$id");
    echo "<script>alert('Ride deleted');window.location='admin_panel.php';</script>"; exit();
}
$users = $conn->query("SELECT id,name,email,phone,dob FROM user ORDER BY id DESC");
$rides = $conn->query("SELECT id,name,email,start_location,end_location,date,time,phone FROM rides ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin_panel.css">
</head>
<body>
<div class="panel-container">
    <h1>Welcome, Admin</h1>
    <a class="logout-btn" href="logout.php">Logout</a>
    <h2>Manage Users</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Action</th></tr>
        <?php while($u=$users->fetch_assoc()): ?>
        <tr>
            <td><?php echo $u['id']; ?></td>
            <td><?php echo htmlspecialchars($u['name']); ?></td>
            <td><?php echo htmlspecialchars($u['email']); ?></td>
            <td><?php echo htmlspecialchars($u['phone']); ?></td>
            <td><?php echo htmlspecialchars($u['dob']); ?></td>
            <td><a href="admin_panel.php?delete_user=<?php echo $u['id']; ?>" onclick="return confirm('Delete this user?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <h2>Manage Rides</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>From</th><th>To</th><th>Date</th><th>Time</th><th>Phone</th><th>Action</th></tr>
        <?php while($r=$rides->fetch_assoc()): ?>
        <tr>
            <td><?php echo $r['id']; ?></td>
            <td><?php echo htmlspecialchars($r['name']); ?></td>
            <td><?php echo htmlspecialchars($r['email']); ?></td>
            <td><?php echo htmlspecialchars($r['start_location']); ?></td>
            <td><?php echo htmlspecialchars($r['end_location']); ?></td>
            <td><?php echo htmlspecialchars($r['date']); ?></td>
            <td><?php echo htmlspecialchars($r['time']); ?></td>
            <td><?php echo htmlspecialchars($r['phone']); ?></td>
            <td><a href="admin_panel.php?delete_ride=<?php echo $r['id']; ?>" onclick="return confirm('Delete this ride?')">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>