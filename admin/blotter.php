<?php require_once "src/verification.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/tables.css" />
	<link rel="stylesheet" type="text/css" href="css/modal.css" />
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
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
			<li><a href="blotter.php" class="active">Blotter</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>

	<main>
		<section id="blotter">
			<h2>Blotter</h2>
			<table id="blotter-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Complained Resident</th>
						<th>Complainant</th>
						<th>Offense Subject</th>
						<th>Status</th>
						<th>View</th>
						<th>Settle</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-blotter.php" ?>
				</tbody>
			</table><!-- #blotter-tbl -->
		</section><!-- #blotter -->
	</main>

	<div id="settle-blotter-modal" class="modal">
		<h3>Resolution</h3>
		<form action="src/settle-blotter-rec.php" method="post">
			<div class="grid-wrapper">
				<div class="grid-item">
					<label for="blotter-id">Blotter ID</label>
					<input id="blotter-id" type="number" name="blotter-id" readonly class="short default" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="complained-resident">Complained Resident</label>
					<input id="complained-resident" type="text" name="complained-resident" disabled />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<p>Status</p>
					<input id="settled" type="radio" name="blotter-status" value="Settled" required />
					<label for="settled" class="inline">Settled</label>
					<div id="new-line"></div>
					<input id="filed-to-action" type="radio" name="blotter-status" value="Filed to Action" />
					<label for="filed-to-action" class="inline">Filed to Action</label>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="date-resolved">Date Resolved</label>
					<input id="date-resolved" type="date" name="date-resolved" max="<?php echo date("Y-m-d"); ?>" class="medium" required />
				</div><!-- .grid-item -->
				<div class="grid-item solo">
					<label for="resolution-narrative">Settlement Narrative</label>
					<textarea id="resolution-narrative" name="resolution-narrative" rows="10" required class="solo"></textarea>
				</div><!-- .grid-item.solo -->
			</div><!-- .grid-wrapper -->

			<footer>
				<button id="modal-cancel" type="reset" name="cancel">Cancel</button>
				<button id="modal-ok" type="submit" name="submit">Submit</button>
			</footer>
		</form>
	</div><!-- #settle-blotter-modal -->

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/export.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/blotter.js"></script>
	<script src="js/modal.js"></script>
</body>
</html>