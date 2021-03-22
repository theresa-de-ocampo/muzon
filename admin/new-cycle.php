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
	<link rel="stylesheet" type="text/css" href="css/new-cycle.css" />
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
			<li><a href="index.php" class="active">Home</a></li>
			<li><a href="residents.php">Residents</a></li>
			<li><a href="blotter.php">Blotter</a></li>
			<li><a href="posts.php">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>

	<main id="new-cycle">
		<a href="index.php"><i class="fas fa-arrow-circle-left"></i>Back to Main Home Page</a>
		<hr />
		<form id="new-cycle-form" action="src/insert-new-cycle.php" method="post">
			<section id="captain">
				<h2>Captain</h2>
				<p>
					<input id="captain-id" type="number" name="captain-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="captain-tbl" class="display cell-border" width="100%">
					<?php 
						$path = "src/select-resident-legal-age.php";
						require "inc-select-resident.php";
					?>
				</table><!-- #captain-tbl -->
			</section><!-- #captain -->

			<section id="secretary">
				<h2>Secretary</h2>
				<p>
					<input id="secretary-id" type="number" name="secretary-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="secretary-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #secretary-tbl -->
			</section><!-- #secretary -->

			<section id="treasurer">
				<h2>Treasurer</h2>
				<p>
					<input id="treasurer-id" type="number" name="treasurer-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="treasurer-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #treasurer-tbl -->
			</section><!-- #treasurer -->

			<section id="councilor-1">
				<h2 class="councilor">Chairman of Committee on Agriculture</h2>
				<p>
					<input id="councilor-1-id" type="number" name="councilor-1-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-1-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-1-tbl -->
			</section><!-- #councilor-1 -->

			<section id="councilor-2">
				<h2 class="councilor">Chairman of Committee on Sports and Education</h2>
				<p>
					<input id="councilor-2-id" type="number" name="councilor-2-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-2-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-2-tbl -->
			</section><!-- #councilor-2 -->

			<section id="councilor-3">
				<h2 class="councilor">Chairman of Committee on Health</h2>
				<p>
					<input id="councilor-3-id" type="number" name="councilor-3-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-3-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-3-tbl -->
			</section><!-- #councilor-3 -->

			<section id="councilor-4">
				<h2 class="councilor">Chairman of Comittee on Peace and Order</h2>
				<p>
					<input id="councilor-4-id" type="number" name="councilor-4-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-4-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-4-tbl -->
			</section><!-- #councilor-4 -->

			<section id="councilor-5">
				<h2 class="councilor">Chairman of Comittee on Environmental Protection</h2>
				<p>
					<input id="councilor-5-id" type="number" name="councilor-5-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-5-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-5-tbl -->
			</section><!-- #councilor-5 -->

			<section id="councilor-6">
				<h2 class="councilor">Chairman of Comittee on Budget and Appropriations'</h2>
				<p>
					<input id="councilor-6-id" type="number" name="councilor-6-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-6-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-6-tbl -->
			</section><!-- #councilor-6 -->

			<section id="councilor-7">
				<h2 class="councilor">Chairman of Comittee on Public Works</h2>
				<p>
					<input id="councilor-7-id" type="number" name="councilor-7-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="councilor-7-tbl" class="display cell-border" width="100%">
					<?php require "inc-select-resident.php"; ?>
				</table><!-- #councilor-7-tbl -->
			</section><!-- #councilor-7 -->

			<section id="youth-council-chairman">
				<h2>Youth Council Chairman</h2>
				<p>
					<input id="youth-council-chairman-id" type="number" name="youth-council-chairman-id" class="readonly" required />
					<span class="name-holder"><i>(Click on a row.)</i></span>
				</p>
				<table id="youth-council-chairman-tbl" class="display cell-border" width="100%">
					<?php
						$path = "src/select-resident-youth.php";
						require "inc-select-resident.php";
					?>
				</table><!-- #councilor-7-tbl -->
			</section><!-- #councilor-7 -->

			<hr />
			<footer>
				<button type="reset" name="cancel">Cancel</button>
				<button type="submit" name="submit">Publish</button>
			</footer>
		</form>
	</main>

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/back-nav.js"></script>
	<script src="js/new-cycle.js"></script>
</body>
</html>