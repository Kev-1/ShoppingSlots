<!DOCTYPE HTML>
<html>
	<head>
		<title>GrandLucky - Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<div id="page-wrapper">
			<header id="header">
				<h1><a href="admin.php">Grandlucky Admin</a></h1>
					<nav id="nav">
						<ul>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Menu</span></a>
							<div id="menu">
								<ul>
									<li><a href="admin.php">Home</a></li>
									<li><a href="search.php">Search</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</header>
				<article id="main">
					<section class="wrapper style5">
							<div class="inner">
								<form action="authenticate.php" method="post">
									<div class="row gtr-uniform">
										<div class="col-12">
											<h3 align="center">Admin login</h3>
										</div>
										<div class="col-12">
											<input type="text" name="username" id="username" placeholder="Username">
										</div>
										<div class="col-12">
											<input type="password" name="password" id="password" placeholder="Password">
										</div>
										<div class="col-12" align="center">
											<input type="submit" class="primary">
										</div>
										<?php
											if(isset($_GET['error'])) {
												if($_GET['error'] == 1) {
													echo <<<_END
													<div class="col-12" align="center">
														<h3 align="center">Error: Incorrect username or password!</h3>
													</div>
_END;
												} else if($_GET['error'] == 2) {
													echo <<<_END
													<div class="col-12" align="center">
														<h3 align="center">Error: No username or password has been entered!</h3>
													</div>
_END;
												}
											}
										?>
									</div>
						 		</form>
							</div>
					</section>
				</article>
					<footer id="footer">
						<ul class="copyright">
							  <li>&copy; itskev1 productions</li>
							  <li>Design by&nbsp;<a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>