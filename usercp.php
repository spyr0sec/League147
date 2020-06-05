<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User CP</title>
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
            <headerelement><a href="fixtures.php">Upcoming Fixtures</a></headerelement>
            <headerelement><a href="addresult.php">Add Result</a></headerelement>
            <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
            <headerelement style="float:right"><a class="active" href="usercp.php">User CP</a></headerelement>
            <headerelement style="float:right"><a href="logout.php">Logout</a></headerelement>
            <img src="" id="myPicture">

        </header>

        <?php

// Check if the user is logged in, if not then redirect to login page
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: login.php");
            exit;
        }

// Include config file
        require_once "config.php";

// Define variables and initialize with empty values
        $new_password = $confirm_password = "";
        $new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // Validate new password
            if(empty(trim($_POST["new_password"]))){
                $new_password_err = "Please enter the new password.";
            } elseif(strlen(trim($_POST["new_password"])) < 6){
                $new_password_err = "Password must have atleast 6 characters.";
            } else{
                $new_password = trim($_POST["new_password"]);
            }

            // Validate confirm password
            if(empty(trim($_POST["confirm_password"]))){
                $confirm_password_err = "Please confirm the password.";
            } else{
                $confirm_password = trim($_POST["confirm_password"]);
                if(empty($new_password_err) && ($new_password != $confirm_password)){
                    $confirm_password_err = "Password did not match.";
                }
            }

            // Check input errors before updating the database
            if(empty($new_password_err) && empty($confirm_password_err)){
                // Prepare an update statement
                $sql = "UPDATE users SET password = ? WHERE id = ?";

                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

                    // Set parameters
                    $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $param_id = $_SESSION["id"];

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Password updated successfully. Destroy the session, and redirect to login page
                        session_destroy();
                        header("location: login.php");
                        exit();
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }

            // Close connection
            mysqli_close($link);
        }
        ?>

        <div class="wrapper">
            <div class="bigdiv">

                <p><textheader>Change Password</textheader></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <textheadersmall>New Password</textheadersmall>
                    <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                    <span class="help-block"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <textheadersmall>Confirm Password</textheadersmall>
                    <input type="password" name="confirm_password" class="form-control">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>

                <textbodysmall><p>(You have been a member since <?php
                    $connect = mysqli_connect('localhost','u299450305_admin', 'D@tab4s3147!',"u299450305_league147");
                    $currentuserid = $_SESSION["id"];
                    $sql = "SELECT created_at FROM users WHERE id = $currentuserid";
                    $result = $connect->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo $row["created_at"].".)"."<br>";
                        }}
                    $connect->close();
                        ?></p></textbodysmall>
        </div>



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

        <?php
    }else{
        ?>

        <textbody>Hey, wait a second... you shouldn't be here!</textbody>
        <textbody><p>Please tell us how you got here: bugs@league147.co.uk</p></textbody>

        <video controls loop.autoplay>
            <source src="images/stop.mp4" type="video/mp4">
        </video>

        <?php
    }
    ?>

</div>
</body>
</html>

