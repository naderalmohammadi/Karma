  <?php 
  require_once("config.php");
  ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
signup
</title>
</head>
<header>
    <table id="table2">
    <tr><th>Karma / Signup</th><th>TESLA</th></tr>
    </table>
    </header>

&nbsp
<body>


<form method='POST'>
<table id="table">
<tr>          <td><input type="text" name="username" maxlength="20" placeholder="Username.." required></td></tr>
<tr>             <td><input type="number" name="age" min ='18' step="1" max='80' placeholder="Age.." required></td></tr>
<tr>             <td><input type="radio" name="gender" value='Male' checked>Male<input type="radio" name="gender" value='Female'>Female</td></tr>
<tr>           <td><input type="email" name="email" maxlength="50" placeholder="Email..(example@tesla.com)" required></td></tr>
<tr>     <td><input type="email" name="emailcon" maxlength="50" placeholder="Confirm Email..(example@tesla.com)" required></td></tr>
<tr>       <td><input type="Password" name="pass" maxlength="20" placeholder="Password.." required></td></tr>
<tr>  <td><input type="Password" name="passcon" maxlength="20" placeholder="Confirm Password.." required></td></tr>

<tr><td colspan=2 align='center'><input type="submit" name="create" value="Create"></td></tr>
<tr><td colspan=2 align='center'><a href = "index.php">Login</a></td></tr>
</table>

<?php
    if (isset($_POST['create'])) {
    	$username = $_POST['username'];
    	$email = $_POST['email'];
        $tesla = '@tesla.com';
    	$thisuser = fetchThisUser($username);
    	$thisemail = fetchThisEmail($email);

        if($tesla != substr($email,-10,10)){
            ?><p>You are not an employee</p><?php
        }

    	   elseif ($_POST['email'] != $_POST['emailcon']){
    				?><p>Email confirmation doesn't match</p><?php
    		}
    		elseif ($_POST['pass'] != $_POST['passcon']){
    				?><p>Password confirmation doesn't match</p><?php
    		}
    		elseif ($thisuser==1){
					?><p>Username already exists</p><?php
    		}
    		elseif ($thisemail==1){
					?><p>Email already exists</p><?php
    		}
    		else{

				$name = $_POST['username'];
				$age = $_POST['age'];
				$gender = $_POST['gender'];
				$email = $_POST['email'];
				$pass = $_POST['pass'];


				$newuser = createNewUser($name, $age, $gender, $email, $pass);
				if ($newuser==1){
				header("Location:index.php");}}

    }
?>





</body>
<br><br><br><br><br><br><br>
<footer><p>&copy Prestige Worldwide <?php echo date("Y"); ?></p></footer>
</html>