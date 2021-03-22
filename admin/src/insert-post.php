<?php
if (isset($_POST["submit"])) {
	$title = $_POST["title"];
	$image = $_FILES["image"];
	$content = $_POST["content"];

	$file_name = $_FILES["image"]["name"];
	$file_type = $_FILES["image"]["type"];
	$file_tmp_name = $_FILES["image"]["tmp_name"];
	$file_error = $_FILES["image"]["error"];
	$file_size = $_FILES["image"]["size"];
	$allowed_file_types = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/jfif', 'image/png', 'image/bmp', 'image/dib', 'image/gif');

	if ($file_error === 0)
		if (in_array($file_type, $allowed_file_types))
			if ($file_size < 5000000) {
				require_once "../../commons/src/inc/dbh.php";
				try {
					// Query 1: Get the next post_id for the image's new file name.
					$pdo->beginTransaction();
					date_default_timezone_set("Asia/Manila");

					$query = <<<QUERY
						SELECT
							`AUTO_INCREMENT` AS id
						FROM
							INFORMATION_SCHEMA.TABLES
						WHERE
							TABLE_SCHEMA = 'muzon' AND 
							TABLE_NAME   = 'post'
QUERY;
					$stmt = $pdo->prepare($query);
					$stmt->execute();
					$post_id = $stmt->fetchColumn();

					// Locally copy the uploaded image.
					$tokenized_file_name = explode(".", $file_name);
					$file_ext = strtolower(end($tokenized_file_name));
					$new_file_name = $post_id.".".$file_ext;
					$file_dest = "../../public/img/posts/".$new_file_name;
					move_uploaded_file($file_tmp_name, $file_dest);

					// Query 2: Insert record into `post`.
					$now = date('Y-m-d h-i-s', time());
					$query = "INSERT INTO post (title, date_time_posted, content, image) VALUES(?, ?, ?, ?)";
					$stmt = $pdo->prepare($query);
					$stmt->execute([$title, $now, $content, $new_file_name]);

					$pdo->commit();
					$message = "New article was successfully posted!";
				}
				catch(PDOException $e) {
					$pdo->rollBack();
					$file = "log.txt";
					include "../../commons/src/inc/catch-template.php";
				}
				finally {
					$redirect = "../posts.php";
					include "../../commons/src/inc/finally-template.php";
				}
			}
			else
				$message = "Sorry, please upload an image that is less than 500MB.";
		else
			$message = "Please upload image files only.";
	else
		$message = "Sorry, there was an error uploading your image.";
}
