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
        $_SESSION['user'] = $_POST['username'];
        header( "Location: admin.php" );
     } else {
        header( "Location: login.php?error=1" );
     }
} else {
     header( "Location: login.php?error=2" );
}
?>