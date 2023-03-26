<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <header class="navbar flex space-between">
    <div class="logo">
            <img src="img/meme-creator-logo.png" alt="Meme Creator Logo" width="100" />
        </div>
        <div class="logo" style="margin-left:30px;">
            <!-- <h1 class="heading" style="white-space: nowrap;">Meme Generator</h1> -->
            <div class="container">
            <div class="text">
                <span>M</span>
                <span>E</span>
                <span>M</span>
                <span>E</span>
            </div>
            <div class="text">
                <span>G</span>
                <span>E</span>
                <span>N</span>
                <span>E</span>
                <span>R</span>
                <span>A</span>
                <span>T</span>
                <span>O</span>
                <span>R</span>
            </div>
            </div>
            <h5 class="sub-heading" style="white-space: nowrap">Your Meme Stock</h5>
        </div>
        <nav class="navbar topnav flex">
            
        </nav>
    </header>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
