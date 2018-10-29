<?php
require_once("config.php");

if (isUserLoggedIn()==false){
header("Location: index.php");
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Add New Question</title></head>
<?php  require_once("header.php"); ?>

<body>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
<table id="table">
    <tr><td><input type="text" name="name" maxlength="60" placeholder="Subject.." required></td></tr>
    <tr><td><textarea name="content" cols="40" rows="5" maxlength="400" placeholder="Your Question.." required></textarea></td></tr>
    <tr><td><input type="submit" value="Post" name="submit"></td></tr>
    </table>
</form>

<?php
$countpoints = doYouHavePoints();
foreach($countpoints as $pointstotal){
if (isset($_POST['submit'])) {
    if ($pointstotal['points'] == 0){
        ?><p>You are out of points</p><?php
    } else {
                $subject = $_POST['name'];
                $content = $_POST['content'];
                $newpost = createNewPost($subject, $content);
                $takeonepoint = takeOnePoint();
                header("Location: post.php");
            }
            }}
?>
</body>
<?php  require_once("footer.php"); ?>
</html>