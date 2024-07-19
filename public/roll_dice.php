<?php
session_start();

if ($_SESSION['game_state']['rolls'] > 0) {
    for ($i = 0; $i < 5; $i++) {
        if ($_SESSION['game_state']['dice'][$i] === 0) {
            $_SESSION['game_state']['dice'][$i] = rand(1, 6);
        }
    }
    $_SESSION['game_state']['rolls']--;
}

echo json_encode($_SESSION['game_state']);