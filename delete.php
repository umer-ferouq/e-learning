<?php
    $title = "Delete";
    // Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "config/config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM `dept` WHERE dept_id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: adddept.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
require 'includes/header.php';
?>

        <div class="container">
            <div class="row">
                <div class="col-xs-5">
                    <div class="well-header bg-danger">
                     <h3>Delete Record</h3>
                 </div>
                    <div class="panel panel-default">
  <div class="panel-body">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="adddept.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
  </div>
  <div class="panel-footer">                    
      <p><a href="admin.php" class="btn btn-primary">Back</a></p>
</div>
</div>

                  
                </div>
            </div>        
        </div>
</body>
</html>