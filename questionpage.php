<?php
require_once("config.php");
if (isUserLoggedIn()==false){
header("Location: index.php");
}
$postid = $_GET['postid'];
$allrecords = fetchThisPost($postid);
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

<?php
if($allrecords==0){
	?><p>You don't have any questions yet</p><?php
  }
	else{
?>
&nbsp
 <table id="table">
       <?php
      foreach($allrecords as $displayRecords) { ?>
      <thead>
      <th><?php print $displayRecords['subject']; ?></th>
      </thead>
      <tbody>
      <tbody>
        <tr><td id="tdm"><?php print $displayRecords['content']; ?></td></tr>
        <tr><td>Last Edit: <?php print $displayRecords['post_date']; ?></td></tr>
        <tr><td><form method="POST"><input type="submit" name="delete" value="Delete Post"></form></td></tr>
      <?php } ?>
      </tbody>
  </table>
<?php } ?>
<?php
if($allreplies==0){
  ?><p>No replies for this question yet</p><?php
}
  else{
?>
&nbsp
 <table id="table">
       <?php
      foreach($allreplies as $displayRecords) { ?>
        <tr><td id="td"><?php print $displayRecords['username']; ?>:</td></tr>
        <tr><td id="tdm"><?php print $displayRecords['rsubject']; ?></td></tr>
        <tr><td>Last Edit: <?php print $displayRecords['reply_date']; ?></td></tr>
        <?php if($displayRecords['username'] == $loggedInUser->username){} else{ ?><tr><form method="POST"><input type="hidden" name="replyid" value="<?php print $displayRecords['replyid'];?>"><td><?php if($isbest==0){ ?><input type="submit" name="best" value="Best Answer"><?php } elseif ($isbest == $displayRecords['replyid']) {?><tr><td>*best answer*</td></tr><?php } ?></form></td></tr><?php } ?>
      <?php } ?>
  </table>

<?php

if (isset($_POST['best'])) {
  $replyid = $_POST['replyid'];
  $best = bestThisReply($replyid);
    header("Location:questionpage.php?postid=$postid");
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
 if (isset($_POST['delete'])) {
  if($allrecords==0){

}
  else
  {
  foreach($allrecords as $displayRecords) {
      $delete = deleteThisPost($displayRecords['postid']);
      header("Location:userpage.php");}
  }
      }
    elseif (isset($_POST['update'])) {
              if($allrecords==0){

}
  else
  {
  foreach($allrecords as $displayRecords) {
      header("Location:questionupdate.phppostid=$postid");}
  }

    }
          elseif (isset($_POST['reply'])) {
            $rsubject = $_POST['rsubject'];
    $create = createNewReply($postid, $rsubject);
    header("Location:questionpage.php?postid=$postid");

    }

?>
</body>
<?php  require_once("footer.php"); ?>
</html>