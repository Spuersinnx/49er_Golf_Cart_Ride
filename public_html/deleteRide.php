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

if(!empty($_POST['delete'])){
    $id = $_POST['delete'];
    //echo $id;
    $queryDelete = "DELETE FROM Ride WHERE rideID =:id";
    $statementDelete = $db->prepare($queryDelete);
    $statementDelete->bindValue(":id", $id);
    $statementDelete->execute();
    header('Location: myRides.php');
}


?>