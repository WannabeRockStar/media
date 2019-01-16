<ul class="friend-list">
	<?php
	$sess_id = $_SESSION["user_id"];

	$sql = "SELECT friends.sent_from_user_id, friends.sent_to_user_id, users.user, users.id
	FROM friends
	INNER JOIN users
	ON users.id = friends.sent_to_user_id
	WHERE friends.sent_from_user_id = '$sess_id' AND friends.is_accepted = 1";

	$stmt = $conn->query($sql);

	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
		
		if($_SESSION["user_id"] !== $row["id"]) : ?>
		<li class="fr-item">
			
			<a href="#" class="fr-link" data-user="<?= $row["id"]; ?>">
				<div class="user-icon"></div><?= $row["user"]; ?>
			</a>
			<a class="friend-list-btn" href="action/delete.php?deleteuser=<?= $row["id"]; ?>">remove friend</a>
		</li>
		<?php endif; ?>

	<?php endwhile; ?>
</ul>