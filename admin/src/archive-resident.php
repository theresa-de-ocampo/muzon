<?php
require_once "../../commons/src/inc/dbh.php";
$query = "UPDATE resident SET resident_status = 'Deleted' WHERE resident_id = ?";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute([$_POST["resident-id"]]);
}
catch(PDOException $e) {
	$file = "log.txt";
	require "../../commons/src/inc/terminate-template.php";
}
finally {
	$message = "Resident was successfully archived!";
	$redirect = "../residents.php";
	include "../../commons/src/inc/finally-template.php";
}
