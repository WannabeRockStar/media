<?php

function accessControll() {
	if(!isset($_SESSION["user_id"])) :
		header("location: index.php");
	endif;
}