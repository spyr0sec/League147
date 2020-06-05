<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upcoming Fixtures</title>
    <link href="https://fonts.googleapis.com/css?family=Dosis|Kaushan+Script|PT+Sans+Narrow|Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="additional/main.css">
    <script src="additional/randimg.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />
</head>

<body>

<div id="wrapper">

    <?php
    session_start();
    if(isset($_SESSION['id'])){
        ?>

        <header>
            <headerelement><a href="index.php">Home</a></headerelement>
            <headerelement><a href="leaguetable.php">League Table</a></headerelement>
            <headerelement><a class="active" href="fixtures.php">Upcoming Fixtures</a></headerelement>
            <headerelement><a href="addresult.php">Add Result</a></headerelement>
            <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
            <headerelementend style="float:right"><a href="usercp.php">User CP</a></headerelementend>
            <headerelement style="float:right"><a href="logout.php">Logout</a></headerelement>
            <img src="" id="myPicture">

        </header>

    <div class="bigdiv" align="center">
        <textheader>Upcoming Fixtures</textheader>
        <p></p>

        <?php
        require('config.php');
        $sql = "SELECT Player1, Player2 FROM fixtures";
        $result = mysqli_query($link,$sql);
        echo "<table>";
        while($row = mysqli_fetch_array($result)) {
            $Player1 = $row['Player1'];
            $vs = "vs";
            $Player2 = $row['Player2'];
            echo "<tr><td style='width: 200px; text-align: center;'>".$Player1."</td><td style='width: 10px; text-align: center;'>".$vs."</td><td style='width: 200px; text-align: center;'>".$Player2;
        }
        echo "</table>";
        mysqli_close($link);
        ?>

    </div>

        <?php
    }else{
        ?>

        <header>
            <headerelement><a href="index.php">Home</a></headerelement>
            <headerelement><a href="leaguetable.php">League Table</a></headerelement>
            <headerelement><a class="active" href="fixtures.php">Upcoming Fixtures</a></headerelement>
            <headerelement><a href="addresult.php">Add Result</a></headerelement>
            <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
            <headerelementend style="float:right"><a href="login.php">Login</a></headerelementend>
            <headerelement style="float:right"><a href="register.php">Register</a></headerelement>
            <img src="" id="myPicture">

        </header>

        <div class="bigdiv">
            <errorheader>You must be logged in to view this page.</errorheader>
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
</body>
</html>

