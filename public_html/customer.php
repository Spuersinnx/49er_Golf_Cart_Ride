<!--Author: May Moftah-->
<?php
session_start();
require_once('../db/db_config.php');


if(!isset($_SESSION['userID']))
{
    // not logged in
    header('Location: login.php');
    exit();
}
$locationSelect = $db->prepare("SELECT * FROM Location ORDER BY locationName");
$locationSelect->execute();
$locations = $locationSelect->fetchAll();
?>


<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>49er Golf Cart Ride</title>
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/mainstyle.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datePicker").datepicker();
        });
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
            <li><a href="myRides.php">My Rides</a> </li>
        </ul>
        <ul class="headerNoLink">
            <li><a href="#"> Hello, <?php echo $_SESSION['name'] ?></a></li>
        </ul>

    </div>
</header>


<div class="booking-container">
    <div class="booking-container-header">
        <h1> Book Your Ride </h1>
    </div>


    <form action="bookRide.php" method="post">
        <div></div>
        <div class="icon">
            <img src="img/placeholders.png">
        </div>
        <div class="date-select">
            <input type="text" placeholder="Select Date" id="datePicker" name="datePicker">
        </div>

        <div></div>

        <div class="booking-select">
            <select name="time" id="time">
                <option value="" selected disabled hidden> Pickup Time</option>
                <option value="07:00:00">7:00 AM</option>
                <option value="07:15:00">7:15 AM</option>
                <option value="07:30:00 ">7:30 AM</option>
                <option value="07:45:00">7:45 AM</option>

                <option value="08:00:00">8:00 AM</option>
                <option value="08:15:00">8:15 AM</option>
                <option value="08:30:00">8:30 AM</option>
                <option value="08:45:00">8:45 AM</option>

                <option value="09:00:00">9:00 AM</option>
                <option value="09:15:00">9:15 AM</option>
                <option value="09:30:00">9:30 AM</option>
                <option value="09:45:00">9:45 AM</option>

                <option value="10:00:00">10:00 AM</option>
                <option value="10:15:00">10:15 AM</option>
                <option value="10:30:00">10:30 AM</option>
                <option value="10:45:00">10:45 AM</option>

                <option value="11:00:00">11:00 AM</option>
                <option value="11:15:00">11:15 AM</option>
                <option value="11:30:00">11:30 AM</option>
                <option value="11:45:00">11:45 AM</option>

                <option value="12:00:00">12:00 PM</option>
                <option value="12:15:00">12:15 PM</option>
                <option value="12:30:00">12:30 PM</option>
                <option value="12:45:00">12:45 PM</option>

                <option value="13:00:00">1:00 PM</option>
                <option value="13:15:00">1:15 PM</option>
                <option value="13:30:00">1:30 PM</option>
                <option value="13:45:00">1:45 PM</option>

                <option value="14:00:00">2:00 PM</option>
                <option value="14:15:00">2:15 PM</option>
                <option value="14:30:00">2:30 PM</option>
                <option value="14:45:00">2:45 PM</option>

                <option value="15:00:00">3:00 PM</option>
                <option value="15:15:00">3:15 PM</option>
                <option value="15:30:00">3:30 PM</option>
                <option value="15:45:00">3:45 PM</option>

                <option value="16:00:00">4:00 PM</option>
                <option value="16:15:00">4:15 PM</option>
                <option value="16:30:00">4:30 PM</option>
                <option value="16:45:00">4:45 PM</option>

                <option value="17:00:">5:00 PM</option>
                <option value="17:15:00">5:15 PM</option>
                <option value="17:30:00">5:30 PM</option>
                <option value="17:45:00">5:45 PM</option>

                <option value="18:00:00">6:00 PM</option>
                <option value="18:15:00">6:15 PM</option>
                <option value="18:30:00">6:30 PM</option>
                <option value="18:45:00">6:45 PM</option>

                <option value="19:00:00">7:00 PM</option>
                <option value="19:15:00">7:15 PM</option>
                <option value="19:30:00">7:30 PM</option>
                <option value="19:45:00">7:45 PM</option>

                <option value="20:00:00">8:00 PM</option>
                <option value="20:15:00">8:15 PM</option>
                <option value="20:30:00">8:30 PM</option>
                <option value="20:45:00">8:45 PM</option>

                <option value="21:00:00">9:00 PM</option>
                <option value="21:15:00">9:15 PM</option>
                <option value="21:30:00">9:30 PM</option>
                <option value="21:45:00">9:45 PM</option>
                <option value="22:00:00">10:00 PM</option>
            </select>
        </div>
        <div></div>


        <div class="booking-select2">
            <select name="countPassenger" id="countPassenger">
            <option value="" selected disabled hidden> Passenger Count (Including Yourself)</option>
            <option value= 1>1</option>
                <option value= 2>2</option>
                <option value= 3>3</option>
            </select>
        </div>

        <div class="booking-select2">
            <select name="pickup" id="pickup">
                <option value="<?= null ?>" selected disabled hidden> Pickup Location</option>
                <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['locationID'] ?>"> <?= $location['locationName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div></div>


        <div class="booking-select3">
            <select name="dropoff" id="dropoff">
                <option value="<?= null ?>" selected disabled hidden> Dropoff Location</option>
                <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['locationID'] ?>"><?= $location['locationName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="error-Msg">
            <p>  <?php if(!empty($_SESSION['errorMsg'])) { echo $_SESSION['errorMsg']; }?> </p>
        </div>
        <?php unset($_SESSION['errorMsg']); ?>

        <div class="submit-container">
            <input type="submit" name="logIn" id="submit" class="submitButton" value="Book Ride">
        </div>

    </form>


</div>


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