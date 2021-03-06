<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Result</title>
    <link href="https://fonts.googleapis.com/css?family=Dosis|Kaushan+Script|PT+Sans+Narrow|Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="additional/main.css">
    <script src="additional/randimg.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
</head>

<body>

<div id="wrapper">

    <?php
    session_start();
    if(isset($_SESSION['id']) and ($_SESSION['username'] == 'administrator')){
        ?>

        <header>
            <headerelement><a href="index.php">Home</a></headerelement>
            <headerelement><a href="leaguetable.php">League Table</a></headerelement>
            <headerelement><a href="fixtures.php">Upcoming Fixtures</a></headerelement>
            <headerelement><a class="active" href="addresult.php">Add Result</a></headerelement>
            <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
            <headerelementend style="float:right"><a href="usercp.php">User CP</a></headerelementend>
            <headerelement style="float:right"><a href="logout.php">Logout</a></headerelement>
            <img src="" id="myPicture">

        </header>

        <div class="bigdiv" align="center">
            <?php
            $winner = "";
            $playerOne = "";
            $playerTwo = "";
            ?>
            <form id="new-result" action="resultaction.php" method="post">
            <p><textheader>Select Player 1:</textheader></p>
    <select name="playerOne">
        <?php
        require_once "config.php";
        $sql = mysqli_query($link, "SELECT Name, id FROM league ORDER BY Name ASC" );
        while ($row = $sql->fetch_assoc()){
            echo "<option value='{$row['id']}'>" . $row['Name'] . "</option>";
        }
        ?>
    </select>
            <p><textheader>Select Player 2:</textheader></p>
        <select name="playerTwo">
        <?php
        require_once "config.php";
        $sql = mysqli_query($link, "SELECT Name, id FROM league ORDER BY Name ASC" );
        while ($row = $sql->fetch_assoc()){
            echo "<option value='{$row['id']}'>" . $row['Name'] . "</option>";
        }
        ?>
    </select>
                <p><textheader>Select Match Outcome:</textheader></p>
            <input type="submit" name="playerOneWins" value="Player 1 = Winner" </input>
                <input type="submit" name="playerTwoWins" value="Player 2 = Winner" </input>
                <input type="submit" name="draw" value="Draw" </input><br />
            </form>

        </div>

        <?php
    }else{
        ?>

        <header>
            <headerelement><a href="index.php">Home</a></headerelement>
            <headerelement><a href="leaguetable.php">League Table</a></headerelement>
            <headerelement><a href="fixtures.php">Upcoming Fixtures</a></headerelement>
            <headerelement><a class="active" href="addresult.php">Add Result</a></headerelement>
            <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
            <headerelementend style="float:right"><a href="login.php">Login</a></headerelementend>
            <headerelement style="float:right"><a href="register.php">Register</a></headerelement>
            <img src="" id="myPicture">

        </header>

        <div class="bigdiv">
            <errorheader>You must be an administrator to view this page.</errorheader>
        </div>

        <?php
    }
    ?>

    <div class="partners">
        <p>Proudly brought to you by our sponsors:</p>
        <img src="images/worldsnookerlogo.png" width="100">
        <img src="images/crownsnookerlogo.png" width="100" hspace="20">
        <img src="images/rileyslogo.png" width="100">

    </div>

    <footer>
        <footerelement style="float:left"><a>hello@league147.co.uk</a></footerelement>
        <footerelement style="float:left"><a>Twitter: @League147</a></footerelement>
        <footerelement style="float:right"><a class="active">Website created (with love) by George Guest ©</a></footerelement>
    </footer>

</div>

<script src="additional/addresult.js"></script>
</body>
</html>

