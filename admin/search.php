<!DOCTYPE HTML>
<html>
	<head>
		<title>GrandLucky - Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<div id="page-wrapper">
			<header id="header">
				<h1><a href="index.html">Grandlucky ADMIN</a></h1>
					<nav id="nav">
						<ul>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Admin Menu</span></a>
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
						<section class="wrapper style5">
							<div class="inner">
								<?php
									session_start();
									session_regenerate_id();
									if(!isset($_SESSION['user'])) {
										header("Location: login.php");
									} else {


									if (isset($_POST['location']) == false) {
										$locationQuery  = "SELECT * FROM locations";
										$locationResult = $conn->query($locationQuery);
										if (!$locationResult) die ("Database access failed: " . $conn->error);
										$locationRows = $locationResult->num_rows;

										echo <<<_END
										<form action="search.php" method="post">
										<div class="row gtr-uniform">
											<div class="col-12">
												<h2>Search the database</h2>
												<select name="location" id="location" required>
													<option value="">Select a Location</option>
_END;

										for ($i = 0 ; $i < $locationRows ; ++$i) {
											$locationResult->data_seek($i);
											$locationRow = $locationResult->fetch_array(MYSQLI_ASSOC);
											echo "<option value=".$locationRow['location_id'].">".$locationRow['location_name']."</option>";
										};

										echo <<<_END
												</select>
											</div>
_END;


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
												<select name="date" id="date" required>
													<option value="">Select a Date</option>
													<option value="$today2">$todayText</option>
													<option value="$tomorrow2">$tomorrowText</option>
													<option value="$twodays2">$twodaysText</option>
												</select>
											</div>
											<div class="col-12">
												<select name="time" id="time" required>


_END;
										$time2 = strtotime("Today 09:00am");
										$time = date("h:i:s", $time2);

										for($k = 0; $k < 12; ++$k) {
											echo '<option value='.$time.'>'.$time.'</option>';
											$time->modify('+1 hour');
										}

										echo <<<_END
												</select>
											</div>
											<div class="col-12">
												<input type="text" name="code" id="code" placeholder="Unique Code (optional)">
											</div>
											<div class="col-12">
												<input type="text" name="name" id="name" placeholder="Name (optional)">
											</div>
											<div class="col-12">
												<input type="submit">
											</div>
										</div>
_END;
									};

									if(isset($_POST['location']) && isset($_POST['date']) && isset($_POST['time'])) {

										$time = $_POST['time'];
										$date = $_POST['date'];
										$location = $_POST['location'];

										$query  = "SELECT * FROM slots INNER JOIN locations on slots.location=locations.id where date=$date AND time=$time AND location=$location";
										if(isset($_POST['code'])) {
											$code = $_POST['code'];
										}

										if(isset($_POST['name'])) {
											$name = $_POST['name'];
										}
										
										$result = $conn->query($query);
										if (!$result) die ("Database access failed: " . $conn->error);
										$rows = $result->num_rows;

										echo <<<_END
										<div class="col-12">
											<h2>Search Results</h2>
												<table>
													<thead>
														<tr>
															<th>Name</th>
															<th>Phone Number</th>
															<th>Date</th>
															<th>Time</th>
															<th>Code</th>
															<th>Location Name</th>
														</tr>
													</thead>
_END;

										$rows = $result->num_rows;

										for ($i = 0 ; $i < $rows ; ++$i) {
											$result->data_seek($i);
											$row = $result->fetch_array(MYSQLI_ASSOC);
											echo '<tr>';
											echo '<td>'.$row['name'].'</td>';
											echo '<td>'.$row['phone'].'</td>';
											echo '<td>'.$row['date'].'</td>';
											echo '<td>'.$row['time'].'</td>';
											echo '<td>'.$row['code'].'</td>';
											echo '<td>'.$row['location_name'].'</td>';
											echo '</tr>';
										}

										echo <<<_END
											</table>
										</div>
									</div>
_END;
									}
								};
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
