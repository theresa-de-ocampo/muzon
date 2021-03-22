<?php
if (isset($_POST["create-account"])) {
	require_once "../../commons/src/inc/dbh.php";
	$officer_id = $_POST["officer-id"];
	$admin_email = $_POST["admin-email"];
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$query = "INSERT INTO administrator (admin_email, admin_password, officer_id) VALUES (?, ?, ?)";

	try {
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $admin_email, PDO::PARAM_STR);
		$stmt->bindParam(2, $password, PDO::PARAM_STR);
		$stmt->bindParam(3, $officer_id, PDO::PARAM_INT);
		$stmt->execute();
		
	}
	catch(PDOException $e) {
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		$message = "An account was successfully created for an officer!";
		$redirect = "../account.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
