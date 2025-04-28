<?php

class LoginContr extends Login
{

	private $uid;
	private $pwd;

	public function __construct($uid, $pwd)
	{
		$this->uid = $uid;
		$this->pwd = $pwd;
	}

	public function loginUser()
	{
		if ($this->emptyInput() == false) {
			// echo "Empty input!;
			header("location: ../index.php?error=emptyinput");
			exit(); // exit the entire script
		}

		$this->getUser($this->uid, $this->pwd);
	}

	private function emptyInput()
	{
		$result = true;
		if (empty($this->uid) || empty($this->pwd)) {
			$result = false;
		}
		return $result;
	}
}
