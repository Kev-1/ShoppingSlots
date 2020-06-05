<!DOCTYPE HTML>
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
											$result->data_seek($i);
											$locationRow = $locationResult->fetch_array(MYSQLI_ASSOC);

											echo '<option value='.$row['location_id'].'>'.$row['location_name'].'</option>';
										}
										

											$today = strtotime("today");
											$today2 = date("Y-m-d", $today);
											$todayText = date("d-m-y", $today);
											$tomorrow = strtotime("tomorrow");
											$tomorrow2 = date("Y-m-d", $tomorrow);
											$tomorrowText = date("d-m-y", $tomorrow);
											$twodays = strtotime("+2 Days");
											$twodays2 = date("d-m-y", $twodays);
											$twodaysText = date("d-m-y", $twodays);
											
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
_END;
									};
									
									if(isset($_POST['location']) && isset($_POST['date'])) { //checks location.
										
										$location = $_POST['location'];
										$date = $_POST['date'];
										$dateText = date("d-m-y", $date);
										
//										if($location == 1) {
//											$location_name = "GrandLucky SCBD";
//										} else if($location == 2) {
//											$location_name = "GrandLucky Radio Dalam";
//										} else if($location == 3) {
//											$location_name = "GrandLucky Cinere";
//										} else if($location == 4) {
//											$location_name = "GrandLucky Paragon";
//										} else if($location == 5) {
//											$location_name = "GrandLucky Bali";
//										};
										
										$locationQuery  = "SELECT * FROM locations where location_id=$location";
										$locationResult = $conn->query($locationQuery);
										if (!$locationResult) die ("Database access failed: " . $conn->error);
										$locationRows = $locationResult->num_rows;
										
										
										for ($i = 0 ; $i < $locationRows ; ++$i) {
											$result->data_seek($i);
											$locationRow = $locationResult->fetch_array(MYSQLI_ASSOC);
											echo '<h3>Selected location: '.$locationRow['location_name'].'</h3>';
										}
										
										echo '<h3>Selected Date: '.$dateText.'</h3>';
								
										$timeQuery  = "SELECT * FROM //incomplete!";
										$timeResult = $conn->query($timeQuery);
										if (!$timeResult) die ("Database access failed: " . $conn->error);
										$timeRows = $timeResult->num_rows;

										for ($j = 0 ; $j < $timeRows ; ++$j) {
											$timeResult->data_seek($i);
											$timeRow = $timeResult->fetch_array(MYSQLI_ASSOC);
											echo '<option value='.$row['location_id'].'>'.$row['location_name'].'</option>';
										}


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