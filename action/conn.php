<?php

try {
	$conn = new PDO("mysql:host=localhost;dbname=chat;", "root", "");
	session_start();
	require "helpers.php";
} catch (PDOException $e) {
	echo "Connection Failed: " . $e->getMessage();
}