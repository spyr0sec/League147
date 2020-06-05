<?php
require('config.php');
$playerOne = $_POST['playerOne'];

$playerTwo = $_POST['playerTwo'];

function error($code = 300) {
    http_response_code($code);
}

if (isset($playerOne) && isset($playerTwo)) {
    if ($playerOne == $playerTwo) {
        error();
        die("Error: Both players can't be the same.");
    }

    if (isset($_POST['playerOneWins'])) {
        addWin($playerOne, $playerTwo);
    } else if (isset($_POST['playerTwoWins'])) {
        addWin($playerTwo, $playerOne);
    } else if (isset($_POST['draw'])) {
        draw($playerOne, $playerTwo);
    }
    die;


} else {
    die("Error.");
}

function addWin($winner, $loser)
{
    $sql = "UPDATE league SET wins = wins + 1, points = points + 3 WHERE id = " . $winner;
    $sql2 = "UPDATE league SET losses = losses + 1 WHERE id = " . $loser;
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
    }

    if ($link->query($sql2) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
    }

    $link->close();
}

function draw($playerOne, $playerTwo)
{
    $sql = "UPDATE league SET draws = draws + 1 WHERE id = " . $playerOne . " or id = " . $playerTwo;
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $link->error;
        error();
    }

    $link->close();
}
