<?php
    $title = "View";
    require 'includes/header.php';
    
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Include config file
        include('config/config.php');

    // Prepare a select statement
    $sql ="SELECT dept_id,dept_name,hod,faculty FROM dept WHERE dept_id = ? ";

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
                $name = $row['dept_name'];
                $hod = $row['hod'];
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
} 
// END OF STAFF READ
else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

        <div class="container">
            <div class="row">
                <div style="margin:0px auto; width: 40%">
                    <div class="well-header bg-danger">
                     <h3>View Record</h3>
                 </div>
                 <!-- records -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <label>Department Name</label>
                        <p><b><?php echo $name; ?></b></p>
                        <label>Hod</label>
                        <p><b><?php echo $hod; ?></b></p>
                    <div class="form-group">
                        <label>Faculty</label>
                        <p><b><?php echo $faculty; ?></b></p>
                    </div>
                </div>
                    <div class="panel-footer">                    
                        <p><a href="adddept.php" class="btn btn-primary">Back</a></p>
                    </div>
                    </div>
 
                </div>
            </div>        
        </div>
</body>
</html>
