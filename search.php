<?php
session_start();
require 'db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Rides</title>
    <link rel="stylesheet" href="css/search.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2>Find a Ride</h2>
<div class="search-container">
    <input type="text" id="start" placeholder="Start location">
    <input type="text" id="end" placeholder="End location">
    <input type="date" id="date">
    <input type="time" id="time">
    <button id="searchBtn" class="btn">Search</button>
</div>
<div id="results"></div>
<script>
function loadRides(){
    $.get('search_results.php',{
        start:$('#start').val(),
        end:$('#end').val(),
        date:$('#date').val(),
        time:$('#time').val()
    },function(html){ $('#results').html(html); });
}
$('#searchBtn').on('click',loadRides);
$('#start,#end,#date,#time').on('input change',loadRides);
loadRides();
</script>
</body>
</html>