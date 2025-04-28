<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Grabbing the data
	$uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, "UTF-8"); // sanitize string, convert speacial characters to HTML entities
	$pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, "UTF-8");

	// Instantiate SignupContr class
	include "../classes/dbh.class.php";
	include "../classes/login.class.php";
	include "../classes/login-contr.class.php";
	$login = new LoginContr($uid, $pwd);

	// Running error handlers and user signup
	$login->loginUser();

	// Going back to front page
	header("location: ../index.php?error=none");

}