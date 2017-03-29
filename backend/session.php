<?php
if (isLoggedIn()) {
	$PersonId = $_SESSION['PersonId'];
	$UserType = $_SESSION['UserType'];
} else {
		echo '-1';
		exit;
}
?>
