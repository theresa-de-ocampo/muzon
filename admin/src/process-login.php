<?php
session_start();
if (isset($_POST["login"])) {
	require_once "../../commons/src/inc/dbh.php";
	$email = $_POST["email"];
	$password = $_POST["password"];

	try {
		$query = "SELECT * FROM administrator WHERE admin_email = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$email]);
		$admin = $stmt->fetch(PDO::FETCH_OBJ);
		if ($admin) {
			if (password_verify($password, $admin->admin_password)) {
				$officer_id = $admin->officer_id;
				if ($officer_id)
					$_SESSION["admin-verified"] = $admin->officer_id;
				else
					$_SESSION["admin-verified"] = "Master Admin";
				$path = "../home.php";
			}
			else {
				$message = "The password you entered is incorrect!";
				$path = "../index.php";
			}
		}
		else {
			$message = "You do not have permission to access this website.";
			$path = "../index.php";
		}
		
	}
	catch(PDOException $e) {
		$path = "../index.php";
		$message = "An unexpected error occurred.";
		$file = "log.txt";
		include "../../commons/src/inc/catch-template.php";
	}
	finally {
		if (isset($message))
			echo "<script>alert('$message');</script>";
		echo "<script>window.location.href = '$path';</script>";
		$pdo = NULL;
	}
}
