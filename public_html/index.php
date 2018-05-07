<!--Author: May Moftah-->
<?php
session_start();
?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>49er Golf Cart Ride</title>
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <div class="wrapper">
        <nav>
            <img style="max-width:100px; margin-top: 10%;" src="img/Charlotte_49ers.png">
        </nav>
        <h1> Golf Cart Rides</h1>

    </div>
</header>

<!--Form for login-->
<form action="login.php" method="post">

    <div class="login-container">

        <label><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>
        <b></b>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>

        <div class="error-Msg">
           <p>  <?php if(!empty($_SESSION['errorMsg'])) { echo $_SESSION['errorMsg']; }?> </p>
        </div>
        <?php unset($_SESSION['errorMsg']); ?>

        <input type="submit" name="logIn" id="logIn" class="loginButton" value="Log In">
    </div>
</form>





</body>

<footer>
    <div class="wrapper">
        <div id="footer-info">
            <p>Designed and Developed by May Moftah</p>
            <p><a href="#">Terms of Service</a> I <a href="#">Privacy</a></p>
            <p>Icons made by <a href="http://www.flaticon.com/authors/pixel-perfect" title="Pixel perfect">Pixel
                    perfect</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed
                by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0"
                      target="_blank">CC 3.0 BY</a></p>
        </div>
    </div>
</footer>

</html>