<?php

require "conn.php";

if(isset($_GET["id"])) :

	$to = $_GET["id"];
	$from = $_SESSION["user_id"];

	$sql = "INSERT INTO friends(sent_from_user_id, sent_to_user_id) VALUES(:from_id, :to_id)";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":from_id", $from);
	$stmt->bindParam(":to_id", $to);

	$stmt->execute();

	header("location: ../users.php");

endif;


if(isset($_GET["accept"])) :

	$request_id = $_GET["accept"];
	$to = $_GET["user"];
	$from = $_SESSION["user_id"];
	$accept = 1;

	$sql = "UPDATE friends SET is_accepted = 1 WHERE id = :request_id";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":request_id", $request_id);

	$stmt->execute();
	$result = $stmt->rowCount();

	if($result) {

		$sql = "INSERT INTO friends(sent_from_user_id, sent_to_user_id, is_accepted) VALUES(:from_id, :to_id, :acc)";

		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":from_id", $from);
		$stmt->bindParam(":to_id", $to);
		$stmt->bindParam(":acc", $accept);

		$stmt->execute();
	}

	header("location: ../users.php");

endif;