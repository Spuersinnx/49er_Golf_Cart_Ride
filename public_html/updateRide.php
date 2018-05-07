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

if(isset($_POST['rating'])) {
    $rating = $_POST['rating'];
    $id = $_POST['updateID'];
    $queryUpdateRating = "UPDATE Ride SET rating =:rating WHERE rideID =:id;";
    $statementRating = $db->prepare($queryUpdateRating);
    $statementRating->bindValue(":id", $id);
    $statementRating->bindValue(":rating", $rating);
    $statementRating->execute();
    header('Location: myRides.php');
}




?>