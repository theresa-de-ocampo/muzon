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
	<link rel="stylesheet" type="text/css" href="../commons/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/nav-bar.css" />
	<link rel="stylesheet" type="text/css" href="css/forms.css" />
	<link rel="stylesheet" type="text/css" href="css/back-nav.css" />
	<link rel="stylesheet" type="text/css" href="css/add-edit-post.css" />
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
			<li><a href="posts.php" class="active">Posts</a></li>
			<li><a href="archive.php">Archive</a></li>
			<li><a href="account.php"><i class="fas fa-user-circle"></i></a></li>
		</ul>
	</nav>
	
	<main id="add-post">
		<a href="posts.php"><i class="fas fa-arrow-circle-left"></i>Back to List of Posts</a>
		<hr />
		<?php require_once "src/add-edit-post-prep.php"; ?>
		<form action="<?= $redirect; ?>" method="post" enctype="multipart/form-data">
			<section class="outer grid-wrapper">
				<div class="grid-item solo">
					<label for="title">Title</label>
					<input id="title" type="text" name="title" value="<?= $title ?>" class="solo" required />
				</div><!-- .grid-item -->
				<div class="grid-item solo">
					<label for="featured-photo">Featured Photo</label>
					<div id="photo-wrapper">
						<p><?php echo $photo_prompt; ?></p>
						<div class="overlay"></div>
						<img id="actual-photo" src="<?= $src ?>" alt="Your uploaded photo." />
					</div>
					<input id="<?= $featured_photo ?>" type="file" name="image" required class="solo" />
					<p id="orig-image"><?php echo $image; ?>
				</div><!-- .grid-item -->
				<div class="grid-item solo">
					<label for="content">Content</label>
					<textarea id="content" name="content" rows="12" required class="solo"><?php echo $content; ?></textarea>
				</div><!-- .grid-item -->
			</section>

			<hr />
			<footer>
				<button type="reset" name="cancel">Cancel</button>
				<button type="submit" name="submit"><?php echo $button_label; ?></button>
			</footer>
		</form>
	</main>

	<script src="js/jquery-3.5.1-min.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/add-edit-post.js"></script>
</body>
</html>