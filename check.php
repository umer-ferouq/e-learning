<?php  

//login login 
session_start();
include "config/config.php";
if (isset($_POST['email']) && isset($_POST['password'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	
		if (empty($email)) {
			header("Location: login-index.php?error=Email Name is Required");
		}else if (empty($password)) {
			header("Location: login-index.php?error=Password is Required");
		}
	
		$sql = "SELECT * FROM staff WHERE email='$email' AND password='$password'";
		$result = mysqli_query($conn, $sql);
	
		if (mysqli_num_rows($result) === 1) {
			
			$row = mysqli_fetch_assoc($result);
			
			$role = $row['role'];
			if ($row['password'] === $password) {
				$_SESSION['name'] = $row['staff_name'];
				$_SESSION['id'] = $row['staff_id'];
				$_SESSION['role'] = $role;
				$_SESSION['email'] = $row['email'];
	
				header("Location: redirect.php");
	
			}else {
				header("Location: login-index.php?error=Incorect name or password");
			}
		}
}
		else 			header("Location: index.php");
