<?php require_once("config.php"); 

$points = fetchThisUserPoints();
foreach($points as $p){
	$p["points"];
}

?>

<html>
<body>
<footer><p>&copy Prestige Worldwide <?php echo date("Y"); ?></p>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>"><input type="submit" value="Profile page" name="profile"></form>
<form method="POST" action="logout.php"><input type="submit" value="Log Out" name="logout"></form>
<?php if(isset($_POST["profile"])){
	header("Location: userpage.php");
	} ?>
</p></footer>
</body>
</html>