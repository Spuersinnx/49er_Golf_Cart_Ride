<!--Author: May Moftah-->
<?php
$dsn = 'mysql:host=localhost:3306;dbname=49er_golf_cart_ride';
$username = 'root';
$password = 'cDyH2R7x(CvFTU';


try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('db_error.php');
    exit();
}

?>