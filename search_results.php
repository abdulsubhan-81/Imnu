<?php
session_start();
require 'db_config.php';
$start = isset($_GET['start']) ? $_GET['start'] : '';
$end   = isset($_GET['end'])   ? $_GET['end']   : '';
$date  = isset($_GET['date'])  ? $_GET['date']  : '';
$time  = isset($_GET['time'])  ? $_GET['time']  : '';
$sql = "SELECT r.*, u.id as uid FROM rides r JOIN user u ON u.id = r.user_id WHERE 1=1";
if ($start !== '') $sql .= " AND r.start_location LIKE '%" . $conn->real_escape_string($start) . "%'";
if ($end   !== '') $sql .= " AND r.end_location LIKE '%" . $conn->real_escape_string($end) . "%'";
if ($date  !== '') $sql .= " AND r.date = '" . $conn->real_escape_string($date) . "'";
if ($time  !== '') $sql .= " AND r.time >= '" . $conn->real_escape_string($time) . "'";
$sql .= " ORDER BY r.date, r.time";
$res = $conn->query($sql);
if ($res && $res->num_rows){
    echo "<table class='rides-table'><tr><th>Name</th><th>Start</th><th>End</th><th>Date</th><th>Time</th><th>Phone</th><th>Actions</th></tr>";
    while($row = $res->fetch_assoc()){
        $phone = htmlspecialchars($row['phone']);
        $uid = (int)$row['uid'];
        echo "<tr>
            <td>".htmlspecialchars($row['name'])."</td>
            <td>".htmlspecialchars($row['start_location'])."</td>
            <td>".htmlspecialchars($row['end_location'])."</td>
            <td>".htmlspecialchars($row['date'])."</td>
            <td>".htmlspecialchars($row['time'])."</td>
            <td>$phone</td>
            <td>";
        if (isset($_SESSION['email'])) {
            echo "<a class='btn call-btn' href='tel:$phone'>Call</a>
                  <a class='btn chat-btn' href='chat.php?user_id=$uid'>Chat</a>";
        } else {
            echo '<button class="btn disabled" onclick="alert(\'Login required\')">Call</button>
                  <button class="btn disabled" onclick="alert(\'Login required\')">Chat</button>';
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No rides found.</p>";
}
?>