<?php
	// Do session things
	session_start();

	$page = basename($_SERVER['PHP_SELF']);

	// Check for login
	if (!($page == 'login.php' || $page == 'register.php' || $page == 'index.php')) {
		if (!isset($_SESSION['id'])) {
			header("Location: login.php");
		}
	}

	// if already logged in
	if ($page == 'login.php' || $page == 'register.php') {
		if (isset($_SESSION['id'])) {
			header("Location: index.php");
		}
	}
?>
