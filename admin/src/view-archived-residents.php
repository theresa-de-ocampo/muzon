<?php
require_once "../commons/src/inc/convert-to-long-date.php";
$query = "SELECT resident_id, fname, mname, lname, sex, bday FROM resident WHERE resident_status = 'Deleted' ORDER BY lname";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$bday = convert_to_long_date($row->bday, null);
			$inner_query = "CALL calculate_age(?, @age)";
			$inner_stmt = $pdo->prepare($inner_query);
			$inner_stmt->execute([$row->bday]);
			$inner_query = "SELECT @age";
			$inner_stmt = $pdo->prepare($inner_query);
			$inner_stmt->execute();
			$age = $inner_stmt->fetchColumn();

			echo <<<ROW
				<tr>
					<td>$row->resident_id</td>
					<td>$row->fname</td>
					<td>$row->mname</td>
					<td>$row->lname</td>
					<td>$row->sex</td>
					<td>$bday</td>
					<td>$age</td>
					<td><a class="fas fa-trash-restore"></a></td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying the last table
