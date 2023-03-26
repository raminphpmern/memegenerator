<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
    require('db.php');
    session_start();

    // echo '<pre>';
    // print_r($_REQUEST);
    // echo '</pre>';
    
    // // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $errmsg = "";
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: index.php");
        } else {
            $errmsg = "
                  <h3 style='white-space: nowrap;'>Incorrect Username/password.</h3><br/>
                  ";
        }
    } 
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
            <ul class="main-nav flex clean-list  space-between align-center">
                <li><a onclick="onMoveToGalery()" data-trans="galery">Gallery</a></li>
                <li><a href="create-memes/demo">Create Your Own Memes</a></li>                
            </ul>
            <ul class="main-nav flex clean-list  space-between align-center">
            <?php if(isset($_SESSION["username"])) { ?>
                <li><a href="#">Welcome <?php echo ucfirst($_SESSION["username"]); ?></a></li> 
                <?php } ?>                             
            </ul>
            <button class="btn-menu fa fa-bars" onclick="toggleMenu()"></button>
        </nav>
    </header>
    <form class="form" method="post" name="login" action="login.php">
        <h1 class="login-title">Login</h1>
        <div style="color: #FF0000">
        <?php 
    if(isset($errmsg)) {
        echo $errmsg;
    }
    ?>
        </div>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  </form>
<?php
    // }
?>
</body>
</html>
