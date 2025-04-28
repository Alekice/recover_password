<?php
declare(strict_types=1);
include "includes/autoloader.inc.php";
session_start(); // in every single page of the website we need to make sure to insert session_start to be able to see when the user is logged in
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>

	<header>
		<nav>
			<div>
				<h3>DANI KROSSING</h3>
				<ul class="menu-main">
					<li><a href="index.php">HOME</a></li>
					<li><a href="#">PRODUCTS</a></li>
					<li><a href="#">CURRENT SALES</a></li>
					<li><a href="#">MEMBER+</a></li>
				</ul>
			</div>
			<ul class="menu-member">
				<?php
				if ($_SESSION["userid"]) {
				?>
					<li><a href="profile.php"><?php echo $_SESSION["useruid"]; ?></a></li>
					<li><a href="includes/logout.inc.php" class="header-login-a">LOGOUT</a></li>
				<?php } else { ?>
					<li><a href="#">SIGN UP</a></li>
					<li><a href="#" class="header-login-a">LOGIN</a></li>
				<?php } ?>
			</ul>
		</nav>
	</header>