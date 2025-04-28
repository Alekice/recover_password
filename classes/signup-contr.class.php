<?php

class SignupContr extends Signup {

	private $uid;
	private $pwd;
	private $pwdrepeat;
	private $email;

	public function __construct($uid, $pwd, $pwdrepeat, $email) {
		$this->uid = $uid;
		$this->pwd = $pwd;
		$this->pwdrepeat = $pwdrepeat;
		$this->email = $email;
	}

	public function signupUser()
	{
		if ($this->emptyInput() == false) {
			// echo "Empty input!;
			header("location: ../index.php?error=emptyinput");
			exit(); // exit the entire script
		}
		if ($this->invalidUid() == false) {
			// echo "Invalid username!;
			header("location: ../index.php?error=username");
			exit(); // exit the entire script
		}
		if ($this->invalidEmail() == false) {
			// echo "Invalid email!;
			header("location: ../index.php?error=email");
			exit(); // exit the entire script
		}
		if ($this->passwordMatch() == false) {
			// echo "Password doesn't match!;
			header("location: ../index.php?error=passwordmatch");
			exit(); // exit the entire script
		}
		if ($this->uidTakenCheck() == false) {
			// echo "Username or email taken!;
			header("location: ../index.php?error=emailtaken");
			exit(); // exit the entire script
		}

		$this->setUser($this->uid, $this->pwd, $this->email);
	}

	private function emptyInput() {
		$result = true;
		if (empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)) {
			$result = false;
		}
		return $result;
	}

	private function invalidUid()
	{
		$result = true;
		if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
			$result = false;
		}
		return $result;
	}

	private function invalidEmail()
	{
		$result = true;
		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$result = false;
		}
		return $result;
	}

	private function passwordMatch()
	{
		$result = true;
		if ($this->pwd !== $this->pwdrepeat) {
			$result = false;
		}
		return $result;
	}

	private function uidTakenCheck()
	{
		$result = true;
		if (!$this->checkUser($this->uid, $this->email)) {
			$result = false;
		}
		return $result;
	}

	public function fetchUserId($uid) {
		$userId = $this->getUserId($uid);
		return $userId[0]["users_id"];
	}

}