<?php
include_once "header.php";
include "classes/dbh.class.php";
include "classes/profileinfo.class.php";
include "classes/profileinfo-view.class.php";

$profileInfo = new ProfileInfoView();
?>

<section class="profile">
	<div class="profile-bg">
		<div class="wrapper">
			<div class="profile-settings">
				<h3>PROFILE SETTINGS</h3>
				<p>Change your about section here!</p>
				<form action="includes/profileinfo.inc.php" method="post">
					<textarea name="about" rows="10" cols="30" placeholder="Profile about section..."><?php $profileInfo->fetchAbout($_SESSION["userid"]); ?></textarea>
					<br><br>
					<p>Change your profile page intro here!</p>
					<br>
					<input type="text" name="introtitle" placeholder="Profile title..." value="<?php $profileInfo->fetchTitle($_SESSION["userid"]); ?>">
					<textarea name="introtext" rows="10" cols="30" placeholder="Profile introduction..."><?php $profileInfo->fetchText($_SESSION["userid"]); ?></textarea>
					<button type="submit" name="submit">SAVE</button>
				</form>
			</div>
		</div>
	</div>
</section>

</body>

</html>