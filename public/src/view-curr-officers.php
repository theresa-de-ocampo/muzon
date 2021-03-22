<?php
$query = "SELECT * FROM curr_officers ORDER BY officer_position, name";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			echo "<tr><td>$row->officer_position</td><td>$row->name</td</tr>";
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
finally {
	$pdo = NULL;
}
