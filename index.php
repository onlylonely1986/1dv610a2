<?php

// INCLUDE THE FILES NEEDED...
require_once('view/RegisterView.php');
require_once('view/LoginView.php');
require_once('view/LogoutView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
// require_once('controller/Database.php');

// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE VIEWS
$v = new LoginView();
$ov = new LogoutView();
$dtv = new DateTimeView();
$lv = new LayoutView();
$rv = new RegisterView();

//Create object of the database
// $db = new Database();

// start a new session
session_start();

$isLoggedIn = false;
$wantToRegister = false;

if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    // echo $message;
}
// nån är inloggad finns session
if(isset($_SESSION['loggedin'])) {
    $isLoggedIn = true;
    // inloggad på sidan och kör en reload
    // nån är inte inloggad vill registrera nya användare
} else if (isset($_GET['register'])) {
    $wantToRegister = true;
}

$lv->render($isLoggedIn, $wantToRegister, $v, $ov, $dtv, $rv);
