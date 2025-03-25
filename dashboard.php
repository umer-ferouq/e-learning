<!DOCTYPE html>
<?php
session_start();
include('config/config.php');

if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   
    header("Location: login.php");
  }
  $id = $_SESSION['id'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="resource/css/style.css">
     <link rel="stylesheet" href="resource/css/bootstrap.min.css">
     <!-- remove bootstrap later and table put in a diff file -->
           <link rel="stylesheet" href="resource/css/font-awesome.min.css">
     
    <title>Admin Dashboard</title>
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
                <li><a href="adddept.php">
                    <i class="fa fa-clone"></i>                    
                    <span class="link-name">Department</span>
                </a></li>
                <li><a href="createstaff.php">
                    <i class="fa fa-user-plus"></i>
                    <span class="link-name">Create Staff</span>
                </a></li>
                <li><a href="viewstaff.php">
                    <i class="fa fa-users"></i>
                    <span class="link-name">View Staff</span>
                </a></li>
                <li><a href="student.php">
                    <i class="fa fa-mortar-board"></i>
                    <span class="link-name">Student</span>
                </a></li>
                <li><a href="posting.php">
                    <i class="fa fa-plus-square"></i>
                    <span class="link-name">Post Material</span>
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
                        <i class="fa fa-sitemap"></i>
                        <span class="text">Total Departments</span>
                        <span class="number">
                        <?php 
                     $sql = "SELECT count(*) as alldept FROM dept";
                     $result = mysqli_query($conn, $sql);
                     $data = mysqli_fetch_assoc($result);
                     echo $data['alldept'];
                     mysqli_free_result($result);
                     ?>
                        </span>
                    </div>
                    <div class="box box2">
                        <i class="fa fa-users"></i>
                        <span class="text">Total Staff </span>
                        <span class="number">
                        <?php 
                     $sql = "SELECT count(*) as allstaff FROM staff";
                     $result = mysqli_query($conn, $sql);
                     $data = mysqli_fetch_assoc($result);
                     echo $data['allstaff'];
                     mysqli_free_result($result);
                     ?>
                        </span>
                    </div>
                    <div class="box box3">
                        <i class="fa fa-mortar-board"></i>
                        <span class="text">Total Student</span>
                        <span class="number">
                        <?php 
                     $sql = "SELECT count(*) as allstd FROM student";
                     $result = mysqli_query($conn, $sql);
                     $data = mysqli_fetch_assoc($result);
                     echo $data['allstd'];
                     mysqli_free_result($result);
                     ?>
                        </span>
                    </div>  
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="fa fa-clock-o"></i>
                    <span class="text">Student</span>
                </div>

                <div class="activity-data">
                <table class="table">
        <thead>
            <tr>
            <th>S/N</th>
            <th>Student Name</th>
            <th>Student Number</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Profile</th>
            <th>Gender</th>
            <th>Remove</th>
            </tr>
        </thead>
        <?php
          $selquery ="SELECT `std_id`, `std_name`, `reg_number`, `std_email`, `std_phone`, `gender`, `std_dept`,`dept_name` 
          FROM `student` INNER JOIN dept ON student.std_dept = dept_id";
          //bind connection with query
          $resl = mysqli_query($conn, $selquery);
          //loop through the table
          $j = 0;
          while($row = mysqli_fetch_assoc($resl)){

          $j++;
          $id = $row['std_id'];
          ?>       
          <tbody>
            <tr class="" >
                <td class="center"> <?php echo $j;?></td>
                <td class="center"> <?php echo $row['std_name'] ?></td>
                <td class="center"> <?php echo $row['reg_number'] ?></td>
                <td class="center"> <?php echo $row['std_email'] ?></td>
                <td class="center"> <?php echo $row['std_phone'] ?></td>
                <td class="center"> <?php echo $row['dept_name'] ?></td>
                <td class="center"> <?php echo $row['gender'] ?></td>
                <td><a href="<?php echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td>
                <td><a href="<?php echo 'delete.php?id='.$id; ?>"><span class="fa fa-trash btn btn-danger"></span></a></td>
            </tr>
            <?php }
            mysqli_free_result($resl);
            mysqli_close($conn);
            ?>
          </tbody>
          </table>
                </div>
            </div>
        </div>
    </section>
    <script src="resource/js/script.js"></script>
</body>
</html>