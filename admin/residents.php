<?php require_once "src/verification.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
			<li><a href="residents.php" class="active">Residents</a></li>
			<li><a href="blotter.php">Blotter</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>

	<main>
		<section id="resident">
			<h2>Residents</h2>
			<table id="resident-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Last Name</th>
						<th>Sex</th>
						<th>Birthday</th>
						<th>Age</th>
						<th>Highest Educ. Attainment</th>
						<th>Occupation</th>
						<th>Citzenship</th>
						<th>Religion</th>
						<th>Contact No.</th>
						<th>Civil Status</th>
						<th>House No.</th>
						<th>Street</th>
						<th>Edit</th>
						<th>Archive</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-residents.php"; ?>
				</tbody>
			</table><!-- #resident-tbl -->
		</section><!-- #resident -->

		<section id="household">
			<h2>Households</h2>
			<table id="household-tbl" class="display cell-border" width="100%">
				<thead>
					<tr>
						<th>House Number</th>
						<th>Street</th>
						<th>Copy to Clipboard</th>
					</tr>
				</thead>
				<tbody>
					<?php require_once "src/view-households.php"; ?>
				</tbody>
			</table><!-- #household-tbl -->
		</section><!-- #household -->
	</main>

	<!-- 
		This modal is used in two cases: (1) Adding a Resident, and (2) Updating a Resident Record. 
		Hence, the value of the action attribute is dynamically set through JS.
	-->
	<div id="resident-modal" class="modal">
		<form action="" method="post" autocomplete="new-password">
			<div class="grid-wrapper">
				<div class="grid-item">
					<label for="fname">First Name</label>
					<input id="fname" type="text" name="fname" required />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="mname">Middle Name</label>
					<input id="mname" type="text" name="mname" required />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="lname">Last Name</label>
					<input id="lname" type="text" name="lname" required />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="sex">Sex</label>
					<select id="sex" name="sex" required>
						<option value=""></option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="bday">Birthday</label>
					<input id="bday" type="date" name="bday" max="<?php echo date("Y-m-d"); ?>" required class="medium" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="age">Age</label>
					<input id="age" type="number" name="age" required class="short" disabled />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="educ">Highest Educ. Attainment</label>
					<select id="educ" name="educ" required>
						<option value=""></option>
						<option value="Some Elementary">Some Elementary</option>
						<option value="Elementary Graduate">Elementary Graduate</option>
						<option value="Some High School">Some High School</option>
						<option value="High School Graduate">High School Graduate</option>
						<option value="Some College">Some College</option>
						<option value="College Graduate">College Graduate</option>
						<option value="Vocational">Vocational</option>
						<option value="Advanced Degree">Advanced Degree</option>
						<option value="N/A">N/A</option>
					</select>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="occupation">Occupation</label>
					<input id="occupation" type="text" name="occupation" required list="occupation-list" />
					<datalist id="occupation-list">
						<option value="N/A">
						<option value="Retired">
					</datalist>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="citizenship">Citizenship</label>
					<input id="citizenship" type="text" name="citizenship" required class="medium" list="citizenship-list" />
					<datalist id="citizenship-list">
						<option value="Filipino">
					</datalist>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="religion">Religion</label>
					<select id="religion" name="religion" required>
						<option value=""></option>
						<option value="Non-religious">Agnosticism/Atheism</option>
						<option value="Christian">Christian</option>
						<option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
						<option value="Islam">Islam</option>
						<option value="Jehovah">Jehovah</option>
						<option value="Roman Catholic">Roman Catholic</option>
						<option value="Sabbath">Sabbath</option>
						<option value="Others">Others</option>
					</select>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="contact-no">Contact No. <i>(09*********)</i></label>
					<input id="contact-no" type="text" name="contact-no" required class="some-medium" pattern="^09[0-9]{9}" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="civil-status">Civil Status</label>
					<select id="civil-status" name="civil-status" required>
						<option value=""></option>
						<option value="Annulled">Annulled</option>
						<option value="Married">Married</option>
						<option value="Separated">Separated</option>
						<option value="Single">Single</option>
						<option value="Widowed">Widowed</option>
					</select>
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="house-no">House No.</label>
					<input id="house-no" type="text" name="house-no" required class="short" />
				</div><!-- .grid-item -->
				<div class="grid-item">
					<label for="street">Street</label>
					<select id="street" name="street" required>
						<option value=""></option>
						<option value="A. Bonifacio">A. Bonifacio</option>
						<option value="Callejon II">Callejon II</option>
						<option value="D. Silang">D. Silang</option>
						<option value="Diosomito">Diosomito</option>
						<option value="E. Aguinaldo">E. Aguinaldo</option>
						<option value="E. Balagtas">E. Balagtas</option>
						<option value="E. Jacinto">E. Jacinto</option>
						<option value="Lapu-Lapu">Lapu-Lapu</option>
						<option value="Lopez">Lopez</option>
						<option value="M. Agoncillo">M. Agoncillo</option>
						<option value="M. Aquino">M. Aquino</option>
					</select>
				</div><!-- .grid-item -->
				<input id="resident-id" type="hidden" name="resident-id" />
			</div><!-- .grid-wrapper -->

			<footer>
				<button id="modal-cancel" type="reset" name="cancel">Cancel</button>
				<button id="modal-ok" type="submit" name="">
					<!-- Text and name attribute value are dynamically set through JS. -->
				</button>
			</footer>
		</form>
	</div><!-- #resident-modal -->

	<form id="archive-resident" action="src/archive-resident.php" method="post" class="hidden">
		<input id="resident-id-to-be-archived" type="hidden" name="resident-id" />
	</form><!-- #archive-resident -->

	<!-- Do not move these scripts into the header! -->
	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/export.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/residents.js"></script>
	<script src="js/modal.js"></script>
</body>
</html>