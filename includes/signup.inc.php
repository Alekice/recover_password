<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

	// Grabbing the data
	$uid = htmlspecialchars($_POST["uid"], ENT_QUOTES, "UTF-8"); // sanitize string, convert speacial characters to HTML entities
	$pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, "UTF-8");
	$pwdrepeat = htmlspecialchars($_POST["pwdrepeat"], ENT_QUOTES, "UTF-8");
	$email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");

	// Instantiate SignupContr class
	include "../classes/dbh.class.php";
	include "../classes/signup.class.php";
	include "../classes/signup-contr.class.php";
	$signup = new SignupContr($uid, $pwd, $pwdrepeat, $email);

	// Running error handlers and user signup
	$signup->signupUser();

	$userId = $signup->fetchUserId($uid);

	// Instantiate ProfileInfoContr class
	include "../classes/profileinfo.class.php";
	include "../classes/profileinfo-contr.class.php";
	$profileInfo = new ProfileInfoContr($userId, $uid);
	$profileInfo->defaultProfileInfo();

	// Going back to front page
	header("location: ../index.php?error=none");
	exit(); // exit the entire script

}