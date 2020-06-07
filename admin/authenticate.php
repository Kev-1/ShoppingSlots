<?
session_start();
require "../database.php";
if(isset($_POST['username']) && isset($_POST['password']))
{	
	$query = "SELECT * FROM admins where username=".$_POST['username']." AND password=".$_POST['password']."";	
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	if($rows > 0) {
        // auth okay, setup session
        $_SESSION['user'] = $_POST['username'];
        // redirect to required page
        header( "Location: admin.php" );
     } else {
        // didn't auth go back to loginform
        header( "Location: login.php?error=1" );
     }
 } else {
     // username and password not given so go back to login
     header( "Location: login.php?error=2" );
 }
?>