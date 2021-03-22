<?php
$query = "SELECT * FROM curr_officers ORDER BY officer_position";

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
					<td><a class="fas fa-user-slash"></a></td>
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
