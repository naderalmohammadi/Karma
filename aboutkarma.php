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
<table><tr><td><p>This website was built to ease your daily needs for answers from your coworkers without wasting your time moving between offices</p></td></tr>
<tr><td><p>You need points to ask questions / 1 question takes 1 point</p></td></tr>
 <tr><td><p>You can gain points by answering questions / if your answer was chosen as the best answer, you get 1 point</p></td></tr>
<tr><td><p>You already have 3 complementary points, spend them wisely!</p></td></tr></table>
</body>
<?php  require_once("footer.php"); ?>

</html>