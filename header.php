<?php require_once("config.php"); 

$points = fetchThisUserPoints();
foreach($points as $p){
	$p["points"];
}

?>

<html>
<body>
<header>
	<table>
	<tr><th>Karma / Welcome <?php echo $loggedInUser->username;?></th><th>TESLA</th> <th> <?php echo $loggedInUser->username;?>'s Points: <?php print $p["points"] ?></th> </tr>
	</table>
	</header>
</body>
</html>