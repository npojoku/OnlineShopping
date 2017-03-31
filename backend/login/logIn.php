<?php
/*
Path: /login/login.php

Description: log in function

Input:
	$_POST
		'Email'		(string) Email
		'Password'	(string) Password

Output
	1						login

Error:
	0						Invalid Email/Password combination
	-1
	-7						required field not set
*/
include_once '../../backend/core.inc.php';


global $con;
$errors = array();

// verify database connection
if (! isConnected()) {
  // could not connect to database, redirect to error page
  header("Location: ../../frontend/php/error.php");

} else if(isset($_POST['login'])){

  $hasError = false;

  // verify email has been entered
  if(!isset($_POST['Email']) || empty($_POST['Email'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please include a valid email.</center></div>';
    $hasError = true;
  }

  // verify password has been entered
  if(!isset($_POST['Password']) || empty($_POST['Password'])){
    $errors[] = '<div class="alert alert-danger" role="alert"><center>Please include a valid password.</center></div>';
    $hasError = true;
  }

  // don't continue if fields are not valid
  if(!$hasError){
    // process login request
  	$Email = $_POST['Email'];
  	$Password = $_POST['Password'];
    	$Password_hash = md5($Password);

  	$result = loginUser($Email, $Password_hash);

    if($result){
      // login was successful
      // forward to product list page
      header("Location: ../../frontend/php/productList.php");

  	} else {
      // login was unsuccessful
      $errors[] = '<div class="alert alert-danger" role="alert"><center>Login was unsuccessful.</center></div>';
  	}
  }
} else if(isLoggedIn()){
  // if login page is loaded but there is no post request
  // and session is logged in, log out of the current session
  logoutUser();
}
?>
