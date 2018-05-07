<!--Author: May Moftah-->
<?php
session_start();
require_once('../db/db_config.php');


/*//uncomment when done with app, necessary security measure
if(!isset($_SESSION['userID']))
{
    // not logged in
    header('Location: login.php');
    exit();
}*/

$originalDate = $_POST['datePicker'];
$time = $_POST['time'];
$pickup = $_POST['pickup'];
$dropoff = $_POST['dropoff'];
$countPassenger = $_POST['countPassenger'];
$ID = $_SESSION['userID'];

//reformat date for db entry
$originalDate = str_replace('/', '-', $originalDate);
$date = date('Y-m-d', strtotime($originalDate));
$pickupTime = $date . " " . $time;

//select a random cart for this ride
$queryRandomCart = $db->prepare("SELECT * FROM Cart WHERE driverID IS NOT NULL ORDER BY Rand() LIMIT 1");
$queryRandomCart->execute();
$cart = $queryRandomCart->fetch();
$cartID = $cart['ID'];


//check that all form input is present
if (empty($_POST['datePicker']) || empty($_POST['time']) || empty($_POST['pickup']) || empty($_POST['dropoff']) || empty($_POST['countPassenger'])) {
    $_SESSION['errorMsg'] = 'All Input Fields Must be Filled Out!';
    header('Location: customer.php');

} else {//insert ride into database
    $queryInsertRide = "INSERT INTO Ride(rideID, cartID, customerID, rating, startLocID, endLocID, startTime, endTime, showYorN, cancelledYorN, countPersons) Values(NULL, :cartID, :customerID, NULL, :startLocID, :endLocID, :startTime , NULL,NULL, NULL, :countPassenger);";
    $statementInsert = $db->prepare($queryInsertRide);
    $statementInsert->bindValue(':customerID', $ID);
    $statementInsert->bindValue(':cartID', $cartID);
    $statementInsert->bindValue(':startLocID', $pickup);
    $statementInsert->bindValue(':endLocID', $dropoff);
    $statementInsert->bindValue(':startTime', $pickupTime);
    $statementInsert->bindValue(':countPassenger', $countPassenger);
    $statementInsert->execute();
    header('Location: thankBooking.php');


}


?>