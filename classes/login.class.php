<?php

class Login extends Dbh
{
	protected function getUser($uid, $pwd)
	{
		$stmt = $this->connect()->prepare("SELECT users_pwd FROM test_users WHERE users_uid = ? OR users_email = ?");

		// check if query was executed
		if (!$stmt->execute([$uid, $pwd])) {
			$stmt = null; // delete the statement entirely
			header("location: ../index.php?error=stmtfailed");
			exit(); // exit the entire script
		}

		// check if any rows are returned
		if ($stmt->rowCount() == 0) {
			header("location: ../index.php?error=usernotfound");
			exit(); // exit the entire script
		}

		$hashedPwd = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$checkPwd = password_verify($pwd, $hashedPwd[0]['users_pwd']);

		// check if password is correct
		if ($checkPwd == false) {
			$stmt = null;
			header("location: ../index.php?error=wrongpassword");
			exit(); // exit the entire script
		} elseif ($checkPwd == true) {
			$stmt = $this->connect()->prepare("SELECT * FROM test_users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?");

			// check if query was executed
			if (!$stmt->execute([$uid, $uid, $pwd])) {
				$stmt = null; // delete the statement entirely
				header("location: ../index.php?error=stmtfailed");
				exit(); // exit the entire script
			}

			// check if any rows are returned
			if ($stmt->rowCount() == 0) {
				header("location: ../index.php?error=usernotfound");
				exit(); // exit the entire script
			}

			$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

			session_start();
			$_SESSION["userid"] = $user[0]["users_id"];
			$_SESSION["useruid"] = $user[0]["users_uid"];
		}

		$stmt = null;
	}
}
