<?php 


function createNewUser($name, $age, $gender, $email, $pass)
{
  global $mysqli;
  $stmt = $mysqli->prepare(
    "INSERT INTO user (
		Username,
		Age,
		Gender,
		Email,
		Password
		)
		VALUES (
		?,
		?,
		?,
		?,
		?
		)"
  );
  $stmt->bind_param("sssss", $name, $age, $gender, $email, $pass);
  $result = $stmt->execute();
  $stmt->close();
  return $result;
}

function updateThisUser($age, $gender, $password){

	    global $mysqli, $loggedInUser;
    $stmt = $mysqli->prepare(
      "UPDATE user
    SET
    Age = ?,
    Gender = ?,
    Password = ?
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("ssss",$age, $gender, $password, $loggedInUser->username);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

function createNewPost($subject, $content)
{
  global $mysqli, $loggedInUser;
  $stmt = $mysqli->prepare(
    "INSERT INTO post (
		Username,
		Subject,
		Content
		)
		VALUES (
		?,
		?,
		?
		)"
  );
  $stmt->bind_param("sss", $loggedInUser->username, $subject, $content);
  $result = $stmt->execute();
  $stmt->close();
  return $result;

}



function createNewReply($postid, $rsubject){

  global $mysqli, $loggedInUser;
  $stmt = $mysqli->prepare(
    "INSERT INTO reply (
    Username,
    PostID,
    Rsubject
    )
    VALUES (
    ?,
    ?,
    ?
    )"
  );
  $stmt->bind_param("sss", $loggedInUser->username, $postid, $rsubject);
  $result = $stmt->execute();
  $stmt->close();
  return $result;

}

function doYouHavePoints(){

global $mysqli, $loggedInUser;
    $stmt = $mysqli->prepare(
      " SELECT Points
    FROM user
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $loggedInUser->username);
    $stmt->execute();
    $stmt->bind_result($points);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'points'               => $points

    );
  }
  $stmt->close();
  return $row;
}

function fetchUser()
{
    global $mysqli, $loggedInUser;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $loggedInUser->username);
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass, $points);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'username'             => $username,
      'age'                  => $age,
      'gender'               => $gender,
      'email'                => $email,
      'password'             => $pass,
      'points'               => $points

    );
  }
  $stmt->close();
  if (empty($row)==false){
  	return $row;
  }
  else{
  return 0;
}
}

function fetchThisUser($username)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass, $points);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'Username'             => $username,
      'Age'                  => $age,
      'Gender'               => $gender,
      'Email'                => $email,
      'Password'             => $pass,
      'Points'               => $points
    );
  }
  $stmt->close();
  if (empty($row)==false){
  	return 1;
  }
  else{
  return 0;
}
}

function fetchThisEmail($email)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Email = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $email);
    $result = $stmt->execute();
    $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass, $points);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'Username'             => $username,
      'Age'                  => $age,
      'Gender'               => $gender,
      'Email'                => $email,
      'Password'             => $pass,
      'Points'               => $points

    );
  }
  $stmt->close();
    if (empty($row)==false){
  	return 1;
  }
  else{
  return 0;
}
}

function fetchThisPost($postid)
{
    global $mysqli, $loggedInUser;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM post
    WHERE
    Username = ?
    AND
    PostID = ?
    LIMIT 1"
    );
    $stmt->bind_param("ss", $loggedInUser->username, $postid);
    $stmt->execute();
    $stmt->bind_result($postid, $username, $subject, $content, $post_date);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'postid'           => $postid,
      'username'         => $username,
      'subject'          => $subject,
      'content'          => $content,
      'post_date'        => $post_date

    );
  }
  $stmt->close();
  if (empty($row)==false){
  	return $row;
  }
  else{
  return 0;}
}



function fetchUserPost($user, $postid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM post
    WHERE
    Username = ?
    AND
    PostID = ?
    LIMIT 1"
    );
    $stmt->bind_param("ss", $user, $postid);
    $stmt->execute();
    $stmt->bind_result($postid, $username, $subject, $content, $post_date);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'postid'           => $postid,
      'username'         => $username,
      'subject'          => $subject,
      'content'          => $content,
      'post_date'        => $post_date

    );
  }
  $stmt->close();
  if (empty($row)==false){
    return $row;
  }
  else{
  return 0;}
}


function verifyThisUser($username,$pass)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      " SELECT *
    FROM user
    WHERE
    Username = ?
    and
    Password = ?
    LIMIT 1"
    );
    $stmt->bind_param("ss", $username,$pass);
    $result = $stmt->execute();
    $stmt->bind_result($username, $age, $gender, $email, $pass, $points);
    $stmt->execute();
  while ($stmt->fetch()) {
    $row[] = array(
      'Username'             => $username,
      'Age'                  => $age,
      'Gender'               => $gender,
      'Email'                => $email,
      'Password'             => $pass,
      'Points'               => $points

    );
  }
  $stmt->close();
    if (empty($row)==false){
  	return 1;
  }
  else{
  return 0;
}
}


function deleteThisPost($postid) {
	      global $mysqli;
            $stmt = $mysqli->prepare(
      "DELETE FROM reply where PostID= ?"
    );
    $stmt->bind_param("s", $postid);
    $stmt->execute();
    $stmt->close();



    $stmt2 = $mysqli->prepare(
      "DELETE FROM post where PostID= ?"
    );
    $stmt2->bind_param("s", $postid);
    $result = $stmt2->execute();
    $stmt2->close();
    return $result;
}

