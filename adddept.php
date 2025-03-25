<?php

$title = "Add Department";
include("includes/header.php");
include('config/config.php');
$msg = "";
$id = $_SESSION['id'];

if(isset($_POST['Add']) && isset($_POST['dept'])){
    
  $dept = mysqli_real_escape_string($conn, $_POST['dept']);
  $faculty = "Science";
  
  $check_dept = mysqli_num_rows(mysqli_query($conn, "SELECT dept_name FROM dept WHERE dept_name = '$dept' limit 1"));

  if (empty($dept)) {
    echo "Fields can't be empty";
  }elseif($check_dept > 0) {
      echo"<script>alert('Phone already exist.');</script>";
  }else{
      $sql = "INSERT INTO dept (dept_name, hod, faculty) VALUES ('$dept', '$id', '$faculty')";
      $result = mysqli_query($conn, $sql);
        if($result) {
          echo"<script>alert('Department added successfully.');</script>";
        } else{
          echo"<script>alert('Failed to add Department.');</script>";
        }
  }
}
?>


<main class="flex-shrink-0">
    <div class="row mt-4">
  
        <div class="col-md-4 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Department</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                          
              <div class="form-group mb-1">
                <label for="dname" class="form-label mt-3">Department Name</label>
                <input type="text" class="form-control" placeholder="Mathematics Department" name="dept">
              </div>
                <button type="submit" name="Add" class="btn btn-primary btn-block w-100 mt-3">Create Department</button>        
            </form>
                <!-- Table of department -->
            </div>
    
</div>
<div class="row mt-5">
<div class="col-md-8 mx-auto">
<table class="table">
        <thead>
            <tr>
            <th>S/N</th>
            <th>Dept Name</th>
            <th>Hod</th>
            <th>View</th>
            <th>Edit</th>
            </tr>
        </thead>
        
        <?php
          $selquery ="SELECT `dept_id`, `dept_name`, `hod`, `staff_name` FROM `dept`INNER JOIN staff ON dept.hod = staff.staff_id";

          //bind connection with query
          $resl = mysqli_query($conn, $selquery);
          //loop through the table
          $j = 0;
          while($row = mysqli_fetch_assoc($resl)){

          $j++;
          $id = $row['dept_id'];
          ?>

        <tbody>
        <tr class="" >
          <td class="center"> <?php echo $j;?></td>
          <td class="center"> <?php echo $row['dept_name'] ?></td>
          <td class="center"> <?php echo $row['staff_name'] ?></td>
          <td><a href="<?php echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td>
          <td><a href="<?php echo 'delete.php?id='.$id; ?>"><span class="fa fa-trash btn btn-danger"></span></a></td>
        </tr>
        <?php 
                    }
                    mysqli_free_result($resl);

                ?>
        </tbody>
    </table>
      <hr>
    </div>
</div>
</main>

<?php include("includes/footer.php") ?>