<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SILDMS | Student Intelligence Leverage and Data Management System</title>
	<link rel="icon" href="{{ asset('fassets/images/favicon.png') }}">

	<!-- font -->
	<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<!-- end font -->

    <!-- new font -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;500;700&family=Merriweather:wght@300;500;700&family=PT+Sans&display=swap" rel="stylesheet">

    <!-- end new font -->

	<link rel="stylesheet" href="{{ asset('fassets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('fassets/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('fassets/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('fassets/css/style.css') }}">
</head>
<body>

	<!-- loader -->
	<div class="fakeLoader"></div>
	<!-- end loader -->

	<!-- navbar -->
	<nav class="navbar navbar-expand-md navbar-light fixed-top">
		<div class="container">
			<a href="index.blade.php" class="navbar-brand"><img src="{{ asset('fassets/images/logo.png') }}" alt=""></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="icon ion-ios-menu"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#process-work">Features</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contact">Contact us</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- end navbar -->

	<!-- home intro -->
	<div id="home" class="home-intro">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="content">
						<h2><span class="color-highlight">Student Intelligence</span> <span class="color-highlight1">Leverage and</span></h2>
						<h2><span class="color-highlight1">Data Management </span><span class="color-highlight">System</span></h2>
						<ul>
							<li><a href="{{ url('login') }}" class="button">Login</a></li>
							<li><a href="" class="button button-secondary">Sign up</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="content-image">
						<img src="{{ asset('fassets/images/lecture.jpg') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end home intro -->

	<!-- features -->

    <div id="process-work" class="process-work section">
		<div class="container">
			<div class="section-title">
				<h3 class="title-top">Features</h3>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="content">
						<i class="icon ion-ios-chatboxes"></i>
						<h5>QR ID for Parent and Students</h5>
						<p>QR code printed on the ID card can be used as Login credentials by this application.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 align-self-end">
					<div class="content">
						<i class="icon ion-ios-cash"></i>
						<h5>E-Results</h5>
						<p>Results can be declared department-wise and can be viewed & downloaded for easier access.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="content">
						<i class="icon ion-ios-search"></i>
						<h5>Result Analysis and Career Predictions</h5>
						<p>Results or marks obtained by the student, the result will be analysed and favourable career will be predicted.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 align-self-end">
					<div class="content">
						<i class="icon ion-ios-checkmark-circle"></i>
						<h5>Feedback</h5>
						<p>Feedback and suggestions given by the students will be analyzed and reports can be generated for the teachers performance.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end features -->

	<!-- contact -->
	<div id="contact" class="contact section-bottom-only">
		<div class="container">
			<div class="section-title">
				<h3 class="title-top">Connect With Us</h3>
				<h6>We would love to repond to your queries </h6>
                <h6>Feel free to get in touch with us</h6>
			</div>
			<div class="box-content">
				<div class="row" >
					<div class="col-md-4 col-sm-12" id= col>
                        <div id= "reach-us">
                            <center><h4>Reach us</h4></center>
                        </div>
						<div class="content">
							<center>
								<h5>Address</h5>
								<p>Plot No. 2 & 3, Sector - 16, Near Thana Naka, Khandagao, New Panvel, Navi Mumbai, Maharashtra 410206</p>
								<h5>Phone</h5>
								<p>022 2748 1247</p>
								<h5>Email</h5>
								<p>aiktc.newpanvel@aiktc.ac.in</p>
							</center>

						</div>
					</div>
					<div class="col-md-8 col-sm-12">
						<div class="content-right">
							<form action="contact-form.php" class="contact-form" id="contact-form" method="post">
                                <div id= "send-us">
                                    <h4>Send us a message</h4>
                                </div>
								<div class="row">
									<div class="col">
										<div id="first-name-field">
											<input type="text" placeholder="Name" name="form-name">
										</div>
									</div>
									<div class="col">
										<div id="email-field">
											<input type="email" placeholder="Email Address" name="form-email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div id="subject-field">
											<input type="text" placeholder="Subject" name="form-subject">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div id="message-field">
											<textarea cols="30" rows="5" id="form-message" name="form-message" placeholder="Message"></textarea>
										</div>
									</div>
								</div>
								<button class="button" type="submit" id="submit" name="submit">Send Message</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact -->

	<!-- footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="content">
						<div class="brand"><img src="{{ asset('fassets/images/white-logo.png') }}" alt=""></div>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero, accusamus.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="content">
						<h5>About</h5>
						<ul>
							<li><a href=""><i class="icon ion-ios-contact"></i> About us</a></li>
							<li><a href=""><i class="icon ion-ios-chatboxes"></i> Contact</a></li>
							<li><a href=""><i class="icon ion-ios-list"></i> Portfolio</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="content">
						<h5>Support</h5>
						<ul>
							<li><a href=""><i class="icon ion-ios-headset"></i> support@example.com</a></li>
							<li><a href=""><i class="icon ion-ios-call"></i> +61 3 8376 6284
							</a></li>
							<li><a href=""><i class="icon ion-ios-settings"></i> Services</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div class="content">
						<h5>Follow us</h5>
						<ul class="social">
							<li><a href=""><i class="icon ion-logo-facebook"></i> Facebook</a></li>
							<li><a href=""><i class="icon ion-logo-twitter"></i> Twitter</a></li>
							<li><a href=""><i class="icon ion-logo-instagram"></i> Instagram</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer -->

	<!-- footer bottom -->
	<div class="footer-bottom">
		<span>Copyright © All Right Reserved</span>
	</div>
	<!-- end footer bottom -->

	<!-- script -->
	<script src="{{ asset('fassets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('fassets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('fassets/js/jquery.filterizr.min.js') }}"></script>
	<script src="{{ asset('fassets/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('fassets/js/magnific-popup.min.js') }}"></script>
	<script src="{{ asset('fassets/js/contact-form.js') }}"></script>
	<script src="{{ asset('fassets/js/main.js') }}"></script>

</body>
</html>
