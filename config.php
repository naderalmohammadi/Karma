<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once("db_settings.php");
require_once("functions.php");
require_once("class.user.php");



session_start();


//loggedInUser can be used globally if constructed
if(isset($_SESSION["ThisUser"]) && is_object($_SESSION["ThisUser"]))
{
	$loggedInUser = $_SESSION["ThisUser"];
}


?>
