<!DOCTYPE HTML>
<html>
	<head>
		<title>GrandLucky - Book a time slot</title>
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
									require 'database.php';

									if (isset($_POST['location']) == false) {
										$locationQuery  = "SELECT * FROM locations";
										$locationResult = $conn->query($locationQuery);
										if (!$locationResult) die ("Database access failed: " . $conn->error);
										$locationRows = $locationResult->num_rows;

										echo <<<_END
										<form action="book.php" method="post">
										<div class="row gtr-uniform">
											<div class="col-12">
												<h3>Select a store:</h3>
												<select name="location" id="location" required>
													<option value="">Select a Location</option>
_END;

										for ($i = 0 ; $i < $locationRows ; ++$i) {
											$locationResult->data_seek($i);
											$locationRow = $locationResult->fetch_array(MYSQLI_ASSOC);
											echo "<option value=".$locationRow['location_id'].">".$locationRow['location_name']."</option>";
										}

										echo <<<_END
												</select>
											</div>
_END;


											$today = strtotime("today");
											$today2 = date("Y-M-d", $today);
											$todayText = date("d-M-Y", $today);
											$tomorrow = strtotime("tomorrow");
											$tomorrow2 = date("Y-M-d", $tomorrow);
											$tomorrowText = date("d-M-Y", $tomorrow);
											$twodays = strtotime("+2 Days");
											$twodays2 = date("d-M-Y", $twodays);
											$twodaysText = date("d-M-Y", $twodays);

											echo <<<_END
											<div class="col-12">
												<h3>Select a date:</h3>
												<select name="date" id="date" required>
													<option value="">Select a Date</option>
													<option value="$today2">$todayText</option>
													<option value="$tomorrow2">$tomorrowText</option>
													<option value="$twodays2">$twodaysText</option>
												</select>
											</div>
											<div class="col-12">
												<input type="submit"></input>
											</div>
										</div>
										</form>
_END;
										$locationResult->close();
									};

									if(isset($_POST['location']) && isset($_POST['date'])) { //checks location.

										//set variables
										$location = $_POST['location'];
										$date = strtotime($_POST['date']);
										$date2 = date("Y-m-d", $date);
										$dateText = date("d-M-Y", $date);

										//get loc name.
										$locationQuery  = "SELECT * FROM locations where location_id=$location";
										$locationResult = $conn->query($locationQuery);
										if (!$locationResult) die ("Database access failed: " . $conn->error);
										$locationRows = $locationResult->num_rows;
										for ($i = 0 ; $i < $locationRows ; ++$i) {
											$locationResult->data_seek($i);
											$locationRow = $locationResult->fetch_array(MYSQLI_ASSOC);
											echo '<h3>Selected location: '.$locationRow['location_name'].'</h3>';
										}

										//display date
										echo '<h3>Selected Date: '.$dateText.'</h3>';

										echo <<<_END
											<form action="confirmation.php" method="post">
											<div class="row gtr-uniform">
												<input type="hidden" id="location" name="location" value="$location">
												<input type="hidden" id="date" name="date" value="$date2">
												<div class="col-6 col-12-xsmall">
													<input type="text" name="name" id="name" value="" placeholder="Name*" required/>
												</div>
												<div class="col-6 col-12-xsmall">
													<input type="text" name="phone" id="phone" value="" placeholder="Phone Number*" required/>
												</div>
												<div class="col-12">
													<input type="email" name="email" id="email" value="" placeholder="Email (Optional)"/>
												</div>
												<div class ="col-12">
													<h3>Select a time</h3>
													<select name="time" id="time" required>
														<option value="">Select a time</option>

_END;
										$time2 = strtotime("Today 09:00am");
										$time = date("G:i:s", $time2);

										for($k = 0; $k < 12; ++$k) {
											$timeQuery  = "SELECT COUNT(ID) FROM slots WHERE time=\"$time\" AND location=\"$location\" AND date=\"$date2\"";
											$timeResult = $conn->query($timeQuery);
											if (!$timeResult) die ("Database access failed: " . $conn->error);
											$timeRows = $timeResult->num_rows;
											for ($j = 0 ; $j < $timeRows ; ++$j) {
												$timeResult->data_seek($j);
												$timeRow = $timeResult->fetch_array(MYSQLI_ASSOC);
												$remaining = 150 - $timeRow['COUNT(ID)'];
											}
											echo "<option value=".$time.">$time ($remaining Remaining)</option>";
											$time2 = strtotime("$time +1 hour");
											$time = date("G:i:s", $time2);
										}
										
										$timeResult->close();

										echo <<<_END
														</select>
													</div>
													<div class="col-12">
														<ul class="actions">
														<li><input type="submit" value="Book your slot" class="primary" /></li>
														</ul>
													</div>
												</div>
											  </form>
_END;
									};
								//close connection
								
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
