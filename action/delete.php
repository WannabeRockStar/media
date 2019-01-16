<?php
require "conn.php";

if(isset($_GET["id"])) :

	$post_id = $_GET["id"];

	$sql = "DELETE FROM posts WHERE id = :post_id";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":post_id", $post_id);

	$stmt->execute();

	header("location: ../index.php");

endif;

if(isset($_GET["deleteuser"])) :

	$user_id = $_GET["deleteuser"];
	$my_id = $_SESSION["user_id"];

	$sql = "DELETE FROM friends
	WHERE (sent_from_user_id = :user_id AND sent_to_user_id = :my_id);";

	$sql .= "DELETE FROM friends
	WHERE (sent_from_user_id = :my_id AND sent_to_user_id = :user_id)";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":user_id", $user_id);
	$stmt->bindParam(":my_id", $my_id);

	$stmt->execute();

	header("location: ../index.php");

endif;