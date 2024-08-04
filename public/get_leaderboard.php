<?php
require 'database.php';
session_start();

$_SESSION['leaderboard'] = getHighScores();

echo json_encode($_SESSION['leaderboard']);
?>