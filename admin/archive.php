<?php require_once "src/verification.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/tables.css" />
	<link rel="stylesheet" type="text/css" href="css/media-queries.css" />
	<link rel="shortcut icon" type="image/x-icon" href="../commons/img/logo.png" />
	<title>Barangay Muzon Management System (BMMS)</title>
</head>
<body>
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
			<li><a href="archive.php" class="active">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>

	<main>
		<section id="past-officers">
			<h2>History of Officers</h2>
			<table id="past-officers-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>Position</th>
						<th>Name</th>
						<th>Start</th>
						<th>End</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-past-officers.php"; ?>
				</tbody>
			</table><!-- #past-officers-tbl -->
		</section><!-- #past-officers -->

		<section id="terminated-officers">
			<h2>Terminated Officers</h2>
			<table id="terminated-officers-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>Position</th>
						<th>Name</th>
						<th>Cause of Termination</th>
						<th>Start</th>
						<th>End</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-terminated-officers.php"; ?>
				</tbody>
			</table><!-- #terminated-officers-tbl -->
		</section><!-- #terminated-officers -->

		<section id="archived-residents">
			<h2>Archived Residents</h2>
			<table id="archived-residents-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Sex</th>
						<th>Birthday</th>
						<th>Age</th>
						<th>Restore</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-archived-residents.php"; ?>
				</tbody>
			</table><!-- #terminated-officers-tbl -->
			<form id="restore-resident" action="src/restore-resident.php" method="post">
				<input id="resident-id-to-be-restored" type="hidden" name="resident-id" />
			</form><!-- #restore-resident -->
		</section><!-- #deleted-residents -->

		<section id="unoccupied-units">
			<h2>Unoccuppied Units</h2>
			<table id="unoccupied-units-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>House Number</th>
						<th>Street</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-unoccupied-units.php"; ?>
				</tbody>
			</table><!-- #unoccupied-units-tbl -->
		</section><!-- #unoccupied-units -->

		<section id="resolved-cases">
			<h2>Resolved Blotter Cases</h2>
			<table id="resolved-cases-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Complained Resident</th>
						<th>Complainant</th>
						<th>Offense Subject</th>
						<th>Date Reported</th>
						<th>Date Resolved</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-resolved-cases.php"; ?>
				</tbody>
			</table><!-- #resolved-cases-tbl -->
		</section><!-- #resolved-cases -->

		<section id="past-posts">
			<h2>Past News and Updates</h2>
			<table id="past-posts-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Date Time Posted</th>
						<th>Content Preview</th>
						<th>View</th>
						<th>Restore</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-past-posts.php"; ?>
				</tbody>
			</table><!-- #past-posts-tbl -->
		</section><!-- #past-posts -->
	</main>

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/export.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/archive.js"></script>
</body>
</html>