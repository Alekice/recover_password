<?php

if (isset($_POST["reset-request-submit"]) && $_SERVER["REQUEST_METHOD"] == "POST")
{

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "www.myurl.com/create-new-password.php?selector={$selector}&validator=" . bin2hex($token);

	$expires = date("U") + 1800;

	require "dbh.inc.php";

	$userEmail = $_POST["email"];
	if (empty($userEmail)) {
		header("Location: ../reset-password.php?reset=emailempty");
		exit();
	}

	// Delete any existing tokens in our DB in case when a user requested to reset a password but didn't do it
	// We need to make sure that there is no existing token from the same user inside the DB
	$sql = "DELETE FROM test_pwd_reset WHERE pwdResetEmail = ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "s", $userEmail); // "s" stands for string data type
		mysqli_stmt_execute($stmt);
	}

	$sql = "INSERT INTO test_pwd_reset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?, ?, ?, ?)";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		// for protection
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires); // "s" stands for string data type
		mysqli_stmt_execute($stmt);
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

	$to = $userEmail;

	$subject = "Reset your password for www.myurl.com";

	$message = "<p>We recieved a password reset request. The link to reset your passwork is below.
	 If you did not make this request, you can ignore this email.</p>";
	$message .= "<p>Here is your password reset link:<br>";
	$message .= "<a href=\"{$url}\">{$url}</a></p>";

	// Headers that tell the mail function how we want to send this and which information we need to send with the email
	$headers = "From: myurl <myurl@gmail.com>\r\n";
	$headers .= "Reply-To: Avsem <avsem.zhe@gmail.com>\r\n";
	$headers .= "Content-type: text/html\r\n"; // need to enable html-code

	mail($to, $subject, $message, $headers);

	header("Location: ../reset-password.php?reset=success");

}
else
{
	header("Location: ../index.php");
}