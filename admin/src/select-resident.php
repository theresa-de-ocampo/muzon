<?php
require_once "../commons/src/inc/dbh.php";
$query = "SELECT resident_id, fname, mname, lname, bday, house_no, street FROM resident";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
			$inner_query = "CALL calculate_age(?, @age)";
			$inner_stmt = $pdo->prepare($inner_query);
			$inner_stmt->bindParam(1, $row->bday, PDO::PARAM_STR);
			$inner_stmt->execute();

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
					<td>$age</td>
					<td>$row->house_no</td>
					<td>$row->street</td>
				</tr>
ROW;
		}
	}
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after handling the last step of inserting a blotter record
