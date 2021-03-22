<?php
try {
	// `household` table maintenance
	// If a resident was recently deleted, and nobody no longer lives in his previous address,
	// delete record from household table.
	$query = <<<QUERY
	UPDATE household
	SET household_status = 'Deleted'
	WHERE NOT EXISTS (
		SELECT
			house_no,
			street
		FROM
			resident
		WHERE
			(household.house_no = resident.house_no) AND
			(household.street = resident.street) AND
			resident_status = 'Active'
	)
QUERY;

	$stmt = $pdo->prepare($query);
	$stmt->execute();

	$query = "SELECT house_no, street FROM household WHERE household_status = 'Active' ORDER BY street, house_no";
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			echo "<tr>";
			foreach ($row as $key => $col)
				echo "<td>$col</td>";
			echo <<<CLOSER
					<td><a class="fas fa-copy"></a></td>
				</tr>
CLOSER;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
finally {
	$pdo = NULL;
}
