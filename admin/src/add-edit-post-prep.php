<?php
$event = $_GET["event"];
if (!isset($event)) {
	echo "<script>alert('Sorry, something went wrong!');</script>";
	echo "<script>window.location.href = 'posts.php'</script>";
}
else {
	$featured_photo = $event."-featured-photo";
	$redirect = "src/".$event."-post.php";
	
	if ($event === "edit") {
		$post_id = $_GET["id"];
		$_SESSION["post-id"] = $post_id;

		// Retrieve record from database.
		$query = "SELECT * FROM post WHERE post_id = ?";
		require_once "../commons/src/inc/dbh.php";

		try {
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(1, $post_id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
				$row = $stmt->fetch(PDO::FETCH_OBJ);
				$title = $row->title;
				$content = $row->content;
				$image = $row->image;
				$_SESSION["image"] = $image;
				$src = "../public/img/posts/".$image;
				$photo_prompt = "Change Photo";
				$button_label = "Edit";
			}
		}
		catch(PDOException $e) {
			require "../commons/src/inc/terminate-template.php";
		}
		finally {
			$pdo = NULL;
		}
	}
	else {
		$title = "";
		$content = "";
		$image = "";
		$src = "../public/img/posts/default.png";
		$photo_prompt = "Upload Photo";
		$button_label = "Add";
	}
}
