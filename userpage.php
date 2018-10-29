<?php
require_once("config.php");

if (isUserLoggedIn()==false){
header("Location: index.php");
}
$allrecords = fetchAllPosts();
?>

<html >


<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>
Profile
</title>
</head>
<?php  require_once("header.php"); ?>

<body>
<div id="sidebar"><a href="editprofile.php"><h6 id="p">Edit Profile</h6></a>
<?php if($p["points"]>0) {?><a href="post.php"><h6 id="p">Add New Question</h6></a><?php }else{} ?><a href="aboutus.php"><h6 id="p">About us</h6></a><a href="aboutkarma.php"><h6 id="p">About Karma website</h6></a><a href="usersposts.php"><h6 id="p">List of Questions</h6></a><a href="search.php"><h6 id="p">Search</h6></a></div>
<?PHP
if($allrecords==0){
  echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
	?><p>You don't have any questions yet</p><?php
	}
	else{
?>
&nbsp
 <table id="table">
      <?php
      foreach($allrecords as $displayRecords) { ?>
      <tr><td><a href="questionpage.php?postid=<?php print $displayRecords['postid']; ?>"><?php print $displayRecords['subject']; ?></a></td></tr>
      <?php } ?>
  </table>
<?php } ?>

</body>
<?php  require_once("footer.php"); ?>
</html>