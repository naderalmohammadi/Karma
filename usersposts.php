<?php
require_once("config.php");
if (isUserLoggedIn()==false){
header("Location: index.php");
}
$allrecords = searchAllPosts();
?>
<html >
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
List of posts
</title>
</head>
<?php  require_once("header.php"); ?>

<body>
<?PHP
if($allrecords==0){
  echo '<br><b>';
	?><p>There are no posts yet</p><?php
	}
	else{
?>
&nbsp
 <table id="table">
      <?php
      foreach($allrecords as $displayRecords) { ?>
      <tr><td><?php print $displayRecords['username']; ?>:</td></tr>
      <tr><td><a href="postdetails.php?user=<?php print $displayRecords['username'];?>&postid=<?php print $displayRecords['postid']; ?>"><h4><?php print $displayRecords['subject']; ?></h4></a></td></tr>
      <?php } ?>
  </table>
<?php } ?>

</body>
<?php  require_once("footer.php"); ?>
</html>