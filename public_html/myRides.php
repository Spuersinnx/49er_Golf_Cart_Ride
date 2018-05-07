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

//fetch all ride history for this user
$queryRideHistory = "SELECT S.locationName, E.locationName, ride.startTime, ride.cancelledYorN, ride.showYorN, ride.rideID, ride.rating FROM Ride JOIN location S on ride.startLocID = S.locationID JOIN location E on ride.endLocID = E.locationID WHERE Ride.customerID = '{$_SESSION['userID']}' ORDER BY Ride.startTime DESC";
$statementRides = $db->prepare($queryRideHistory);
$statementRides->execute();
$rides = $statementRides->fetchAll();

$today = date("Y-m-d H:i:s");

?>

<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>49er Golf Cart Ride</title>
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet prefetch" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <script>
        function submit_my_form(myfield)
        {
            myfield.form.submit();
        }
    </script>

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
            <li><a href="customer.php">Home</a></li>
        </ul>

    </div>
</header>


<table class="center">
    <thead>
    <tr>
        <th>Date</th>
        <th>Pickup Time</th>
        <th>Pickup</th>
        <th>Dropoff</th>
        <th>Rating</th>
        <th>Cancel Ride</th>
    </tr>
    </thead>


    <tbody>
    <?php
    foreach ($rides as $ride) {
        echo '
            <tr>
            <td>' . strtok($ride[2], " ") . '</td>
            <td>' . strtok('') . '</td>
            <td>' . $ride[0] . '</td>
            <td>' . $ride[1] . '</td>';

        echo '
            <form action="updateRide.php" id="updateForm" method="post">
            <td>
            <div class="rate-select">
            <select name="rating" id="rating" onchange="submit_my_form(this)"> 
            <option value="" selected disabled hidden> Rate Your Ride</option>';
        echo '<option value = 1';
        if ($ride[6] == 1) echo " selected";
        echo '>Poor';
        echo '</option>';
        echo '<option value = 2';
        if ($ride[6] == 2) echo " selected";
        echo '>Fair';
        echo '</option>';
        echo '<option value = 3';
        if ($ride[6] == 3) echo " selected";
        echo '>Average';
        echo '</option>';
        echo '<option value = 4';
        if ($ride[6] == 4) echo " selected";
        echo '>Good';
        echo '</option>';
        echo '<option value = 5';
        if ($ride[6] == 5) echo " selected";
        echo '>Excellent';
        echo '</option>';

        echo ' 
            </select>
            </div>
            </td> 
            
            <input type="hidden" name="updateID" value="' . $ride['5'] . '">
            </form>';


        echo '
         <td>
         <form style="margin-bottom: 0px;" action="deleteRide.php" method="post">
         <input type="submit" name="deleteRide" id="' . $ride['5'] . '" class="deleteButton" value="Cancel Ride"' ;

            if($today > $ride['2']) echo ' style="background-color: grey" disabled = "disabled" cursor = "default"';

            echo '
            >
            <input type="hidden" name="delete" value="' . $ride['5'] . '">
            </form>
            </td>
            </tr>
            ';


    }


    ?>

    </tbody>
    </form>


</table>

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

