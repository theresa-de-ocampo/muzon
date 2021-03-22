<?php
	require_once "src/verification.php";
	$officer_id = $_POST["officer-id"];
	$officer_name = $_POST["officer-name"];
	$officer_position = $_POST["officer-position"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/tables.css" />
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
	<link rel="stylesheet" type="text/css" href="css/back-nav.css" />
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
			<li><a href="home.php" class="active">Home</a></li>
			<li><a href="residents.php">Residents</a></li>
			<li><a href="blotter.php">Blotter</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>
	
	<main id="terminate-officer">
		<a href="index.php"><i class="fas fa-arrow-circle-left"></i>Back to Main Home Page</a>
		<hr />
		<form action="src/insert-terminated-officer.php" method="post">
			<section id="terminate-officer">
				<h2>Termination</h2>
				<div class="outer grid-wrapper">
					<div class="grid-item">
						<label for="officer-id">Officer ID</label>
						<input id="officer-id" type="number" name="officer-id" value="<?= $officer_id ?>"
							readonly class="short default" />
					</div><!-- .grid-item -->
					<div class="grid-item">
						<label for="officer-name">Name</label>
						<input id="officer-name" type="text" name="officer-name" value="<?= $officer_name ?>" disabled />
					</div><!-- .grid-item -->
					<div class="grid-item">
						<label for="cause-of-termination">Cause of Termination</label>
						<select id="cause-of-termination" name="cause-of-termination" required>
							<option value=""></option>
							<option value="Resignation">Resignation</option>
							<option value="Transfer of Residence">Transfer of Residence</option>
							<option value="Transfer of Place of Work">Transfer of Place of Work</option>
							<option value="Withdrawal of Appointment">Withdrawal of Appointment</option>
						</select>
					</div><!-- .grid-item -->
					<div class="grid-item">
						<label for="date-terminated">Date Terminated</label>
						<input id="date-terminated" type="date" name="date-terminated" 
							max="<?= date("Y-m-d"); ?>" required class="medium" />
					</div><!-- .grid-item -->
					<div class="grid-item solo">
						<label for="termination-narrative">Termination Narrative</label>
						<textarea id="termination-narrative" name="termination-narrative" rows="10" 
							required class="solo"></textarea>
					</div><!-- .grid-item -->
				</div><!-- .outer.grid-wrapper -->
			</section><!-- #terminate-officer -->

			<section id="replacement">
				<h2>New <?php echo $officer_position; ?></h2>
				<p>
					<input id="replacement-id" type="number" name="replacement-id" readonly required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="replacement-tbl" class="display cell-border" width="100%">
					<?php
						if ($officer_position != "Youth Council Chairman")
							$path = "src/select-resident-legal-age.php";
						else
							$path = "src/select-resident-youth.php";
						require "inc-select-resident.php";
					?>
				</table><!-- #replacement-tbl -->
			</section><!-- #replacement -->

			<hr />
			<footer>
				<button type="reset" name="cancel">Cancel</button>
				<button type="submit" name="submit">Submit</button>
			</footer>
		</form>
	</main>

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/back-nav.js"></script>
	<script src="js/terminate-officer.js"></script>
</body>
</html>