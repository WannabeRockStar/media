<?php require "inc/header.php"; ?>
<?php accessControll(); ?>
<!-- SELECT * FROM friends WHERE NOT sent_from_user_id = 4 AND NOT sent_to_user_id = 4 -->
<main>
	<div class="wrapper">
		<h2 class="user-table-title">Friend Requests</h2>
		<table>
			<tr>
				<th>
					username
				</th>
				<th>
					Email
				</th>
				<th>
					Action
				</th>
			</tr>
			<?php
			$id = $_SESSION["user_id"];
			$sql = "SELECT * FROM users 
			INNER JOIN friends
			ON friends.sent_from_user_id = users.id
			WHERE friends.sent_to_user_id = '$id' AND friends.is_accepted = 0";

			$stmt = $conn->query($sql);
			$stmt->execute();

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
			
				<tr>
					<td><?= $row["user"]; ?></td>
					<td><?= $row["email"]; ?></td>
					<td><a class="friend-btn" href="action/addfriend.php?accept=<?= $row["id"]; ?>&user=<?= $row["sent_from_user_id"]; ?>">Friend Request</a></td>
				</tr>

			<?php endwhile; ?>

		</table>

		<h2 class="user-table-title">Total users</h2>
		<table>
			<tr>
				<th>
					username
				</th>
				<th>
					Email
				</th>
				<th>
					Action
				</th>
			</tr>
			<?php

			$arr = [];

			$sql = "SELECT * FROM friends WHERE sent_from_user_id = '$id' OR sent_to_user_id = '$id'";

			$stmt = $conn->query($sql);
			$stmt->execute();
			$result = $stmt->rowCount();
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				array_push($arr, $row["sent_from_user_id"], $row["sent_to_user_id"]);
			}

			if($result >= 0) {

				$sql = "SELECT * FROM users";
				$stmt = $conn->query($sql);
				$stmt->execute();


				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
					if(!in_array($row["id"], $arr)) { 
						if($row["id"] != $_SESSION["user_id"]) { ?>
					<tr>
						<td><?= $row["user"]; ?></td>
						<td><?= $row["email"]; ?></td>
						<td><a class="friend-btn" href="action/addfriend.php?id=<?= $row["id"]; ?>">Add friend</a></td>
					</tr>

				<?php
					}
				}
				endwhile; 
				}	?>

		</table>
	</div>
</main>

<?php require "inc/footer.php"; ?>