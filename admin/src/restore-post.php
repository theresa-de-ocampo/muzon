<?php
require_once "../../commons/src/inc/dbh.php";
$query = "UPDATE post SET post_status = 'Active' WHERE post_id = ?";
if (isset($_GET["id"])) {
	try {
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(1, $_GET["id"], PDO::PARAM_INT);
		$stmt->execute();
	}
	catch(PDOException $e) {
		$file = "log.txt";
		require "../../commons/src/inc/terminate-template.php";
	}
	finally {
		$message = "Post was successfully republished!";
		$redirect = "../archive.php";
		include "../../commons/src/inc/finally-template.php";
	}
}
