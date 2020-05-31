<html>
	<head>
		<title>GrandLucky > Book a time slot</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<div id="page-wrapper">
			<header id="header">
				<h1><a href="index.html">Grandlucky</a></h1>
					<nav id="nav">
						<ul>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Menu</span></a>
							<div id="menu">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li><a href="slot.php">Book a time slot</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</header>
				<article id="main">
					<header>
						  <h2>Book a time slot</h2>
						  <p>Fill the form to book your slot.</p>
					</header>
						<section class="wrapper style5">
							<div class="inner">
								<?php
									require database.php;
									echo <<<_END
									<form action="confirmation.php" method="post">
									<div class="row gtr-uniform">
										<div class="col-6 col-12-xsmall">
											<input type="text" name="name" id="name" value="" placeholder="Name" />
										</div>
										<div class="col-6 col-12-xsmall">
											<input type="email" name="phone" id="email" value="" placeholder="Phone Number" />
										</div>
										<div class="col-12">
											<select name="demo-category" id="demo-category">
												<option value="">Select a store</option>
												<option value="1">Grand Lucky SCBD</option>
												<option value="2">Grand Lucky Cinere</option>
												<option value="3">Grand Lucky Radio Dalam</option>
												<option value="4">Human Resources</option>
											</select>
										</div>
_END;		
								$query  = "SELECT * FROM (your table)";
								$result = $conn->query($query);
							  	if (!$result) die ("Database access failed: " . $conn->error);
								$rows = $result->num_rows;
							
								echo "<h3>Slots available:</h3>";
								
								for ($i = 0 ; $i < $rows ; ++$i) {
									$result->data_seek($i);
    								$row = $result->fetch_array(MYSQLI_ASSOC);
									
									if($_row['count'] == 150) {
										//dont show
									} else {
										echo <<<_END
										<div class="col-4 col-12-small">
											<input type="radio" id="demo-priority-low" name="demo priority" checked>
											<label for="demo-priority-low">Low</label>
										</div>
_END;
									}
								};
								
								
								echo <<<_END
											<div class="col-12">
												<ul class="actions">
												<li><input type="submit" value="Book your slot" class="primary" /></li>
												<li><input type="reset" value="Reset" /></li>
												</ul>
											</div>
										</div>
									  </form>
_END;
								?>
							</div>
						</section>
					</article>
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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