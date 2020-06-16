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
									
									function validationCheck() {
										global $err;
										global $conn;
										if(empty($_POST['name'])) {
											$err = $err . "Name cannot be empty! ";
											return false;
										}
										
										if(empty($_POST['phone'])) {
											$err = $err . "Phone cannot be empty! ";
											return false;
										}
										
										if(empty($_POST['time'])) {
											$err = $err . "Time must be selected! ";
											return false; //CLIENT SIDE VALIDATION EXISTS, BUT JUST TO BE SURE :)
										}
										
										if(is_numeric($_POST['phone']) == false) {
											$err = $err . "Time must be in numbers! ";
											return false;
										}
										
										if(strlen($_POST['phone']) < 7) {
											$err = $err . "Phone number is less than 7 digits! ";
											return false;
										}
										
										$timeQuery  = "SELECT COUNT(ID) FROM slots WHERE time=\"$time\" AND location=\"$location\" AND date=\"$date\"";
										$timeResult = $conn->query($timeQuery);
										if (!$timeResult) die ("Database access failed: " . $conn->error);
										$timeRows = $timeResult->num_rows;
										for ($j = 0 ; $j < $timeRows ; ++$j) {
											$timeResult->data_seek($j);
											$timeRow = $timeResult->fetch_array(MYSQLI_ASSOC);
											$remaining = 150 - $timeRow['COUNT(ID)'];
										}
										
										if($remaining == 0) {
											$err = $err . "Time selected is already full. ";
											return false;
										}
										
										if(isset($err) == false) {
											return true;
										}
										
									}
									
									if(validationCheck() == true) {
										$code = rand(100000000, 999999999); //random generated code.

										//while loop to check if checkExists will return one.
										$b = true;
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

										//retrieve location name again.
										$locationQuery  = "SELECT * FROM locations where location_id=$location";
										$locationResult = $conn->query($locationQuery);
										if (!$locationResult) die ("Database access failed: " . $conn->error);
										$locationRows = $locationResult->num_rows;
										for ($i = 0 ; $i < $locationRows ; ++$i) {
											$locationResult->data_seek($i);
											$locationRow = $locationResult->fetch_array(MYSQLI_ASSOC);
											$location_name = $locationRow['location_name'];
										}

										//INSERT TO DATABASE
										$insertQuery = "INSERT INTO slots (name, phone, location, date, time, code) VALUES (\"$name\", \"$phone\", \"$location\", \"$date\", \"$time\", \"$code\")";

										//check email inserted.
										$insertResult = $conn->query($insertQuery);
										if (!$insertResult) echo ("INSERT failed: " . $conn->error . "Report to administrator.");

										echo <<<_END
												<div class="table-wrapper">
													<h3 align="center">Your unique code:</h3>
													<h2 align="center">$code</h2>
													<h3 align="center">Details of person: </h3>
														<table>
															<tbody>
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
															</tbody>
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
																	<td>$location_name</td>
																</tr>
															</tbody>
														</table>
													<h4 align="center">Please finish your shopping by one hour in order to reduce the number of people in the store. Thank your for your co-operation</h4>
												</div>
_END;
									} else {
										echo <<<_END
									<div class="col-12">
										<h3>Error: $err</h3>
									</div>
									<div class="col-12">
										<a href="javascript:history.go(-1)" title="Go Back" class="button">&laquo; Go back</a>
									</div>
_END;
									}
								} else {
									echo <<<_END
									<div class="col-12">
										<h3>Error: No valid input was recieved. Click the button below to go back to the main page.</h3>		
									</div>
									<div class="col-12">
										<a href="javascript:history.go(-1)" title="Go Back" class="button">&laquo; Go back</a>
									</div>
_END;
								}
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
