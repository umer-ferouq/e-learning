<?php
$title = "";
include("includes/header.php");

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = $_SESSION['id'];
    $faculty =  "";
    // Include config file
    include('config/config.php');
    $role="";
        if ($_SESSION['role'] !== 'student') {
        
            // Prepare a select statement
        $sql ="SELECT `staff_id`, `staff_name`, `staff_number`, `email`, `phone`, 
        `role`, `dpt_id`, `faculty`, `gender` FROM `staff` WHERE  staff_id = ? ";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_GET["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // Retrieve individual field value
                    $name = $row['staff_name'];
                    $no = $row['staff_number'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $role = $row['role'];
                    $gender = $row['gender'];
                    $faculty = $row['faculty'];
                } else{
                    // URL doesn't contain valid id parameter. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
        } elseif ($_SESSION['role'] == 'student') {
               // Prepare a select statement
        $sql ="SELECT `std_id`, `std_name`, `reg_number`, `std_email`, `std_phone`,
         `gender`, `std_dept` FROM `student` WHERE std_id = ? ";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_GET["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row['std_name'];
                    $no = $row['reg_number'];
                    $email = $row['std_email'];
                    $phone = $row['std_phone'];
                    $gender = $row['gender'];
                    $dept = $row['std_dept'];
                } else{
                    // URL doesn't contain valid id parameter. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
        }

} 
// END OF STAFF READ
else{
// URL doesn't contain id parameter. Redirect to error page
header("location: error.php");
exit();
}
?>

        <div class="col-md-3 mx-auto">
            
            <h3 class="mb-0 display-5 text-center fw-semibold">Profile</h3>
            <form action="" method="post">
                <div class="form-group mb-1">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" disabled class="form-control" id="name" <?php echo "value= '$name'"; ?> >
                </div>
                <div class="form-group mb-1">
                    <label for="reg_no" class="form-label mt-3">Reg Number</label>
                    <input type="text" disabled class="form-control" id="reg_no"<?php echo "value= '$no'"; ?> placeholder="eg. UG17/SCCS/1052">
                </div>
                <div class="form-group mb-1">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" disabled class="form-control" id="email" <?php echo "value= '$email'"; ?> >
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="phone" disabled class="form-control" id="email" <?php echo "value= '$phone'"; ?> >
                </div>
                <div class="form-group mb-1">
                    <label for="phone" disabled class="form-label mt-3">Gender: <?php echo "$gender"; ?></label>
                </div>
                <div class="form-group mb-1">
                    <label for="role" class="form-label mt-3">Role: <?php echo "$role"; ?></label>
                </div>
                <?php
                    if ($_SESSION['role'] !== 'Student'){
                        echo "<div class='form-group mb-1'>
                        <label class='form-label mt-1'>Faculty</label>
                        <input type='text' disabled class='form-control' value='Science'"?> <?php echo "value= '$faculty'"; ?> 
                   <?php echo "</div>";
                    }?>
                
                    </div>
            </form>
                <a href="<?php echo 'editprofile.php?id='.$id; ?>"><button class="btn btn-primary w-50 mt-3">Edit Profile</button></a>
                <a href="<?php echo 'changepassword.php?id='.$id; ?>"><button class="btn btn-primary w-50 mt-3">Change Password</button></a>
        </div>

<?php include("includes/footer.php") ?>