<?php require "inc/header.php"; ?>

<main>
	<div class="wrapper">
		<div class="full-page">
			<form action="action/login.php" method="POST" id="login-form" class="reg-form">
				<div>
					<input type="text" class="reg-field" id="login-email" name="email" placeholder="Email">
				</div>
				<div class="email-err"></div>
				<div>
					<input type="password" class="reg-field" id="login-password" name="password" placeholder="Password">
				</div>
				<div class="pass-err"></div>
				<div>
					<input class="reg-btn" type="submit" name="login" value="Login">
				</div>
			</form>
		</div>
	</div>
</main>

<?php require "inc/footer.php"; ?>