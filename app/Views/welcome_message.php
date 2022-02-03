<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Restaurantly Bootstrap Template - Index</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?= base_url() ?>/public/vendor/aos/aos.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="<?= base_url() ?>/public/css/style.css" rel="stylesheet">

	<!-- =======================================================
  * Template Name: Restaurantly - v1.2.1
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

	<!-- ======= Top Bar ======= -->
	<div id="topbar" class="d-flex align-items-center fixed-top">
		<div class="container d-flex">
			<div class="contact-info mr-auto">
				<i class="icofont-phone"></i> 322 924 3184
				<span class="d-none d-lg-inline-block"><i class="icofont-clock-time icofont-rotate-180"></i> <?= date("F j, Y, g:i a") ?></span>
			</div>
			<div class="languages">
				<ul>
					<li>Pamplona</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top headerhome">
		<div class="container d-flex align-items-center">

			<h1 class="logo mr-auto">

				<a href="index.html">PeRa<img src="<?= base_url() ?>/public/img/peraburgelogo.png" alt="">Burger</a>
			</h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav class="nav-menu d-none d-lg-block">
				<ul>
					<li class="active"><a href="index.html">Home</a></li>
					
					<li class="book-a-table text-center"><a href="<?= base_url().route_to('page2') ?>">Solicita tu orden</a></li>
				</ul>
			</nav><!-- .nav-menu -->
		</div>
	</header><!-- End Header -->

	<!-- ======= Hero Section ======= -->
	<section id="hero" class="d-flex align-items-center">
		<div class="container position-relative text-center text-lg-left" data-aos="zoom-in" data-aos-delay="100">
			<div class="row">
				<div class="col-lg-8">
					<h1>Bienvenido a <span><img class="img-fluid img-welcome" src="<?= base_url() ?>/public/img/peraburgelogo1.png" alt=""></span></h1>
					<h2>Con el primer bocado ya te sentirás en el cielo, será una experiencia del otro mundo.</h2>

					<div class="btns">
						<a href="#menu" class="btn-menu animated fadeInUp scrollto">Solicita tu Orden</a>

					</div>
				</div>
				<div class="col-lg-4 d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-delay="200">
					<a href="https://www.youtube.com/watch?v=GlrxcuEDyF8" class="venobox play-btn" data-vbtype="video" data-autoplay="true"></a>
				</div>

			</div>
		</div>
	</section><!-- End Hero -->



	<div id="preloader"></div>
	<a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

	<!-- Vendor JS Files -->
	<script src="<?= base_url() ?>/public/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/php-email-form/validate.js"></script>
	<script src="<?= base_url() ?>/public/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/venobox/venobox.min.js"></script>
	<script src="<?= base_url() ?>/public/vendor/aos/aos.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url() ?>/public/js/main.js"></script>

</body>

</html>