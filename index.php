<?php require "inc/header.php"; ?>

<main>
	<div class="wrapper">
		<div class="main-content">
	<?php if(!isset($_SESSION["user_email"])) : ?>
		<div class="full-page">
			<form action="action/signup.php" method="POST" id="reg-form" class="reg-form">
				<div>
					<input type="text" class="reg-field" id="user" name="user" placeholder="Username">
				</div>
				<div class="user-err"></div>
				<div>
					<input type="text" class="reg-field" id="email" name="email" placeholder="Email">
				</div>
				<div class="email-err"></div>
				<div>
					<input type="password" class="reg-field" id="password" name="password" placeholder="Password">
				</div>
				<div class="pass-err"></div>
				<div>
					<input class="reg-btn" type="submit" name="reg" value="Signup">
				</div>
			</form>
		</div>
	<?php else : ?>
		<div class="err"></div>
			<form class="share" action="action/post.php" method="POST">
				<div>
					<textarea class="post-txt" name="post_txt" data-user="<?= $_SESSION["user_name"]; ?>" placeholder="Add post"></textarea>
				</div>
				<div>
					<input id="share-btn" class="share-btn" type="submit" name="share" value="Share">
				</div>
			</form>

			<div class="content">
				<?php require "inc/content.php"; ?>
			</div>

			<div class="friends">
				<?php require "inc/friends.php"; ?>
			</div>
			<div class="clear"></div>
			<div id="chat-box" data-from="1">
		        <div id="chat-close-btn">
		            <i class="fas fa-times"></i>
		        </div>
		        <div class="chat-user-name"></div>
		        <div class="chat-messages">
		          
		            
		        </div>
		        <textarea class="chat-post"></textarea>
		    </div>
	<?php endif; ?>
	</div>
	</div>
</main>

<?php require "inc/footer.php"; ?>