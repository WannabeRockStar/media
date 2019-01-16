<?php

require "conn.php";

if(isset($_POST["login"])) :

	$email = $_POST["email"];
	$pass = $_POST["password"];

	$sql = "SELECT * FROM users WHERE email = :email";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":email", $email);
	$stmt->execute();

	if($stmt->rowCount() < 1) {
		header("location: ../index.php?email");
		die;
	} else {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$pass = password_verify($pass, $row["password"]);
		if($pass != true) {
			header("location: ../index.php?pass");
			die;
		} else {
			$_SESSION["user_id"] = $row["id"];
			$_SESSION["user_email"] = $row["email"];
			$_SESSION["user_name"] = $row["user"];

			header("location: ../index.php?success");
		}
	}

endif;