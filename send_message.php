<?php
session_start();
require 'db_config.php';
$sender = (int)($_POST['sender_id'] ?? 0);
$receiver = (int)($_POST['receiver_id'] ?? 0);
$message = trim($_POST['message'] ?? '');
if ($sender && $receiver && $message !== ''){
    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?,?,?)");
    $stmt->bind_param("iis", $sender, $receiver, $message);
    $stmt->execute();
}
http_response_code(204);
?>