<?php 
// this code is for redirecting to different pages if the credentials are correct.
   session_start();
   include 'config/config.php';
//    $link = "";
   if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   
         //admin
      	if ($_SESSION['role'] == 'Admin'){
			header("Location: dashboard.php");
			
      	 }
		 //hod
		else if ($_SESSION['role'] == 'HOD'){ 
			
			header("Location: hdashboard.php");
      	} 
		//lecturer
		else if ($_SESSION['role'] == 'Staff'){ 
			header("Location: ldashboard.php");
		}else if ($_SESSION['role'] == 'student'){
			header("Location: sdashboard.php");
      	 } else{
			header("Location:logout.php");
		 }
 }
else{
	header("Location:login.php");
} ?>
