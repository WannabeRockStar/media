<?php

require "conn.php";

if(isset($_POST["user_id"]) AND isset($_POST["txt"])) :

	$from = $_SESSION["user_id"];
	$to = $_POST["user_id"];
	$msg = htmlentities($_POST["txt"]);

	if(strlen($msg) < 1) {
		exit();
	} else {
		$sql = "INSERT INTO chat(from_user_id, to_user_id, message) VALUES(:from_id, :to_id, :msg)";

		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":from_id", $from);
		$stmt->bindParam(":to_id", $to);
		$stmt->bindParam(":msg", $msg);

		$stmt->execute();
	}

	

endif;




if(isset($_POST["to"])) :

	$from = $_SESSION["user_id"];
	$to = $_POST["to"];
	$sql = "SELECT * FROM chat 
			WHERE (from_user_id = :from_id AND to_user_id = :to_id) 
			OR (from_user_id = :to_id AND to_user_id = :from_id)
			ORDER BY created_at ASC";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":from_id", $from);
	$stmt->bindParam(":to_id", $to);

	$result = $stmt->execute();

	if($stmt->rowCount() > 0) :
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
			if($row["from_user_id"] == $from) : ?>
				<p class="from-msg"><?= $row["message"]; ?></p>
			<?php else : ?>
				<p class="to-msg"><?= $row["message"]; ?></p>
			<?php endif; ?>
		<?php endwhile;
	endif;

endif; ?>