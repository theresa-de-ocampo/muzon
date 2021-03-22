<?php
	require_once "src/verification.php";
	if (isset($_GET["id"]))
		$_SESSION["blotter-id"] = $_GET["id"];
	else {
		echo "<script>alert('Sorry, something went wrong!');</script>";
		echo "<script>window.location.href = 'blotter.php'</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="description" content="Management System of Barangay Muzon in Naic, Cavite." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/all.css" />
	<link rel="stylesheet" type="text/css" href="../commons/css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/back-nav.css" />
	<link rel="stylesheet" type="text/css" href="css/case-details.css" />
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

	<main id="blotter-details">
		<a href="blotter.php"><i class="fas fa-arrow-circle-left"></i>Back to Blotter List</a>
		<hr />
		<section>
			<h2>Blotter Report</h2>
			<table id="blotter-details-tbl">
				<?php require_once "src/view-blotter-details.php"; ?>
			</table>
		</section>
	</main>
</body>
</html>