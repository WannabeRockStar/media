<?php

require "conn.php";

$total = "";

if(isset($_POST["user"]) && isset($_POST["post"])) :
	$post = $_POST["post"];
	$user = $_POST["user"];

	$sql = "SELECT * FROM likes WHERE post_id = :post AND user_id = :user";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":post", $post);
	$stmt->bindParam(":user", $user);

	$stmt->execute();

	if($stmt->rowCount() < 1) :
		$sql = "INSERT INTO likes(post_id, user_id) VALUES(:post, :user)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":post", $post);
		$stmt->bindParam(":user", $user);

		$result = $stmt->execute();

		if($result) :
			$sql = "SELECT * FROM likes WHERE post_id = :post";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":post", $post);
			
			$stmt->execute();
			$total = $stmt->rowCount();
			
		endif;
	else :
		$sql = "DELETE FROM likes WHERE post_id = :post AND user_id = :user";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":post", $post);
		$stmt->bindParam(":user", $user);

		$result = $stmt->execute();

		if($result) :
			$sql = "SELECT * FROM likes WHERE post_id = :post";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":post", $post);
			
			$stmt->execute();
			$total = $stmt->rowCount();
			
		endif;
	endif;

	echo $total;
endif;