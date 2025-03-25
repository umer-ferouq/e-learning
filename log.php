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
	$role = test_input($_POST['role']);
	
    if (empty($email) && empty($password)) {
        echo"<script>alert('Fields can't be empty!');</script>";

      }elseif ($role == "student") {
        $sql = "SELECT * FROM student WHERE std_email = '$email' AND std_password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
    
          $row = mysqli_fetch_assoc($result);
          if ($row['std_password'] === $password) {
            $_SESSION['name'] = $row['std_name'];
            $_SESSION['email'] = $row['std_email'];
            $_SESSION['id'] = $row['std_id'];
            $_SESSION['role'] = $role;
  
            header("Location: redirect.php");
          }
        }
      } elseif($role !== "student"){
        $sql = "SELECT * FROM staff WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
    
          $row = mysqli_fetch_assoc($result);
          $role = $row['role'];
          if ($row['password'] === $password) {
            $_SESSION['name'] = $row['staff_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['staff_id'];
            $_SESSION['role'] = $role;
  
            header("Location: redirect.php");
          }
        }
      } else{
        echo"<script>alert('Invalid Email or Password!');</script>";
      }
    }