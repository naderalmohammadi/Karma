<?php
require_once("config.php");
if (isUserLoggedIn()==false){
header("Location: index.php");
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Profile
</title>
</head>
<?php  require_once("header.php"); ?>

<body>
&nbsp
<form method='POST' action="search2.php">
 <table id="table">
        <tr><td><input type="text" name="word" placeholder="Search for what?.." required></td></tr>
                <tr><td><input type="submit" name="search" value="Search"></td></tr>
  </table>
  </form>
</body>
<?php  require_once("footer.php"); ?>
</html>