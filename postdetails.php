<?php
require_once("config.php");
if (isUserLoggedIn()==false){
header("Location: index.php");
}
$user = $_GET['user'];
$postid = $_GET['postid'];
$allrecords = fetchUserPost($user,$postid);
$allreplies = fetchThisReply($postid);
$isbest = isBest($postid);
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
<?PHP
if($allrecords==0){
	?><p>You don't have any posts yet</p><?php
  }
	else{
?>
&nbsp
 <table id="table">
       <?php
      foreach($allrecords as $displayRecords) { ?>
      <thead>
      <tr><th id="td"><?php print $displayRecords['username']; ?>:</th></tr>
      <tr><th><?php print $displayRecords['subject']; ?></th></tr>
      </thead>
      <tbody>
      <tbody>
        <tr><td id="tdm"><?php print $displayRecords['content']; ?></td></tr>
        <tr><td>Last Edit: <?php print $displayRecords['post_date']; ?></td></tr>
      <?php } ?>
      </tbody>
  </table>
<?php } ?>
<?php
if($allreplies==0){
  ?><p>No replies for this post yet, be the first to reply!</p><?php
}
  else{
?>
&nbsp
 <table id="table">
       <?php
      foreach($allreplies as $displayRecords) { ?>
        <tr><td id="td"><?php print $displayRecords['username']; ?>'s reply:</td></tr>
        <tr><td id="tdm"><?php print $displayRecords['rsubject']; ?></td></tr>
        <tr><td>Last Edit: <?php print $displayRecords['reply_date']; ?></td></tr>
        <?php if($displayRecords['username'] == $loggedInUser->username){ if($isbest==0 or $isbest!=$displayRecords['replyid']){?><tr><td><form method="POST"><input type="hidden" name="replyid" value="<?php print $displayRecords['replyid'];?>"><input type="submit" name="deletereply" value="Delete Reply"><?php } elseif ($isbest == $displayRecords['replyid']) {?><tr><td>*best answer*</td></tr><?php } ?></form></td></tr><?php } ?>
      <?php } ?>
  </table>
<?php


if (isset($_POST['deletereply'])) {
  $replyid = $_POST['replyid'];
  $delete = deleteThisReply($replyid);
    header("Location:postdetails.php?user=$user&postid=$postid");
}
 } ?>




&nbsp
<form method='POST'>
 <table id="table">
        <tr><td><textarea id="td" name="rsubject" cols="40" rows="5" maxlength="400" required></textarea></td></tr>
                <tr><td><input type="submit" name="reply" value="Reply"></td></tr>
  </table>
  </form>


<?php

  if (isset($_POST['reply'])) {
    $rsubject = $_POST['rsubject'];
    $create = createNewReply($postid, $rsubject);
    header("Location:postdetails.php?postid=$postid&user=$user");

    }

?>
</body>
<?php  require_once("footer.php"); ?>
</html>