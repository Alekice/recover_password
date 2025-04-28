<?php
include_once "header.php";
include "classes/profileinfo.class.php";
include "classes/profileinfo-view.class.php";

$profileInfo = new ProfileInfoView();
?>

<section class="profile">
	<div class="profile-bg">
		<div class="wrapper">
			<div class="profile-info">
				<div class="profile-info-img">
					<p><?php echo $_SESSION["useruid"]; ?></p>
					<div class="break"></div>
					<a href="profilesettings.php" class="follow-btn">PROFILE SETTINGS</a>
				</div>
				<div class="profile-info-about">
					<h3>ABOUT</h3>
					<p><?php $profileInfo->fetchAbout($_SESSION["userid"]); ?></p>
					<h3>FOLLOWERS</h3>
					<h3>FOLLOWING</h3>
				</div>
			</div>
			<div class="profile-content">
				<div class="profile-intro">
					<h3><?php $profileInfo->fetchText($_SESSION["userid"]); ?></h3>
					<p>
						<?php $profileInfo->fetchTitle($_SESSION["userid"]); ?>
					</p>
				</div>
				<div class="profile-posts">
					<h3>POSTS</h3>
					<div class="profile-post">
						<h2>IT IS A BUSY DAY IN TOWN</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur felis at vulputate euismod.</p>
						<p>12:46 - 09/11/2021</p>
					</div>
					<div class="profile-post">
						<h2>RE-USING ELECTRONICS IS A GOOD IDEA</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur felis at vulputate euismod.</p>
						<p>12:46 - 09/11/2021</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

</body>

</html>