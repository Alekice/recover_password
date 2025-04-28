<?php

class ProfileInfo extends Dbh {

	protected function getProfileInfo($userId) {
		$stmt = $this->connect()->prepare("SELECT * FROM test_profiles WHERE users_id = ?");

		if (!$stmt->execute([$userId])) {
			$stmt = null;
			header("location: profile.php?error=stmtfailed");
			exit();
		}

		if ($stmt->rowCount() == 0) {
			$stmt = null;
			header("location: profile.php?error=profilenotfound");
			exit();
		}

		$profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $profileData;
	}

	protected function setNewProfileInfo($profileAbout, $profileTitle, $profileText, $userId)
	{
		$stmt = $this->connect()->prepare("UPDATE test_profiles SET profiles_about = ?, profiles_introtitle = ?, profiles_introtext = ? WHERE users_id = ?");

		if (!$stmt->execute([$profileAbout, $profileTitle, $profileText, $userId])) {
			$stmt = null;
			header("location: profile.php?error=stmtfailed");
			exit();
		}

		$stmt = null;
	}

	protected function setProfileInfo($profileAbout, $profileTitle, $profileText, $userId)
	{
		$stmt = $this->connect()->prepare("INSERT INTO test_profiles(profiles_about, profiles_introtitle, profiles_introtext, users_id) VALUES(?, ?, ?, ?)");

		if (!$stmt->execute([$profileAbout, $profileTitle, $profileText, $userId])) {
			$stmt = null;
			header("location: profile.php?error=stmtfailed");
			exit();
		}

		$stmt = null;
	}

}