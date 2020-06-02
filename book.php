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
									<li><a href="book.php">Book a time slot</a></li>
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
								
									if (isset($_POST['location']) == false) {
										echo <<<_END
										<form action="book.php" method="post">
										<div class="row gtr-uniform">
											<div class="col-12">
												<h3>Select a store:</h3>
												<select name="location" id="location">
													<option value="">Select a store</option>
													<option value="1">Grand Lucky SCBD</option>
													<option value="2">Grand Lucky Cinere</option>
													<option value="3">Grand Lucky Radio Dalam</option>
													<option value="4">Human Resources</option>
												</select>
											</div>
											<div class="col-12">
												<input type="submit"></input>
											</div>
										</div>
_END;
									}
									
									if(isset($_POST['location'])) {
										
										$location = $_POST['location'];
										if($location == 1) {
											$location_name = "GrandLucky SCBD";
										} else if($location == 2) {
											$location_name = "GrandLucky Radio Dalam";
										} else if($location == 3) {
											$location_name = "GrandLucky Cinere";
										} else if($location == 4) {
											$location_name = "GrandLucky Paragon";
										} else if($location == 5) {
											$location_name = "GrandLucky Bali";
										}
									echo <<<_END
									<h3>Store Selected: "$location_name"</h3>
									<form action="confirmation.php" method="post">
									<div class="row gtr-uniform">
										<div class="col-6 col-12-xsmall">
											<input type="text" name="name" id="name" value="" placeholder="Name*" required/>
										</div>
										<div class="col-6 col-12-xsmall">
											<input type="email" name="phone" id="phone" value="" placeholder="Phone Number*" required/>
										</div>
										<div class="col-12">
											<input type="email" name="email" id="email" value="" placeholder="Email (Optional)" required/>
										</div>
_END;		
										
								$query  = "SELECT * FROM slots where location=\"$location\"";
								$result = $conn->query($query);
							  	if (!$result) die ("Database access failed: " . $conn->error);
								$rows = $result->num_rows;
							
								echo "<h3>Slots available:</h3>";
								
								for ($i = 0 ; $i < $rows ; ++$i) {
									$result->data_seek($i);
    								$row = $result->fetch_array(MYSQLI_ASSOC);
									
									if($row['count'] == 150) {
										//dont show
									} else {
										echo <<<_END
										<div class="col-4 col-12-small">
											<input type="radio" id="time" name="time" checked>
											<label for="demo-priority-low">Low</label>
										</div>
_END;
									}
								};
								
								
								echo <<<_END
											<div class="col-12">
												<ul class="actions">
												<li><input type="submit" value="Book your slot" class="primary" /></li>
												</ul>
											</div>
										</div>
									  </form>
_END;
									}
								?>
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