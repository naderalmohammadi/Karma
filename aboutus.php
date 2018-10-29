<?php
require_once("config.php");
if (isUserLoggedIn()==false){
header("Location: index.php");
}
?>
<html >


<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
About us
</title>
</head>
<body>
<?php  require_once("header.php"); ?>
<br><br><br><br>
<table><tr><td><p>Company: Prestige Worldwide Inc.</p></td></tr>
<tr><td><p>Team members: Nader / Jyotsana / Sourabh / Shreystha / Shikha / Edward</p></td></tr>
<tr><td><p>Professor: Mr. Henry, Bernard C.</p></td></tr></table>
</body>
<?php  require_once("footer.php"); ?>

</html>