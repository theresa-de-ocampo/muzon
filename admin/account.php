<?php require_once "src/verification.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/tables.css" />
	<link rel="stylesheet" type="text/css" href="css/modal.css" />
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
	<link rel="stylesheet" type="text/css" href="css/account.css" />
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	<link rel="shortcut icon" type="image/x-icon" href="../commons/img/logo.png" />
	<title>Barangay Muzon Management System (BMMS)</title>
</head>
<body>
	<div class="overlay"></div>
	<nav>
		<input id="check-menu" type="checkbox" name="check-menu" />
		<label for="check-menu" class="fas fa-bars"></label>
		<div id="logo-wrapper"><img id="logo" src="../commons/img/logo.png" alt="logo" title="Muzon" /></div>
		<h1><abbr title="Barangay Muzon Management System">BMMS</abbr></h1>
		<ul>
			<li><a href="home.php">Home</a></li>
			<li><a href="residents.php">Residents</a></li>
			<li><a href="blotter.php">Blotter</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php" class="active"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>

	<main id="account">
		<section id="general" class="center-to-viewport">
			<?php require_once "src/get-admin.php"; ?>
			<h2><?php echo $admin_name; ?></h2>
			<h4><?php echo $admin_position; ?></h4>
			<div class="grid-wrapper">
				<div class="grid-item">
					<label for="sign-out" class="fas fa-sign-out-alt"></label>
					<input id="sign-out" type="button" value="Sign Out">
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="change-password" class="fas fa-user-lock"></label>
					<input id="change-password" type="button" value="Change Password">
				</div><!-- .grid-item -->
			</div><!-- .grid-wrapper -->
		</section><!-- #general.center-to-viewport -->
		
		<section id="create-account">
			<hr />
			<h2>Create an Account</h2>
			<table id="officers-without-account-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Position</th>
						<th>Name</th>
						<th>Create</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-officers-without-account.php"; ?>
				</tbody>
			</table><!-- #officers-without-account-tbl -->
		</section><!-- #create-account -->

		<section id="revoke-account">
			<form action="src/delete-officer-account.php" method="post">
				<h2>Revoke Account</h2>
				<table id="officers-with-account-tbl" class="display cell-border" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Position</th>
							<th>Name</th>
							<th>Revoke</th>
						</tr>
					</thead>
					<tbody>
						<?php require_once "src/view-officers-with-account.php"; ?>
					</tbody>
				</table><!-- #officers-with-account-tbl -->
				<input id="officer-id-revoke" type="hidden" name="officer-id" />
			</form>
		</section><!-- #revoke-account -->
	</main><!-- #account -->

	<div id="change-password-modal" class="modal">
		<h3>Change Password</h3>
		<form action="src/update-password.php" method="post" novalidate>
			<div class="grid-wrapper">
				<div class="grid-item">
					<label for="new-password">New Password</label>
					<input id="new-password" type="password" name="new-password" class="password" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="confirm-password-on-update">Confirm Password</label>
					<input id="confirm-password-on-update" type="password" name="confirm-password" class="password" />
				</div><!-- .grid-item -->
				<div class="grid-item solo show-passwords-wrapper">
					<input id="show-passwords-on-update" type="checkbox" class="show-passwords" />
					<label for="show-passwords-on-update">Show Passwords</label>
				</div><!-- .grid-item.solo -->
			</div>
			<input id="officer-id-change" type="hidden" name="officer-id" value="<?= $_SESSION['admin-verified'] ?>" />

			<footer>
				<button type="reset" name="cancel">Cancel</button>
				<button type="submit" name="change-password">Submit</button>
			</footer>
		</form>
	</div><!-- #change-password-modal -->

	<div id="create-account-modal" class="modal">
		<h3>Create Account</h3>
		<form action="src/insert-administrator.php" method="post" novalidate>
			<div class="grid-wrapper">
				<div class="grid-item">
					<label for="officer-name">Name</label>
					<input id="officer-name" type="text" name="officer-name" disabled />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="admin-email">Email</label>
					<input id="admin-email" type="email" name="admin-email" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="password">Password</label>
					<input id="password" type="password" name="password" class="password medium" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="confirm-password-on-create">Confirm Password</label>
					<input id="confirm-password-on-create" type="password" name="confirm-password" class="password medium" />
				</div><!-- .grid-item -->
				<div class="grid-item solo show-passwords-wrapper">
					<input id="show-passwords-on-create" type="checkbox" class="show-passwords" />
					<label for="show-passwords-on-create">Show Passwords</label>
				</div><!-- .grid-item.solo -->
			</div><!-- .grid-wrapper -->
			<input id="officer-id-create" type="hidden" name="officer-id" />

			<footer>
				<button type="reset" name="cancel">Cancel</button>
				<button type="submit" name="create-account">Submit</button>
			</footer>
		</form>
	</div><!-- #create-account-modal -->

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/account.js"></script>
	<script src="js/modal.js"></script>
</body>
</html>