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

<?php 
    $word = $_POST['word'];
    $word2 = "w";
    $lookup = lookUp($word);


if($lookup != 0){
foreach($lookup as $look){
  ?>
  <form>
  <table id="table">
      <tr><td><?php print $look['username']; ?>:</td></tr>
      <tr><td><a href="postdetails.php?user=<?php print $look['username'];?>&postid=<?php print $look['postid']; ?>"><h4><?php print $look['subject']; ?></h4></a></td></tr>
  </table>
  </form>
  <?php }
}
?>
</body>
<?php  require_once("footer.php"); ?>
</html>