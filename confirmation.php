<!DOCTYPE HTML>
<html>
	<head>
		<title>Grandlucky - Confirmation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
			<div id="page-wrapper">
					<header id="header">
						<h1><a href="index.html">gRANDLUCKY</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.html">Home</a></li>
											<li><a href="book.html">Book a slot</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>
					<article id="main">
						<header>
						  <h2>Your booking slot</h2>
							<p>Your reservation</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<?php
								require 'database.php';

								if(isset($_POST['location']) && isset($_POST['time']) && isset($_POST['date']) && isset($_POST['name']) && isset($_POST['phone'])) {

									$location = $_POST['location'];
									$time = $_POST['time'];
									$date = $_POST['date'];
									$name = $_POST['name'];
									if (isset($_POST['email'])) {
										$email = $_POST['email'];
									} else {
										$email = "Not filled";
									}
									$phone = $_POST['phone'];

									$code = rand(100000000, 999999999); //random generated code.


									//while loop to check if checkExists will return one.
									while($b == true) {
										$findQuery = "select * from slots where code=\"$code\"";
										$findResult = $conn->query($findQuery);
										if (!$findResult) die ("Database access failed: " . $conn->error);
										if($findResult->num_rows > 0) {
											$code = rand(100000000, 999999999);
										} else {
											$b = false;
										}
									}

									//INSERT TO DATABASE
									$insertQuery = "INSERT INTO slots (name, phone, location, date, time, code) VALUES (\"$name\", \"$phone\", \"$location\", \"$date\", \"$time\", \"$code\")";
									$insertResult = $conn->query($insertQuery);
									if (!$insertResult) echo ("INSERT failed: " . $conn->error . "Report to administrator.");

									echo <<<_END
											<div class="table-wrapper">
												<h3 align="center">Your unique code:</h3>
												<h2 align="center">$code</h2>
												<h3 align="center">Details of person: </h3>
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
												<h3 align="center">Details of Booking: </h3>
													<table>
														<tbody>
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
														</tbody>
													</table>
												<h4 align="center">Please finish your shopping by one hour in order to reduce the number of people in the store. Thank your for your co-operation</h4>
											</div>
_END;
								}

								$insertResult->close();
								$conn->close();
								?>
							</div>
						</section>
					</article>
					<footer id="footer">
						<ul class="copyright">
						  <li>&copy; ITSKEV1 Productions</li>
						  <li>Design <a href="http://html5up.net">HTML5 UP</a></li>
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
