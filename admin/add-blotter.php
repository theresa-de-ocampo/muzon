<?php require_once "src/verification.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/datatables.min.css" />
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/tables.css" />
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
	<link rel="stylesheet" type="text/css" href="css/back-nav.css" />
	<link rel="stylesheet" type="text/css" href="css/add-blotter.css" />
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
			<li><a href="blotter.php" class="active">Blotter</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>

	<main id="add-blotter">
		<a href="blotter.php"><i class="fas fa-arrow-circle-left"></i>Back to Blotter List</a>
		<hr />
		<form action="src/insert-blotter.php" method="post">
			<section id="complained">
				<h2><span>Complained Resident</span></h2>
				<p>
					<b>Complained Resident: </b>
					<input id="complained-resident-id" type="number" name="complained-resident-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="complained-tbl" class="display cell-border" width="100%">
					<?php
						$path = "src/select-resident.php";
						require "inc-select-resident.php";
					?>
				</table><!-- #complained-tbl -->
			</section><!-- #complained -->

			<section id="guardian" class="hidden">
				<h2><span>For Children In Conflict With The Law</span></h2>
				<p>
					<b>Guardian of Complained Resident: </b>
					<input id="guardian-complained-resident-id" type="number" 
						name="guardian-complained-resident-id" class="readonly" />
					<span class="name-holder"><i>(Click on a row.)</i></span></p>
				<table id="guardian-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #blotter-resident-tbl -->
			</section><!-- #guardian -->

			<section id="complainant">
				<h2><span>Complainant Data</span></h2>
				<p>
					<b>Complainant: </b>
					<input id="complainant-resident-id" type="number" name="complainant-resident-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<div id="complainant-menu">
					<button type="button" name="local" class="local selected">Local</button>
					<button type="button" name="outsider" class="outsider">Outsider</button>
				</div><!-- #complainant-menu -->

				<div class="local">
					<table id="complainant-tbl" class="display cell-border" width="100%">
						<?php require "inc-select-resident.php"; ?>
					</table><!-- #blotter-resident-tbl -->
				</div><!-- .local -->

				<div class="outer grid-wrapper">
					<div class="grid-item fname">
						<label for="fname">First Name</label>
						<input id="fname" type="text" name="fname" />
					</div><!-- .grid-item.fname -->
					<div class="grid-item mname">
						<label for="mname">Middle Name</label>
						<input id="mname" type="text" name="mname" />
					</div><!-- .grid-item.mname-->
					<div class="grid-item lname">
						<label for="lname">Last Name</label>
						<input id="lname" type="text" name="lname" />
					</div><!-- .grid-item.lname -->
					<div class="grid-item contact-no">
						<label for="contact-no">Contact No. <i>(09*********)</i></label>
						<input id="contact-no" type="text" name="contact-no" class="some-medium" pattern="^09[0-9]{9}" />
					</div><!-- .grid-item.contact-no -->
					<div class="grid-item grid-wrapper address">
						<div class="grid-item">
							<label for="house-no">House No.</label>
							<input id="house-no" type="text" name="house-no" class="short" />
						</div><!-- .grid-item -->
						<div class="grid-item">
							<label for="street">Street</label>
							<input id="street" type="text" name="street" class="medium" />
						</div><!-- .grid-item -->
					</div><!-- .grid-item.grid-wrapper.address -->
					<div class="grid-item brgy">
						<label for="brgy">Barangay</label>
						<input id="brgy" type="text" name="brgy" />
					</div><!-- .grid-item.brgy -->
					<div class="grid-item city-town">
						<label for="city-town">City/Town</label>
						<input id="city-town" type="text" name="city-town" />
					</div><!-- .grid-item.city-town -->
					<div class="grid-item province">
						<label for="province">Province</label>
						<input id="province" type="text" name="province" />
					</div><!-- .grid-item.province -->
				</div><!-- .outer.grid-wrapper -->
			</section><!-- #complainant -->

			<section id="report">
				<h2><span>Incident Report</span></h2>
				<div class="outer grid-wrapper">
					<div class="grid-item incident-date-time">
						<label for="incident-date-time">Date & Time of Incident</label>
						<input id="incident-date-time" type="datetime-local" name="incident-date-time" 
							max="<?= date("Y-m-d\TH:i"); ?>" required />
					</div><!-- .grid-item.incident-date-time -->
					<div class="grid-item place">
						<label for="incident-place">Place of Incident</label>
						<textarea id="incident-place" name="incident-place" rows="2"></textarea>
					</div><!-- .grid-item.place -->
					<div class="grid-item subject">
						<label for="offense-subject">Offense Subject</label>
						<input id="offense-subject" type="text" name="offense-subject" list="subject-list" required />
						<datalist id="subject-list">
							<option value="Arson">
							<option value="Assault & Battery">
							<option value="Child abuse">
							<option value="Cyber Crime">
							<option value="Domestic Abuse">
							<option value="Fraud">
							<option value="Illegal Possession of Firearms">
							<option value="Kidnapping">
							<option value="Rape">
							<option value="Theft">
						</datalist><!-- #subject-list -->
					</div><!-- .grid-item.subject -->
					<div class="grid-item incident-narrative solo">
						<label for="incident-narrative">Narrative</label>
						<textarea id="incident-narrative" name="incident-narrative" rows="10" required class="solo"></textarea>
					</div><!-- .grid-item.incident-narrative -->
				</div><!-- .outer.grid-wrapper -->
			</section><!-- #report -->

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
	<script src="js/add-blotter.js"></script>
</body>
</html>