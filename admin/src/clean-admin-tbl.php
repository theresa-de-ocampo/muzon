<?php
require_once "../../commons/src/inc/dbh.php";
$query = "DELETE admin FROM administrator AS admin INNER JOIN officer USING(officer_id) WHERE officer_status = 'Past'";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute();
}
catch(PDOException $e) {
	$file = "log.txt";
	include "../../commons/src/inc/catch-template.php";
}
finally {
	$message = "Access permissions were successfully cleaned!";
	$redirect = "../account.php";
	include "../../commons/src/inc/finally-template.php";
}
