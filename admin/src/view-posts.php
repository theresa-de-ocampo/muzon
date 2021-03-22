<?php
require_once "../commons/src/inc/convert-to-long-date.php";
require_once "../commons/src/inc/create-preview.php";
require_once "../commons/src/inc/dbh.php";
$query = "SELECT * FROM post WHERE post_status != 'Deleted' ORDER BY date_time_posted DESC";
try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		DEFINE("PREVIEW_LIMIT", 135);
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$post_id = $row->post_id;
			$date_time_posted = convert_to_long_date(null, $row->date_time_posted);
			$content = $row->content;
			if (strlen($content) > PREVIEW_LIMIT)
				$content_preview = create_preview($content, PREVIEW_LIMIT);
			else
				$content_preview = $content;

			echo <<<ROW
				<tr>
					<td>$post_id</td>
					<td>$row->title</td>
					<td>$date_time_posted</td>
					<td>$content_preview</td>
					<td><a href="add-edit-post.php?event=edit&id=$post_id" class="fas fa-edit"></a></td>
					<td><a href="src/archive-post.php?id=$post_id" class="fas fa-trash-alt"></a></td>
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
