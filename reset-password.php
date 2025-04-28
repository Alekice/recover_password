<?php
include_once "header.php";
?>

<div class="wrapper">
	<h1>Reset your password</h1>
	<p>An e-mail will be sent to you with instructions on how to reset your password.</p>
	<form action="includes/reset-request.inc.php" method="post">
		<input type="text" name="email" placeholder="Enter your e-mail address...">
		<br>
		<button type="submit" name="reset-request-submit">Receive new password by e-mail</button>
	</form>
	<?php
	if (isset($_GET["reset"])) {
		if ($_GET["reset"] == "success") {
			echo "<p class=\"signupsuccess\">Check your e-mail!</p>";
		}
	}
	if (isset($_GET["reset"])) {
		if ($_GET["reset"] == "emailempty") {
			echo "<p class=\"signupsuccess\">Your e-mail is empty!</p>";
		}
	}
	?>
</div>

</body>

</html>