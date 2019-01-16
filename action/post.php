<?php

require "conn.php";

if(isset($_POST["txt"]) && isset($_POST["user"])) :
	$body = htmlentities($_POST["txt"]);
	$author = $_POST["user"];
	$user_id = $_SESSION["user_id"];
	$body = trim($body, " ");
	
	$sql = "INSERT INTO posts(user_id, body, author) VALUES(:user_id, :body, :author)";
	$stmt = $conn->prepare($sql);
	
	$stmt->bindParam(":user_id", $user_id);
	$stmt->bindParam(":body", $body);
	$stmt->bindParam(":author", $author);


	$result = $stmt->execute();

	if($result) :
		require "../inc/content.php";
	endif;
endif; ?>