<?php
require_once "inc/dbh.php";
require_once "inc/convert-to-long-date.php";
$post_id = $_GET["id"];
$query = "SELECT * FROM post WHERE post_id = ?";

try {
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(1, $post_id, PDO::PARAM_INT);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		$row = $stmt->fetch(PDO::FETCH_OBJ);
		$sub_heading = $date_time_posted = convert_to_long_date(null, $row->date_time_posted);
		$content = nl2br($row->content);

		if ($row->post_status == 'Edited')
			$sub_heading .= "<i>(Edited)</i>";
		if (basename(getcwd()) == "admin")
			$image = "../public/img/posts/".$row->image;
		else
			$image = "img/posts/".$row->image;

		echo <<<PAGE
			<section id="post-details">
				<h2>$row->title</h2>
				<h4>$sub_heading</h4>
				<img src="$image" alt="featured-photo" />
				<p>$content</p>
			</section>
PAGE;
	}
}
catch(PDOException $e) {
	require "inc/terminate-template.php";
}
finally {
	$pdo = NULL;
}
