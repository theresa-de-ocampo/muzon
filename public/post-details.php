<?php
	if (isset($_GET["id"]))
		$_SESSION["post-id"] = $_GET["id"];
	else {
		echo "<script>alert('Sorry, something went wrong!');</script>";
		echo "<script>window.location.href = 'index.php'</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Theresa De Ocampo" />
	<meta name="description" 
		content="Barangay Muzon is a small neighborhood (313 hectares) in Naic, Cavite with a total population of 2,491 last 2017. Rice farming is the primary livelihood here because of the nature of its environment." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" href="css/post-details.css">
	<link rel="shortcut icon" type="image/x-icon" href="../commons/img/logo.png" />
	<title>Official Website of Barangay Muzon - Naic, Cavite</title>
</head>
<body>
	<section id="post-details">
		<a href="index.php#updates"><i class="fas fa-minus-square"></i>Collapse Article</a>
		<hr />
		<?php require_once "../commons/src/view-post-details.php"; ?>
	</section><!-- .post-details -->
</body>
</html>