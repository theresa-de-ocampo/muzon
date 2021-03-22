<?php

session_start();
if (isset($_SESSION["admin-verified"]))
	header("Location: home.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Jesus Lopez" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	<link rel="shortcut icon" type="image/x-icon" href="../commons/img/logo.png" />
	<title>Barangay Muzon Management System (BMMS)</title>
</head>
<body>
	<div class="holder">
		<div class="logo"><img src="../commons/img/logo.png" alt="logo"></div>

		<?php require_once "../commons/src/inc/dbh.php"; ?>
		<div class="fields-wrapper">
			<form action="src/process-login.php" method="post" class="login">
				<div class="field">
					<input type="email" placeholder="Email Address" name="email" required>
				</div><!-- .field -->
				
				<div class="field">
					<input type="password" placeholder="Password" name="password" required>
				</div><!-- .field -->
				
				<div class="password-options">
					<div>
						<input id="show-password" type="checkbox" />
						<label for="show-password">Show Password</label>
					</div>
					<!-- <a href="#forgot-password">Forgot password?</a> -->
				</div><!-- .password-options -->
				
				<div class="field btn">
					<div class="btn-layer"></div>
					<input type="submit" value="LOGIN" name="login">
				</div><!-- .field.btn -->
			</form><!-- .login -->
		</div><!-- .fields-wrapper -->
	</div><!-- .holder -->

	<script src="js/login.js"></script>
</body>
</html>