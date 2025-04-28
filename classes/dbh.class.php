<?php

class Dbh {

	protected function connect() {
		try {
			$username = "tovarnyj_znak_ru";
			$password = "tovarnyj_znak_ru";
			$dbh = new PDO("mysql:host=localhost;dbname=tovarnyj_znak_ru", $username, $password);
			// Optional
			return $dbh;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br>";
			die();
		}
	}

}


// Previous
// class Dbh {

// 	private $host = "localhost";
// 	private $user = "tovarnyj_znak_ru";
// 	private $pwd = "tovarnyj_znak_ru";
// 	private $dbName = "tovarnyj_znak_ru";

// 	protected function connect() {
// 		// Data source name
// 		$dsn = "mysql:host={$this->host};dbname={$this->dbName}";
// 		$pdo = new PDO($dsn, $this->user, $this->pwd);
// 		// Optional - set how we want to pull out the data, so we don't have to define it throughout the code
// 		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// 		// Optional
// 		return $pdo;
// 	}

// }