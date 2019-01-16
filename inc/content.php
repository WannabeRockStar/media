<?php 
// fetch posts from db with limit
$us_id = $_SESSION["user_id"];
$arr = [];
//$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 0, 9";
$sql = "SELECT * FROM friends 
WHERE (sent_from_user_id = '$us_id' AND is_accepted = 1)
OR (sent_to_user_id = '$us_id' AND is_accepted = 1)";

$stmt = $conn->query($sql);
$stmt->execute();
$result = $stmt->rowCount();
if($result) {
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		array_push($arr, $row["sent_from_user_id"], $row["sent_to_user_id"]);
	}
	// print_r($arr);
	// die();

	$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 0, 9";

	$stmt = $conn->query($sql);
	// execute sql query
	$stmt->execute();
	// fetch data with loop
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : 
		if(in_array($row["user_id"], $arr)) {
		$id = $row["id"];
		?>
		<div class="post">
			<h4 class="post-auth"><?= $row["author"]; ?></h4>
			<small class="post-time"><?= $row["created_at"]; ?></small>
			<p class="post-text"><?= $row["body"]; ?></p>
			<div class="icons" data-user="<?= $_SESSION["user_id"]; ?>" data-post="<?= $row["id"]; ?>">
				<div class="like-btn btnz">
					<i class="far fa-thumbs-up"></i>
					<?php

					$sql2 = "SELECT * FROM likes WHERE post_id = '$id'";
					$stmt2 = $conn->query($sql2);
					$stmt2->execute();
					$total = $stmt2->rowCount();
						
					?>
					<span class="likes-total">
						<?= $total; ?>
					</span>
				</div>
				<div class="comment-btn btnz">
					<i class="far fa-comments"></i>
					<?php

					$sql4 = "SELECT * FROM comments WHERE post_id = '$id'";
					$stmt4 = $conn->query($sql4);
					$stmt4->execute();
					$totalComments = $stmt4->rowCount();
						
					?>
					<span><?= $totalComments; ?></span>
				</div>
			</div>
			
			<div class="comments">
				
				<?php 
				
				$sql3 = "SELECT * FROM comments WHERE post_id = '$id'";
				$stmt3 = $conn->query($sql3);
				$stmt3->execute();
				if($stmt3->rowCount() > 0) : ?>
				<div class="comment-box">
				<?php
				while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) : ?>
					<div class="comment">
						<p class="comment-txt"><span class="comment-auth"><?= $row3["author"]; ?>: </span><?= $row3["comment"]; ?></p>
					</div>
				<?php endwhile; ?>
				</div>
				<?php endif;
			//} ?>
		
		</div>
		<form class="comment-form" method="POST">
			<input type="hidden" class="auth" name="post_id" value="<?= $_SESSION["user_name"]; ?>">
			<input type="hidden" class="post-id" name="post_id" value="<?= $id; ?>">
			<textarea type="text" class="comment-field" data-post="<?= $id; ?>" name="comment" placeholder="Write a comment..."></textarea>
		</form>
		<?php if($row["user_id"] === $_SESSION["user_id"]) : ?>
		<div class="delete-post-btn">
			<a class="delete-post-link" href="action/delete.php?id=<?= $row["id"]; ?>">
				<i class="fas fa-times"></i>
			</a>
		</div>
		<?php endif; ?>
	</div>
<?php } ?>
<?php endwhile;	?>

<?php } ?>