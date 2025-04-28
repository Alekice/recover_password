<?php

class Signup extends Dbh {

	protected function setUser($uid, $pwd, $email)
	{
		$stmt = $this->connect()->prepare("INSERT INTO test_users(users_uid, users_pwd, users_email) VALUES(?, ?, ?)");

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // encode

		// check if query was executed
		if (!$stmt->execute([$uid, $hashedPwd, $email])) {
			$stmt = null; // delete the statement entirely
			header("location: ../index.php?error=stmtfailed");
			exit(); // exit the entire script
		}

		$stmt = null;
	}

	protected function checkUser($uid, $email) {
		$stmt = $this->connect()->prepare("SELECT users_uid FROM test_users WHERE users_uid = ? OR users_email = ?");

		// check if query was executed
		if (!$stmt->execute([$uid, $email])) {
			$stmt = null; // delete the statement entirely
			header("location: ../index.php?error=stmtfailed");
			exit(); // exit the entire script
		}

		// check if any rows are returned
		$resultCheck = true;
		if ($stmt->rowCount() > 0) {
			$resultCheck = false;
		}
		return $resultCheck; // if a user exists, we do not let them sign up
	}

	protected function getUserId($uid)
	{
		$stmt = $this->connect()->prepare("SELECT users_id FROM test_users WHERE users_uid = ?");

		if (!$stmt->execute([$uid])) {
			$stmt = null;
			header("location: ../profile.php?error=stmtfailed");
			exit();
		}

		if ($stmt->rowCount() == 0) {
			$stmt = null;
			header("location: ../profile.php?error=profilenotfound");
			exit();
		}

		$profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $profileData;
	}

}