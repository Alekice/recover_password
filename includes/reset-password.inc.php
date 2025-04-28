<?php

if (isset($_POST["reset-password-submit"]) && $_SERVER["REQUEST_METHOD"] == "POST")
{

	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = $_POST["pwd"];
	$passwordRepeat = $_POST["pwd-repeat"];

	if (empty($password) || empty($passwordRepeat)) {
		header("Location: ../create-new-password.php?selector={$selector}&validator={$validator}&newpwd=empty");
		exit();
	} elseif ($password != $passwordRepeat) {
		header("Location: ../create-new-password.php?selector={$selector}&validator={$validator}&newpwd=pwdnotsame");
		exit();
	}

	$currentDate = date("U");

	require "dbh.inc.php";

	$sql = "SELECT * FROM test_pwd_reset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo "There was an error!";
		exit();
	} else {
		mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate); // "s" stands for string data type
		mysqli_stmt_execute($stmt);

		$result = mysqli_stmt_get_result($stmt);
		if (!$row = mysqli_fetch_assoc($result)) {
			echo "You need to re-submit your reset request.";
			exit();
		} else {
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

			if ($tokenCheck === false) {
				echo "You need to re-submit your reset request.";
				exit();
			} elseif ($tokenCheck === true) { // check for true in case if var $tokenCheck returns something else rather than boolean
				$tokenEmail = $row["pwdResetEmail"];

				$sql = "SELECT * FROM test_users WHERE emailUsers = ?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo "There was an error!";
					exit();
				} else {
					mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
						echo "There was an error.";
						exit();
					} else {
						$sql = "UPDATE test_users SET users_pwd = ? WHERE users_email = ?";
						$stmt = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt, $sql)) {
							echo "There was an error!";
							exit();
						} else {
							$newPwdHash = password_hash($password, PASSWORD_DEFAULT);
							mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
							mysqli_stmt_execute($stmt);

							$sql = "DELETE FROM test_pwd_reset WHERE pwdResetEmail = ?";
							$stmt = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "There was an error!";
								exit();
							} else {
								mysqli_stmt_bind_param($stmt, "s", $newPwdHash, $tokenEmail);
								mysqli_stmt_execute($stmt);
								header("Location: ../index.php?newpwd=passwordupdated");
							}
						}
					}
				}
			}
		}
	}

}
else
{
	header("Location: ../index.php");
}