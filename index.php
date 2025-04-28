<?php
include_once "header.php";
?>

<section class="index-intro">
	<div class="index-intro-bg">
		<div class="wrapper">
			<div class="index-intro-c1">
				<div class="video"></div>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur felis at vulputate euismod.</p>
			</div>
			<div class="index-intro-c2">
				<h2>We make<br>professional<br>gear</h2>
				<a href="#">FIND OUR GEAR HERE</a>
			</div>
		</div>
	</div>
</section>

<section class="index-login">
	<div class="wrapper">
		<div class="index-login-signup">
			<h4>SIGN UP</h4>
			<p>Don't have an account yet? Sign up here!</p>
			<form action="includes/signup.inc.php" method="post">
				<input type="text" name="uid" placeholder="Username">
				<input type="password" name="pwd" placeholder="Password">
				<input type="password" name="pwdrepeat" placeholder="Repeat Password">
				<input type="text" name="email" placeholder="E-mail">
				<br>
				<button type="submit" name="submit">SIGN UP</button>
			</form>
		</div>
		<div class="index-login-login">
			<h4>LOGIN</h4>
			<p>Don't have an account yet? Sign up here!</p>
			<form action="includes/login.inc.php" method="post">
				<input type="text" name="uid" placeholder="Username">
				<input type="password" name="pwd" placeholder="Password">
				<br>
				<button type="submit" name="submit">LOGIN</button>
			</form>
		</div>
	</div>
</section>
<?php
if (isset($_GET["newpwd"])) {
	if ($_GET["newpwd"] == "passwordupdated") {
		echo "<p class=\"signupsuccess\">Your password has been reset!</p>";
	}
}
?>

<a href="reset-password.php">Forgot your password?</a>

</body>

</html>