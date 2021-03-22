<?php
require_once "../../commons/src/inc/dbh.php";
$officer_id = $_POST["officer-id"];
$query = "DELETE FROM administrator WHERE officer_id = ?";

try {
	$stmt = $pdo->prepare($query);
	$stmt->execute([$officer_id]);
}
catch(PDOException $e) {
	$file = "log.txt";
	include "../../commons/src/inc/catch-template.php";
}
finally {
	$message = "Account was successfully deleted!";
	$redirect = "../account.php";
	include "../../commons/src/inc/finally-template.php";
}
