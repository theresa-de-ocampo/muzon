<?php
require_once "../commons/src/inc/convert-to-long-date.php";
require_once "../commons/src/inc/create-preview.php";
require_once "../commons/src/inc/dbh.php";
$query = "SELECT * FROM post WHERE post_status = 'Deleted' ORDER BY date_time_posted DESC";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		DEFINE("PREVIEW_LIMIT", 135);
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$post_id = $row->post_id;
			$date_time_posted = convert_to_long_date(null, $row->date_time_posted);
			$content_preview = create_preview($row->content, PREVIEW_LIMIT);
			echo <<<ROW
				<tr>
					<td>$post_id</td>
					<td>$row->title</td>
					<td>$date_time_posted</td>
					<td>$content_preview</td>
					<td><a href="post-details.php?id=$post_id" class="fas fa-eye"></a></td>
					<td><a href="src/restore-post.php?id=$post_id" class="fas fa-trash-restore"></a></td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
finally {
	$pdo = NULL;
}
// connection is closed later after displaying the last table
