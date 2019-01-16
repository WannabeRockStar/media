<?php require "action/conn.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Title</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/comments.css">
	<link rel="stylesheet" type="text/css" href="css/chat.css">
</head>
<body>
	
	<header class="main-header">
		<div class="wrapper">
			<h2 class="logo">
				<a href="index.php" class="logo-link">Caseboorg</a>
			</h2>
			
			<?php if(isset($_SESSION["user_email"])) : ?>
				<ul class="navbar">
					<li class="nav-item">
						<a class="nav-link" href="#">
							<i class="fas fa-globe-asia"></i>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="action/logout.php">Logout</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="users.php">users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><?= $_SESSION["user_name"]; ?></a>
					</li>
				</ul>
			<?php else : ?>
				<ul class="navbar">
					<li class="nav-item">
						<a class="nav-link" href="login.php">Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php">Signup</a>
					</li>
				</ul>
			<?php endif; ?>
		</div>
	</header>
	<div class="header-layer"></div>

	
