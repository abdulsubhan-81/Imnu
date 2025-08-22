<?php
session_start();
require 'db_config.php';
$me = (int)($_GET['me'] ?? 0);
$peer = (int)($_GET['peer'] ?? 0);
$stmt = $conn->prepare("SELECT sender_id, receiver_id, message, created_at FROM messages
    WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)
    ORDER BY created_at ASC, id ASC");
$stmt->bind_param("iiii", $me, $peer, $peer, $me);
$stmt->execute();
$res = $stmt->get_result();
while($row = $res->fetch_assoc()){
    $cls = ($row['sender_id'] == $me) ? 'me' : 'them';
    echo "<div class='msg $cls'>".htmlspecialchars($row['message'])."<div class='meta'>".htmlspecialchars($row['created_at'])."</div></div>";
}
?>