function deleteThisReply($replyid) {
        global $mysqli;
    $stmt = $mysqli->prepare(
      "DELETE FROM reply where ReplyID = ? "
    );
    $stmt->bind_param("s", $replyid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function bestThisReply($replyid) {
        global $mysqli;
    $stmt = $mysqli->prepare(
      "UPDATE reply SET bestanswer = 1 WHERE ReplyID = ? "
    );
    $stmt->bind_param("s", $replyid);
    $result = $stmt->execute();
    $stmt->close();

        $stmt = $mysqli->prepare(
      "UPDATE user SET Points = (Points + 1) WHERE Username = any (SELECT Username from reply WHERE ReplyID = ?) "
    );
    $stmt->bind_param("s", $replyid);
    $stmt->execute();
    $stmt->close();
}

function fetchAllPosts() {
  global $mysqli, $loggedInUser;
  $stmt = $mysqli->prepare(
    "SELECT
		PostID,
		Subject
		FROM Post
		WHERE Username =? 
    ORDER BY Post_date
		"
  );
  $stmt->bind_param("s", $loggedInUser->username);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $postid,
    $subject
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'postid'                => $postid,
      'subject'               => $subject
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
}
}


function updateThisPost($username, $postid, $subject, $content, $rate){

	    global $mysqli;
    $stmt = $mysqli->prepare(
      "UPDATE post
		SET
		Subject = ?,
		Content = ?,
		Rate = ?,
		post_date = CURRENT_TIMESTAMP
		WHERE
		Username = ?
		AND
		PostID = ?
		LIMIT 1"
    );
    $stmt->bind_param("sssss", $subject, $content, $rate, $username, $postid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function updateThisPoster($username, $postid, $image){

	    global $mysqli;
    $stmt = $mysqli->prepare(
      "UPDATE post
		SET
		Image = ?,
		post_date = CURRENT_TIMESTAMP
		WHERE
		Username = ?
		AND
		PostID = ?
		LIMIT 1"
    );
    $stmt->bind_param("sss", $image, $username, $postid);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function fetchThisReply($postid){
  global $mysqli;
  $stmt = $mysqli->prepare(
    "SELECT
    ReplyID,
    Username,
    PostID,
    Rsubject,
    Reply_date,
    bestanswer
    FROM Reply
    WHERE PostID =?
    ORDER BY Reply_date
    "
  );
  $stmt->bind_param("s", $postid);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $replyid,
    $username,
    $postid,
    $rsubject,
    $reply_date,
    $bestanswer
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'replyid'                => $replyid,
      'username'                => $username,
      'postid'                => $postid,
      'rsubject'               => $rsubject,
      'reply_date'               => $reply_date,
      'bestanswer'               => $bestanswer
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
}
}


function isBest($postid){
  global $mysqli;
  $stmt = $mysqli->prepare(
    "SELECT
    ReplyID
    FROM Reply
    WHERE PostID = ?
    AND
    bestanswer = 1
    "
  );
  $stmt->bind_param("s", $postid);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $replyid
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'replyid'                => $replyid
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
    foreach($row as $r){
      $bestanswer = $r["replyid"];
    }
  return ($bestanswer);
}
}



function searchAllPosts(){

  global $mysqli, $loggedInUser;
  $stmt = $mysqli->prepare(
    "SELECT
    Username,
    PostID,
    Subject
    FROM post
    WHERE Username != ? 
    ORDER BY Post_date
    "
  );
  $stmt->bind_param("s", $loggedInUser->username);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $username,
    $postid,
    $subject
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'username'                => $username,
      'postid'                => $postid,
      'subject'               => $subject
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
} 
}

function isUserLoggedIn()
{
    global $loggedInUser, $mysqli;
    $stmt = $mysqli->prepare("SELECT
    Username,
    Password
    FROM user
    WHERE
    Username = ?
    AND
    Password = ?
    LIMIT 1");
    $stmt->bind_param("ss", $loggedInUser->username, $loggedInUser->password);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInUser == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("ThisUser");
            return false;
        }
    }
}


function destroySession($name)
{
    if (isset($_SESSION[$name])) {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}


function fetchThisUserPoints(){
  global $mysqli, $loggedInUser;
  $stmt = $mysqli->prepare(
    "SELECT
    Points
    FROM user
    WHERE Username = ?
    limit 1
    "
  );
  $stmt->bind_param("s", $loggedInUser->username);
  $result = $stmt->execute();
  $stmt->execute();
  $stmt->bind_result(
    $points
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'points'                => $points
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
}
}


function takeOnePoint(){


  global $mysqli, $loggedInUser;
      $stmt = $mysqli->prepare(
      "UPDATE user
    SET
    Points = (Points-1)
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $loggedInUser->username);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

}


function giveOnePoint(){


  global $mysqli, $loggedInUser;
      $stmt = $mysqli->prepare(
      "UPDATE user
    SET
    Points = (Points+1)
    WHERE
    Username = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $loggedInUser->username);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


function lookUp($word){
    global $mysqli;
    $param = "%$word%";
    $stmt = $mysqli->prepare("SELECT
        Username,Subject,Post_date,PostID
        FROM post
        WHERE
         Subject LIKE ?
         OR
         Content LIKE ? ");
    $stmt->bind_param("ss", $param, $param);
    $stmt->execute();
    $stmt->bind_result(
    $username,
    $subject,
    $post_date,
    $postid
  );
  while ($stmt->fetch()) {
    $row[] = array(
      'username'                => $username,
      'subject'                => $subject,
      'post_date'                => $post_date,
      'postid'                => $postid
    );
  }
  $stmt->close();
  if(empty($row)){
  return 0;
  }
  else{
  return ($row);
}

}




?>
