<?php

require "conn.php";

if(isset($_POST["reg"])) :

	$user = $_POST["user"];
	$email = $_POST["email"];
	$pass = $_POST["password"];

	if(empty($user)) { 
		header("location: ../index.php?emptyuser");
		die();
	}
	if(!preg_match("/^[a-zA-Z ]*$/", $user)) {
		header("location: ../index.php?invaliduser");
		die();
	}

	if(empty($email)) { 
		header("location: ../index.php?emptyemail");
		die();
	}
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("location: ../index.php?invalidEmail");
		die();
	}

	if(strlen($pass) < 4 || strlen($pass) > 12) {
		header("location: ../index.php?invalidpassword");
		die();
	}

	$pass = password_hash($pass, PASSWORD_DEFAULT);
	
	$sql = "SELECT * FROM users WHERE email = :email";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":email", $email);
	$stmt->execute();
	if($stmt->rowCount() > 0) {
		header("location: ../index.php?exists");
		die;
	} else {
		$sql = "INSERT INTO users(email, user, password) VALUES(:email, :user, :pass)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":user", $user);
		$stmt->bindParam(":email", $_POST["email"]);
		$stmt->bindParam(":pass", $pass);
		$stmt->execute();

		if($stmt->rowCount() > 0) {
			$id = $conn->lastInsertId();
			$sql = "SELECT * FROM users WHERE id = :last_id";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":last_id", $id);
			

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			// print_r($row);
			// die();
			
			$_SESSION["user_id"] = $row["id"];
			$_SESSION["user_email"] = $row["email"];
			$_SESSION["user_name"] = $row["user"];

			header("location: ../index.php");
		}
	}

	

	

endif;