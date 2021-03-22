<?php
session_start();
if (isset($_POST["submit"])) {
	if (isset($_SESSION["post-id"]) && isset($_SESSION["image"])) {
		$post_id = $_SESSION["post-id"];
		$orig_image = $_SESSION["image"];
		$title = $_POST["title"];
		$image = $_FILES["image"];
		$content = $_POST["content"];
		$file_name = $_FILES["image"]["name"];
		$query = <<<QUERY
			UPDATE
				post 
			SET
				title = ?,
				content = ?,
				image = ?,
				post_status = 'Edited'
			WHERE
				post_id = ?
QUERY;

		if (!empty($file_name)) {
			$file_type = $_FILES["image"]["type"];
			$file_tmp_name = $_FILES["image"]["tmp_name"];
			$file_error = $_FILES["image"]["error"];
			$file_size = $_FILES["image"]["size"];
			$allowed_file_types = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/jfif', 'image/png', 'image/bmp', 'image/dib', 'image/gif');

			if ($file_error === 0)
				if (in_array($file_type, $allowed_file_types))
					if ($file_size < 5000000) {
						// Delete old image.
						unlink("../../public/img/posts/".$orig_image);

						// Locally copy the uploaded iamge.
						$tokenized_file_name = explode(".", $file_name);
						$file_ext = strtolower(end($tokenized_file_name));
						$new_file_name = $post_id.".".$file_ext;
						$file_dest = "../../public/img/posts/".$new_file_name;
						move_uploaded_file($file_tmp_name, $file_dest);
						$image = $new_file_name;
					}
					else
						$message = "Sorry, please upload an image that is less than 500MB.";
				else
					$message = "Please upload image files only.";
			else
				$message = "Sorry, there was an error uploading your image.";
		}
		else
			$image = $orig_image;

		if (!isset($message)) {
			require_once "../../commons/src/inc/dbh.php";
			try {
				$stmt = $pdo->prepare($query);
				$stmt->bindParam(1, $title, PDO::PARAM_STR);
				$stmt->bindParam(2, $content, PDO::PARAM_STR);
				$stmt->bindParam(3, $image, PDO::PARAM_STR);
				$stmt->bindParam(4, $post_id, PDO::PARAM_INT);
				$stmt->execute();

				$message = "Post was successfully edited!";
			}
			catch(PDOException $e) {
				$file = "log.txt";
				include "../../commons/src/inc/catch-template.php";
			}
			finally {
				$pdo = NULL;
			}
			/*
				Don't use the finally-template here.
				If the user just changed the photo, and since the name of the image is always the post_id, rowCount will return 0 if the previous file extension, is the same as the new one. This leads to the template into thinking that an error occurred since the rowCount says that no rows were affected.
			*/
		}
		echo "<script>alert('$message')</script>";
		echo "<script>window.location.href = '../posts.php';</script>";
	}
}
