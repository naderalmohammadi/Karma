<?php
if(empty($_GET['postid'])){
  header("Location:index.php");
}
$username = $_GET['username'];
$postid = $_GET['postid'];
require_once("config.php");
$allrecords = fetchThisPost($username,$postid);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Update This Show</title></head>
<body>
<header>
    <table id="table2">
    <tr><td><a href="userpage.php?username=<?php print $username ?>">Karma</a> / Update This Question</td><td id="tdr">TESLA</td><tr>
    </table>
</header>
&nbsp
<form method="post">
<table id="table">
 <?php foreach ($allrecords as $details) { ?>
    <tr><td>Subject:</td>                   <td><input type="text" name="name" value="<?php print $details['subject']; ?>" maxlength="100" required></td></tr>
    <tr><td>Your Question:</td><td><textarea name="content" cols="40" rows="5" maxlength="400" required><?php print $details['content']; ?></textarea></td></tr>
    <tr><td><input type="submit" value="Update" name="submit"></td></tr>
    <?php } ?>
    </table>
</form>


<?php
if (isset($_POST['submit'])) {
        ?><p>Done</p><?php
                $user_name = $username;
                $post_id = $postid;
                $subject = $_POST['name'];
                $content = $_POST['content'];
                $rate = $_POST['rate'];
                $newpost = updateThisPost($user_name, $post_id, $subject, $content, $rate);
                header("Location:questionpage.php?subject=$subject&username=$username&postid=$postid");
    }
?>
</body>
<footer><p>&copy Nader Almohammadi <?php echo date("Y"); ?></p></footer>
</html>