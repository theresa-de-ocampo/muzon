<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Jesus Lopez" />
	<meta name="description" 
		content="Barangay Muzon is a small neighborhood (313 hectares) in Naic, Cavite with a total population of 2,491 last 2017. Rice farming is the primary livelihood here because of the nature of its environment." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" type="image/x-icon" href="../commons/img/logo.png" />
	<title>Official Website of Barangay Muzon - Naic, Cavite</title>
</head>
<body>
	<!-- Header -->
	<section id="header">
		<div class="header container">
			<div class="nav-bar">
				<div class="logo-holder">
					<div id="logo-wrapper">
						<a href="#home">
						<img id="logo" src="../commons/img/logo.png" alt="logo" title="Muzon" />
						</a>
					</div>
				</div>
				
				<div class="nav-list">
					<div class="menu"><div class="bar"></div></div>
						<ul>
							<li><a href="#home" data-after="Home">HOME</a></li>
							<li><a href="#updates" data-after="News">UPDATES</a></li>
							<li><a href="#about" data-after="About">ABOUT US</a></li>
							<li><a href="#contact" data-after="Contact">CONTACT</a></li>
						</ul>
					</div>
			</div>
		</div>
	</section>
	<!-- End of Header -->

	<!-- Home Section  -->
	<section id="home">
		<div class="home container">
			<div>
				<h1>Barangay Muzon <span></span></h1>
				<h1>Naic, Cavite <span></span></h1>
				<a href="#updates" type="button" class="cta">see latest news</a>
			</div>
		</div>
	</section>
	<!-- End of Home  -->

	<!-- Updates Section -->
	<section id="updates">
		<div class="updates container">
			<div class="updates-header">
				<h1 class="section-title">latest news and events</h1>
			</div>

			<div class="all-updates">
				<?php require_once "src/view-posts.php"; ?>
			</div>
		</div>
	</section>
	<!-- End of Updates -->

	<!-- About Section -->
	<section id="about">
		<div class="about container">
			<div class="col-left">
				<div class="about-img">
					<img src="img/about.jpg" alt="img">
				</div>
			</div>
			
			<div class="col-right">
				<h1 class="section-title">ABOUT US</h1></br>
				<h2><b>Vision</b> <i>(Pananaw)</i></h2>
				<p>
					<i>Sambayanang nagkakaisa at may pagmamalasakit sa mamamayan; magkakabalikat sa pagtamo ng bawat adhikain tungo sa pagsulong at pag-unlad.</i>
				</p>
				<h2><b>Mission</b> <i>(Misyon)</i></h2>
				<p>
					<i>Imulat ang mga mamamayan sa isang sambayanang malinis, maayos, maunlad, at nagkakaisa sa pamamagitan ng pagsunod sa batas ng tao at batas ng Diyos.</i>
				</p>
				<h2><b>Purpose</b> <i>(Hangarin)</i></h2>
				<p>
					<i>Maisakatuparan ang lahat ng mga plano na isinagawa sa programang pangkaunlaran na ito sa loob ng anim na taon, upang matamasa ng mga mamamayan ang mas mataas na antas ng pampublikong serbisyo.</i>
				</p>
			</div>
		</div>
		
		<div class="officers">
			<h1 class="officer-title">Elected Officials</h1></br>
			<table>
				<tr>
					<th>Position</th>
					<th>Name</th>
				</tr>	
					<?php require_once "src/view-curr-officers.php";?>
			</table>
		</div>
	</section>
	<!-- End About Section -->

	<!-- Contact Section -->
	<section id="contact">
		<div class="contact container">
			<div><h1 class="section-title">Contact info</h1></div></br></br>
				<div class="contact-items">
					<div class="contact-item">
						<div class="icon">
							<a href="https://fb.com/brgy.muzon" target="_blank">
							<img src="img/facebook.png" alt="fb logo">
							</a>
						</div>
						<div class="contact-info">
							<h1><span>Facebook</span></h1>
							<h2>fb.com/brgy.muzon</h2>
						</div>
					</div>
					
					<div class="contact-item">
						<div class="icon">
							<img src="img/email.png" alt="email">
						</div>
						<div class="contact-info">
							<h1><span>Email</span></h1>
							<h2>brgy.muzon.naic.cavite</h2>
							<h2>@gmail.com</h2>
						</div>
					</div>
					
					<div class="contact-item">
						<div class="icon">
							<img src="img/location.png" alt="location">
						</div>
						<div class="contact-info">
							<h1><span>Address</span></h1>
							<h2>Governor's Drive, Muzon, Naic, Cavite</h2>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End of Contact -->

	<!-- Footer -->
	<section id="footer">
		<div class="footer-container">
			<p>COPYRIGHT © 2021. BARANGAY MUZON OF NAIC, CAVITE. ALL RIGHTS RESERVED</p>
		</div>
	</section>
	<!-- End of Footer -->
	
	<script src="app.js"></script>
</body>
</html>