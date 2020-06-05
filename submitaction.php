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

        addFixture($playerOne, $playerTwo);
        die;

} else {
    die("Error.");
}

function addFixture($playerOne, $playerTwo)
{
    $sql = "INSERT INTO fixtures (Player1, Player2) VALUES ('$playerOne', '$playerTwo')";
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($link->query($sql) === TRUE) {
        echo "Fixture added successfully.";
    } else {
        echo "Error adding fixture: " . $link->error;
        error();
    }

     $link->close();
}
