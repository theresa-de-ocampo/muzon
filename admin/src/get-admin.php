<?php
require_once "../commons/src/inc/dbh.php";


try {
	$adminVerified = $_SESSION["admin-verified"];
	if ($adminVerified != "Master Admin") {
		$query = "CALL get_officer_admin(?, @admin_name, @admin_position)";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(1, $adminVerified , PDO::PARAM_INT);
		$stmt->execute();

		$query = "SELECT @admin_name";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$admin_name = $stmt->fetchColumn();

		$query = "SELECT @admin_position";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$admin_position = $stmt->fetchColumn();
	}
	else {
		$admin_name = "Master Admin";
		$admin_position = "Muzon - Naic - Cavite";
	}
	
}
catch(PDOException $e) {
	require "../commons/src/inc/terminate-template.php";
}
// connection is closed later at view-officers-without-account.php
