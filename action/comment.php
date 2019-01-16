<?php

require "conn.php";

if(isset($_POST["txt"]) && isset($_POST["post_id"])) :

	$post_id = $_POST["post_id"];
	$auth = $_SESSION["user_name"];
	$comment = htmlentities($_POST["txt"]);
	$comment = trim($comment, " ");

	if(empty($comment)) :
		die;
	endif;

	$sql = "INSERT INTO comments(post_id, author, comment) VALUES(:post_id, :author, :comment)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":post_id", $post_id);
	$stmt->bindParam(":author", $auth);
	$stmt->bindParam(":comment", $comment);

	$result = $stmt->execute();

	if($result) :
		require "../inc/content.php";
	endif;
endif;

