<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>League147</title>
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
        <headerelement><a class="active" href="index.php">Home</a></headerelement>
        <headerelement><a href="leaguetable.php">League Table</a></headerelement>
        <headerelement><a href="fixtures.php">Upcoming Fixtures</a></headerelement>
        <headerelement><a href="addresult.php">Add Result</a></headerelement>
        <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
        <headerelementend style="float:right"><a href="usercp.php">User CP</a></headerelementend>
        <headerelement style="float:right"><a href="logout.php">Logout</a></headerelement>
        <img src="" id="myPicture">
    </header>

        <div class="bigdiv">
            <textheader>Welcome back to League147, <?php
                echo htmlspecialchars($_SESSION['username']);
                ?>.</textheader>
        </div>

        <?php
    }else{
    ?>

    <header>
        <headerelement><a class="active" href="index.php">Home</a></headerelement>
        <headerelement><a href="leaguetable.php">League Table</a></headerelement>
        <headerelement><a href="fixtures.php">Upcoming Fixtures</a></headerelement>
        <headerelement><a href="addresult.php">Add Result</a></headerelement>
        <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
        <headerelementend style="float:right"><a href="login.php">Login</a></headerelementend>
        <headerelement style="float:right"><a href="register.php">Register</a></headerelement>
        <img src="" id="myPicture">
    </header>

        <div class="bigdiv">

            <textheader>Welcome to League147!</textheader>
            <textbody><p>Thank you for checking out our website. Here you will find the current 2019 rankings, as well as a comprehensive list of all
                    upcoming fixtures. Administrators regularly upload new fixtures, as well as results from any matches that take place. If you
                    notice anything wrong with the site or the data within it, please get in touch with myself via the contact options on the footer.
                    Furthermore, for any individuals who wish to join the league, please send an email to join@league147.co.uk.</p></textbody>

                    <textbody><p>(Please note that this service requires you to register an account with us. You can do so by clicking the 'Register' button in the top right corner.)</p></textbody>

            <textsignoff><p>- George Guest, League Founder & Webmaster</p></textsignoff>

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
