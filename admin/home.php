<?php 
	require_once "src/verification.php";
	require_once "src/tally.php";
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
	<link rel="stylesheet" type="text/css" href="css/modal.css" />
	<link rel="stylesheet" type="text/css" href="css/home.css" />
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
	
	<main>
		<section id="dashboard">
			<h2>Dashboard</h2>
			<div class="grid-wrapper">
				<div class="grid-item flex-wrapper">
					<div class="fas fa-users"></div>
					<div class="tally">
						<h4>Population</h4>
						<p><?php echo $population; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-male"></div>
					<div class="tally">
						<h4>Male</h4>
						<p><?php echo $male; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-female"></div>
					<div class="tally">
						<h4>Female</h4>
						<p><?php echo $female; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-home"></div>
					<div class="tally">
						<h4>Households</h4>
						<p><?php echo $household; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-hand-holding-heart"></div>
					<div class="tally">
						<h4>Senior Citizen</h4>
						<p><?php echo $senior; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-business-time"></div>
					<div class="tally">
						<h4>Unemployed</h4>
						<p><?php echo $unemployed; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-exclamation-circle"></div>
					<div class="tally">
						<h4>Pending Cases</h4>
						<p><?php echo $pending; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
				<div class="grid-item flex-wrapper">
					<div class="fas fa-check-circle"></div>
					<div class="tally">
						<h4>Settled Cases</h4>
						<p><?php echo $settled; ?></p>
					</div><!-- .tallly -->
				</div><!-- .grid-item.flex-wrapper -->
			</div><!-- .grid-wrapper -->
		</section><!-- #dashboard -->

		<section id="curr-officers">
			<h2>Officers</h2>
			<form action="terminate-officer.php" method="post" name="terminate-officer">
				<table id="curr-officers-tbl" class="display cell-border" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Position</th>
							<th>Name</th>
							<th>Terminate</th>
						</tr>
					</thead>
					<tbody>
						<?php require_once "src/view-curr-officers.php"; ?>
					</tbody>
				</table><!-- #current-officers-tbl -->
				<input id="officer-id" type="hidden" name="officer-id" />
				<input id="officer-name" type="hidden" name="officer-name" />
				<input id="officer-position" type="hidden" name="officer-position" />
			</form>
		</section><!-- #curr-officers -->
	</main>

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/datatables.min.js"></script>
	<script src="js/export.min.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/home.js"></script>
</body>
</html>