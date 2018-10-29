<?php

  class loggedInUser {
	public $username = NULL;
	public $password = NULL;

      //Logout
      public function userLogOut()
      {
          destroySession("ThisUser");
      }
}
?>