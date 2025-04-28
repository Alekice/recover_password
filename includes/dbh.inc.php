<?php

$dbServerName = "localhost";
$dbUserName = "tovarnyj_znak_ru";
$dbPassword = "tovarnyj_znak_ru";
$dbName = "tovarnyj_znak_ru";

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
