<?php
session_start();
require 'db_config.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit(); }
$me = (int)$_SESSION['user_id'];
$peer = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
if ($peer <= 0) { echo "<script>alert('No user selected');window.location='search.php';</script>"; exit(); }
$stmt = $conn->prepare("SELECT name FROM user WHERE id = ?");
$stmt->bind_param("i", $peer);
$stmt->execute();
$stmt->bind_result($peer_name);
$stmt->fetch();
$stmt->close();
if (!$peer_name) $peer_name = "User #".$peer;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat with <?php echo htmlspecialchars($peer_name); ?></title>
    <link rel="stylesheet" href="css/chat.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="chat-wrap">
    <div class="chat-header">Chat with <?php echo htmlspecialchars($peer_name); ?></div>
    <div id="messages" class="chat-messages"></div>
    <div class="chat-input">
        <input type="text" id="msg" placeholder="Type your message...">
        <button id="sendBtn">Send</button>
    </div>
</div>
<script>
const me = <?php echo (int)$me; ?>;
const peer = <?php echo (int)$peer; ?>;
function loadMessages(){
    $.get('load_messages.php',{me:me, peer:peer}, function(html){
        const box = $('#messages');
        box.html(html);
        box.scrollTop(box[0].scrollHeight);
    });
}
function sendMessage(){
    const m = $('#msg').val().trim();
    if(!m) return;
    $.post('send_message.php',{sender_id:me, receiver_id:peer, message:m}, function(){
        $('#msg').val('');
        loadMessages();
    });
}
$('#sendBtn').on('click', sendMessage);
$('#msg').on('keypress', function(e){ if(e.which===13) sendMessage(); });
setInterval(loadMessages, 2000);
loadMessages();
</script>
</body>
</html>