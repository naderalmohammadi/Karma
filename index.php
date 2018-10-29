<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Karma
</title>
</head>



<body>
<header>
    <table>
    <tr><th>Karma</th><th>TESLA</th></tr>
    </table>
    </header>
&nbsp
<?php require_once("config.php"); ?>


<form method='POST'>
<table id="table">
<tr><td><input type="text" name="username" placeholder="Your username.." required></td></tr>
<tr><td><input type="Password" name="pass" placeholder="Your password.." required></td></tr>
<tr><td colspan=2 align='center'><input type="submit" name="login" value="Login"></td></tr>
</form>
<form method='POST'>
<tr><td colspan=2 align='center'><input type="submit" name="signup" value="Create new account"></td></tr>
</form>
</table>

<?php
    if (isset($_POST['login'])) {
    	$user = $_POST['username'];
    	$pass = $_POST['pass'];
    	$verfiythisuser = verifyThisUser($user,$pass);
    	if($verfiythisuser==1){

    		       $loggedInUser = new loggedInUser();
                    $loggedInUser->username = $user;
                    $loggedInUser->password = $pass;

                    //pass the values of $loggedInUser into the session -
                    // you can directly pass the values into the array as well.

                    $_SESSION["ThisUser"] = $loggedInUser;
                    header("Location: userpage.php");
    	}
    	else{
    		?><p>Username and Password combination is not valid</p> <?php
    	}


    	}
    elseif (isset($_POST['signup'])) {
            header("Location:signup.php");

    }
?>





</body>
<footer><p>&copy Prestige Worldwide <?php echo date("Y"); ?></p></footer>




</html>