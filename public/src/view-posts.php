<?php
require_once "../commons/src/inc/dbh.php";
require_once "../commons/src/inc/convert-to-long-date.php";
require_once "../commons/src/inc/create-preview.php";
$query = "SELECT * FROM post WHERE post_status != 'Deleted' ORDER BY date_time_posted DESC";
try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		DEFINE("PREVIEW_LIMIT", 100);
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$title = $row->title;
			$sub_heading = $date_time_posted = convert_to_long_date(null, $row->date_time_posted);
			$content = nl2br($row->content);
			$char_count = strlen($title.$date_time_posted.$content);

			if ($char_count > 350)
				$content = create_preview($content, PREVIEW_LIMIT).
					"<a href='post-details.php?id=$row->post_id'>See More</a>";
			if ($row->post_status == 'Edited')
				$sub_heading .= "<i>(Edited)</i>";

				echo <<<POST
				<div class="update-item">
					<div class="update-info">
						<h1>$title</h1>
						<h2>$sub_heading</h2>
						<p>
							$content
						</p>
					</div><!-- .update-info -->
					<div class="update-img">
						<img src="img/posts/$row->image" alt="$row->title">
					</div><!-- .update-img -->
				</div><!-- .update-item -->
POST;
		}
	}
	else
		echo "<h2 class='no-updates'>No updates!</h2><h2 class='no-updates'>Check again tomorrow :)</h2>";
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying the current officials
