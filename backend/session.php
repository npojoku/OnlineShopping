<?php
include_once 'core.inc.php';

if (isLoggedIn()) {
	$PersonId = $_SESSION['PersonId'];
	$UserType = $_SESSION['UserType'];
} else {
		// user is not logged in, forward to login page
		header("Location: ../../frontend/php/login.php");
		exit;
}
?>
