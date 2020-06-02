<?php // connect.php allows connection to the database
    $hn = '127.0.0.1';
	$db = 'slotselection';
	$un = 'admin';
	$pw = 'coronasucksdick';
	
	$conn = new mysqli($hn,$un,$pw,$db);
	
    if ($conn->connect_error){
        die($conn->connect_error);
		echo 'Unable to connect to MySQL, contact System Administrator.';
	}
	else {
		// do nothing
    };
?>
  