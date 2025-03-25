<!DOCTYPE html>
<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
    header("Location: login.php");
  }
  $id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="resource/css/style.css">
    <link rel="stylesheet" href="resource/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="resource/css/bootstrap.min.css"> -->
    <title>Student Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="resource/images/logo.jpeg" alt=""> 
             </div>

             <span class="logo_name">e-learning</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="fa fa-home"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
                <li><a href="regcourse.php">
                    <i class="fa fa-certificate"></i>
                    <span class="link-name">Courses</span>
                </a></li>
                <li><a href="materials.php">
                    <i class="fa fa-book"></i>
                    <span class="link-name">Materials</span>
                </a></li>
                <li><a href="notication.php">
                    <i class="fa fa-tags"></i>
                    <span class="link-name">Notification</span>
                </a></li>
            </ul>
    
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="fa fa-sign-out"></i>
                        <span class="link-name">Logout</span>
                </a></li>
    
                <li class="mode">
                    <a href="">
                        <i class="fa fa-moon-o"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
    
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="fa fa-bars sidebar-toggle"></i>
            
            <div class="search-box">
                <i class="fa fa-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <a href="<?php echo 'profile.php?id='.$id; ?>"><img src="resource/images/profile.png" alt=""></a>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="fa fa-dashboard"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="fa fa-certificate"></i>
                        <span class="text">Total Courses</span>
                        <span class="number">0
                        <?php 
                    //  $sql = "SELECT count(*) as alldept FROM dept";
                    //  $result = mysqli_query($conn, $sql);
                    //  $data = mysqli_fetch_assoc($result);
                    //  echo $data['alldept'];
                    //  mysqli_free_result($result);
                     ?>
                        </span>
                    </div>
                    <div class="box box2">
                        <i class="fa fa-book"></i>
                        <span class="text">Total Materials </span>
                        <span class="number">0</span>
                    </div>
                    <div class="box box3">
                        <i class="fa fa-tag"></i>
                        <span class="text">Notification</span>
                        <span class="number">0</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="dashboard/script.js"></script>
</body>
</html>