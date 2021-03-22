<?php
$query = "SELECT * FROM officers_without_account ORDER BY officer_position, name";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			echo <<<ROW
				<tr>
					<td>$row->officer_id</td>
					<td>$row->officer_position</td>
					<td>$row->name</td>
					<td><a class="fas fa-plus-square"></a></td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later at officers-with-account.php
