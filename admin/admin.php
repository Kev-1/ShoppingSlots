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
						<section class="wrapper style5">
							<div class="inner">
								<?php
									session_start();
									session_regenerate_id();
									if(!isset($_SESSION['user'])) {
										header("Location: login.php");
									} else {
										require "../database.php";
										
									$query  = "SELECT * FROM slots INNER JOIN locations on slots.location = locations.location_id;";
									$result = $conn->query($query);
									if (!$result) die ("Database access failed: " . $conn->error);
									$rows = $result->num_rows;

									echo <<<_END
									<div class="col-12">
										<h2>Staff panel</h2>
										<a href="search.php" class="button">Search Specific Data</a>
										<div class="table-wrapper">
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