<?php 
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
    // header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en"  class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resource/bootstrap.min.css">
    <link rel="stylesheet" href="resource/style.css">
    <link rel="stylesheet" href="resource/css/font-awesome.min.css">
    
    <title><?php echo $title?></title>

</head>
<body class="d-flex flex-column h-100">