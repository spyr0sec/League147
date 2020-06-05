<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Control Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Dosis|Kaushan+Script|PT+Sans+Narrow|Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="additional/main.css">
    <script src="additional/randimg.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

</head>
<body>

<div id="wrapper">

    <header>
        <headerelement><a href="index.php">Home</a></headerelement>
        <headerelement><a href="leaguetable.php">League Table</a></headerelement>
        <headerelement><a href="fixtures.php">Upcoming Fixtures</a></headerelement>
        <headerelement><a href="addresult.php">Add Result</a></headerelement>
        <headerelement><a href="addfixture.php">Add Fixture</a></headerelement>
        <headerelementend style="float:right"><a href="login.php">Login</a></headerelementend>
        <headerelement style="float:right"><a class="active" href="register.php">Register</a></headerelement>
        <img src="" id="myPicture">

    </header>

    <div class="wrapper">
        <div class="bigdiv">
        <p><textheader>Registration Form</textheader></p>
        <p>Please fill this form to create your League147 account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <textheadersmall>Username</textheadersmall>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <textheadersmall>Password</textheadersmall>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <textheadersmall>Confirm Password</textheadersmall>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <button type ="submit">Submit</button>
                <button type ="reset">Reset</button>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
        </div>
    </div>

    <footer>
        <footerelement style="float:left"><a>hello@league147.co.uk</a></footerelement>
        <footerelement style="float:left"><a>Twitter: @League147</a></footerelement>
        <footerelement style="float:right"><a class="active">Website created (with love) by George Guest ©</a></footerelement>
    </footer>

</div>
</body>
</html>
