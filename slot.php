<!DOCTYPE HTML>
<html>
	<head>
		<title>GrandLucky - Details</title>
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
					  <h2>TIME SLOT DETAILS</h2>
					  <p>&nbsp;</p>
					</header>
						<section class="wrapper style5">
							<div class="inner">
								<?php
									require 'database.php';
									
									if (isset($_POST['number'])) {
										$number = $_POST['number'];
										$query = "SELECT * FROM slots INNER JOIN locations on slots.location=locations.location_id where number=\"$number\"";
										
										$result = $conn->query($query);
										if (!$result) die ("Database access failed: " . $conn->error);

										$rows = $result->num_rows;
										if($rows >= 0) {
											for ($i = 0 ; $i < $rows ; ++$i) {
												$result->data_seek($i);
												$row = $result->fetch_array(MYSQLI_ASSOC);

												$date = $row['date'];
												$time = $row['time'];
												$name = $row['name'];
												$phone = $row['phone'];
												$code = $row['code'];
												$email = $row['email'];
												$location = $row['location_name'];

												echo <<<_END
												<div class="col-12">
													<h3 align="center">Your unique code:</h3>
													<h2 align="center">$number</h2>
													<h3 align="center">Details of person: </h3>
														<div class="table-wrapper">
														<table>
																<tr>
																	<td>Name:</td>
																	<td>$name</td>
																</tr>
																<tr>
																	<td>Phone:</td>
																	<td>$phone</td>
																</tr>
																<tr>
																	<td>Email:</td>
																	<td>$email</td>
																</tr>
														</table>
														</div>
													<h3 align="center">Details of Booking: </h3>
														<div class="table-wrapper">
														<table>
																<tr>
																	<td>Date:</td>
																	<td>$date</td>
																</tr>
																<tr>
																	<td>Time:</td>
																	<td>$time</td>
																</tr>
																<tr>
																	<td>Location:</td>
																	<td>$location</td>
																</tr>
														</table>
														</div>
													<h4 align="center">Please finish your shopping by one hour in order to reduce the number of people in the store. Thank your for your co-operation</h4>
												</div>
_END;
											}
										} else {
											echo <<<_END
											<div class="col-12">
												<h3>Error: Code entered is invalid!</h3>		
											</div>
											<div class="col-12">
												<a href="./index.html" class="button">Go back</a>
											</div>
_END;
										};
										
									} else {
										echo <<<_END
										<div class="col-12">
											<h3>Error: You have incorrectly accessed this page. Click the button below to go back to the main page.</h3>		
										</div>
										<div class="col-12">
											<a href="./index.html" class="button">Go back</a>
										</div>
_END;
									};
								$result->close();
								$conn->close(); 
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