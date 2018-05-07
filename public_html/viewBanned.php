<!--Author: May Moftah-->
<?php
session_start();
require_once('../db/db_config.php');

//uncomment when done with app, necessary security measure
if(!isset($_SESSION['userID']))
{
    // not logged in
    header('Location: login.php');
    exit();
}

$queryBannedView = "SELECT * FROM bannedcustomers";
$statementBanned = $db->prepare($queryBannedView);
$statementBanned->execute();
$bannedCustomers = $statementBanned->fetchAll();

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
        <ul class="headerLink">
            <li><a href="logout.php">Log Out</a></li>
        </ul>

        <ul class="headerLink">
            <li><a href="driver.php">Home</a></li>
        </ul>
        <ul class="headerNoLink">
            <li><a href="#"> Hello, <?php echo $_SESSION['name'] ?></a></li>
        </ul>


    </div>
</header>

<table class="center">
    <thead>
    <tr>
        <th>Customer Name</th>
        <th>Ban Start</th>
        <th>Ban End</th>

    </tr>
    </thead>

<?php
foreach ($bannedCustomers as $bannedCustomer) {
    echo '
            <tr>
            <td>'.$bannedCustomer[0].'</td>
            <td>'.$bannedCustomer[1].'</td>
            <td>'.$bannedCustomer[2].'</td>
            </tr>';
}

?>

</table>
<!--<div class="pagination">
    <a href="#">&laquo;</a>
    <a href="#">1</a>
    <a class="active" href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">&raquo;</a>
</div>-->
</body>

<footer style="margin-top: 120px;">
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

