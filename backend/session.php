<?php
if (loggedin()) {
	$PersonId = $_SESSION['PersonId'];
} else {
		echo '-1';
		exit;
}
?>