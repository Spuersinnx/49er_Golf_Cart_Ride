<!--Author: May Moftah-->
<?php
session_start();
require_once ('../db/db_config.php');

$_SESSION['errorMsg'] = '';

$email = $_POST['email'];
$password = $_POST['password'];


//check if username and password are correct
$queryUsername = "SELECT email FROM Login WHERE email =:email";
$statementUsername = $db->prepare($queryUsername);
$statementUsername->bindValue(":email", $email);
$statementUsername->execute();
$userNameEmail = $statementUsername->fetch();

$queryPassword = "SELECT password FROM Login WHERE email =:email ";
$statementPassword = $db->prepare($queryPassword);
$statementPassword->bindValue(":email", $email);
$statementPassword->execute();
$userPassword = $statementPassword->fetch();
$dbPassword = $userPassword[0];

//get user role for login purposes
$queryRole = "SELECT role FROM Login WHERE email =:email";
$statementRole = $db->prepare($queryRole);
$statementRole->bindValue(":email", $email);
$statementRole->execute();
$role = $statementRole->fetch();
$userRole = $role[0];


//select user loginID for identification purposes
$queryUserID = "SELECT loginID FROM Login WHERE email =:email";
$statementID = $db->prepare($queryUserID);
$statementID->bindValue(":email", $email);
$statementID->execute();
$userID = $statementID->fetch();
$_SESSION['userID'] = $userID[0];


//get user information
$queryUserInfo = "SELECT Person.personID, Person.name, Person.email, Person.department, Person.cellNumber, 
Customer.bannedYorN, Customer.startBan, Customer.endBan, Customer.countNotShow, Customer.customerType
FROM Person, Customer
NATURAL JOIN Login
WHERE Login.loginID = Person.personID = Customer.personID AND Login.email =:email";
$statementUserInfo = $db->prepare($queryUserInfo);
$statementUserInfo->bindValue(":email", $email);
$statementUserInfo->execute();
$userInfo = $statementUserInfo->fetch();

$_SESSION['name'] = $userInfo['name'];





/*verify password and role */
if ($userNameEmail && password_verify($password, $dbPassword) && $userRole == 'customer') {
    $_SESSION['errorMsg'] = '';
    header("Location: customer.php");

}

elseif ($userNameEmail && password_verify($password, $dbPassword) && $userRole == 'driver') {
    $_SESSION['errorMsg'] = '';
    header("Location: driver.php");


}

else {
    $_SESSION['errorMsg']= 'Invalid Credentials';
    header("Location: index.php");
}




?>