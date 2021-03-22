<?php
require_once "../commons/src/inc/dbh.php";

try {
	$query = "SELECT COUNT(resident_id) FROM resident";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$population = $stmt->fetchColumn();

	$query = "SELECT COUNT(resident_id) FROM resident WHERE sex = 'Male'";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$male = $stmt->fetchColumn();

	$query = "SELECT COUNT(resident_id) FROM resident WHERE sex = 'Female'";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$female = $stmt->fetchColumn();

	$query = "SELECT COUNT(house_no) FROM household WHERE household_status = 'Active'";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$household = $stmt->fetchColumn();

	$query = "SELECT COUNT(resident_id) FROM resident WHERE TIMESTAMPDIFF(YEAR, bday, CURDATE()) >= 60";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$senior = $stmt->fetchColumn();

	$query = "SELECT COUNT(resident_id) FROM resident WHERE occupation = 'N/A' AND  TIMESTAMPDIFF(YEAR, bday, CURDATE()) >= 25";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$unemployed = $stmt->fetchColumn();

	$query = "SELECT COUNT(blotter_id) FROM blotter";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$pending = $stmt->fetchColumn();

	$query = "SELECT COUNT(resolution_id) FROM resolution";
	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$settled = $stmt->fetchColumn();
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later after displaying table of officers
