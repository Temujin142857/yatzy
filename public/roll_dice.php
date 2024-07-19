<?php
session_start();

if ($_SESSION['rolls'] > 0) {
    for ($i = 0; $i < 5; $i++) {
        if ($_SESSION['dice'][$i] === 0) {
            $_SESSION['dice'][$i] = rand(1, 6);
        }
    }
    $_SESSION['rolls']--;
}

echo json_encode($_SESSION['game_state']);