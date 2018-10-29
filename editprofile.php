<?php
require_once("config.php");
if (isUserLoggedIn()==false){
header("Location: index.php");
}
$allrecords = fetchUser();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Edit Profile
</title>
</head>
<?php  require_once("header.php"); ?>

&nbsp
<body>

<?php 
if($allrecords==0){
    ?><p>This user doesn't exists</p><?php
}
else{
?>
<?php
foreach($allrecords as $display){
?>
<form method='POST'>
<table id="table">
<tr><td><input type="number" name="age" min ='18' step="1" max='80' value="<?php print $display['age']?>" placeholder="Age.." required></td></tr>
<tr><td><input type="radio" name="gender" value='Male' checked>Male<input type="radio" name="gender" value='Female'>Female</td></tr>
<tr><td><input type="Password" name="pass" maxlength="20" value="<?php print $display['password']?>" placeholder="New Password.." required></td></tr>
<tr><td><input type="Password" name="passcon" maxlength="20" value="<?php print $display['password']?>" placeholder="Confirm New Password.." required></td></tr>

<tr><td colspan=2 align='center'><input type="submit" name="create" value="Edit"></td></tr>
</table>
</form>
<?php }?>
<?php
    if (isset($_POST['create'])) {
    	if ($_POST['pass'] != $_POST['passcon']){
    				?><p>Password confirmation doesn't match</p><?php
    		}
    		else{
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$pass = $_POST['pass'];
				$newuser = updateThisUser($age, $gender, $pass);
				if ($newuser==1){
                    $loggedInUser->password = $pass;
				header("Location:userpage.php?username=$username");}}

    }
?>
<?php }?>




</body>
<?php  require_once("footer.php"); ?>
</html>