<?php

session_start(); // in order to use session vars

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Grabbing the data
	$id = $_SESSION["userid"];
	$uid = $_SESSION["useruid"];
	$about = htmlspecialchars($_POST["about"], ENT_QUOTES, "UTF-8"); // sanitize string, convert speacial characters to HTML entities
	$introTitle = htmlspecialchars($_POST["introtitle"], ENT_QUOTES, "UTF-8");
	$introText = htmlspecialchars($_POST["introtext"], ENT_QUOTES, "UTF-8");

	include "../classes/dbh.class.php";
	include "../classes/profileinfo.class.php";
	include "../classes/profileinfo-contr.class.php";
	$profileInfo = new ProfileInfoContr($id, $uid);

	$profileInfo->updateProfileInfo($about, $introTitle, $introText);

	// Going back to front page
	header("location: ../profile.php?error=none");
}