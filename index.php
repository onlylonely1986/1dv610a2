<?php

// INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/Database.php');

// MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// CREATE OBJECTS OF THE VIEWS
session_start();


// vad är vi i för state
// har vi någon session
// är vi inloggade
// har det skett nån post
// förändrar det vårt state

$v = new LoginView();
$dtv = new DateTimeView();
$lv = new LayoutView();

//Create object of the database
$db = new Database();

if(isset($_SESSION['loggedin'])) {
  $lv->render(true, $v, $dtv);
} else {
  $lv->render(false, $v, $dtv);
}
