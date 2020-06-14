<?php
session_start();
require "../database.php";
   if(isset($_POST['username']) && isset($_POST['password']))
   {	
      $salt = "coronasucksdick";
      $username = $_POST['username'];
      $password = sha1($_POST['password'].$salt);
      $query = "SELECT * FROM users where username=\"$username\" AND password=\"$password\"";	
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