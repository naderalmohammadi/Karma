<?php

require_once("config.php");

if(isUserLoggedIn())
{
  destroySession("ThisUser");;
}
header("Location:index.php");
die();

?>