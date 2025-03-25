<!-- some adjustment sould be made here -->
<?php

$title = "Add Course";
include("includes/header.php");
include('config/config.php');
$msg = "";
$idn = $_SESSION['id'];
if(isset($_POST['create']) && isset($_POST['title'])){
    
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $code = mysqli_real_escape_string($conn, $_POST['code']);
  $unit = mysqli_real_escape_string($conn, $_POST['unit']);
  $level = mysqli_real_escape_string($conn, $_POST['level']);
  $lecturer = mysqli_real_escape_string($conn, $_POST['lec']);
  
  $check_code = mysqli_num_rows(mysqli_query($conn, "SELECT course_code FROM course WHERE course_code = '$code' limit 1"));

  if (empty($title)) {
    echo "Fields can't be empty";
  }elseif($check_code > 0) {
      echo"<script>alert('Course already exist.');</script>";
  }else{
      $sql = "INSERT INTO course (course_title, course_code, unit,level,lecturer_id) 
      VALUES ('$title','$code','$unit','$level', '$lecturer')";
      $result = mysqli_query($conn, $sql);
        if($result) {
          echo"<script>alert('Course added.');</script>";
        } else{
          echo"<script>alert('Failed to add Course.');</script>";
        }
  }
}
?>

<main class="flex-shrink-0">
    <div class="row mt-4">
   
        <div class="col-md-4 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Create Course</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
               
                <div class="form-group mb-1">
                    <label for="title" class="form-label mt-3">Course Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="form-group mb-1">
                    <label for="code" class="form-label mt-3">Course Code</label>
                    <input type="text" class="form-control" name="code" placeholder="COSC000">
                </div>
                <div class="form-group mb-1">
                    <label for="lecturer">Lecturer</label><br>
                    <select class="form-control" name="lec" id="lec">
                        <?php 
                        // get the below code using  session
                        // make the code to display for ech dept deperately depending on the hod that indert the data
                        // $dep = "Computer Science";
                        // $lec = mysqli_query($conn, "select staff_id, staff_name, dpt_id from staff WHERE dpt_id ='$dep' ORDER BY staff_name ASC");
                        $lec = mysqli_query($conn, "select staff_id, staff_name, dpt_id, role from staff WHERE role != 'Admin' ORDER BY staff_name ASC");
                        while($row = mysqli_fetch_array($lec)){
                            echo '<option value='.$row["staff_id"].'>' .$row["staff_name"].'</option>';
                            }
                            mysqli_free_result($lec);
                            ?>
                        </select> 
                </div>
                <div class="form-group mb-1">
                    <label for="Unit" class="form-label mt-3">Number of Unit</label>
                    <input type="text" class="form-control" name="unit" placeholder="0">
                </div>
                <div class="form-group mb-1">
                    <label for="lecturer" class="form-label mt-3">Level</label>
                        <select class="form-control" id="level" name="level">
                            <option value='100 Level'>100 Level</option>
                            <option value='200 Level'>200 Level</option>
                            <option value='300 Level'>300 Level</option>
                            <option value='400 Level'>400 Level</option>
                            <option value='500 Level'>500 Level</option>
                        </select>                
                </div>
                <button type="submit" name="create" class="btn btn-primary btn-block w-100 mt-3">Create Course</button>
            </form>
            <!-- Table of Courses -->
        </div>
    
</div>
<div class="row mt-5">
<div class="col-md-8 mx-auto">
        <table class="table">
            <thead>
                <tr>
                <th>S/N</th>
                <th>Title</th>
                <th>Code</th>
                <th>Unit</th>
                <th>level</th>
                <th>Lecturer Name</th>
                <th>View</th>
                <th>Delete</th>
                </tr>
            </thead>

            <?php
            // make it change for each dept
          $selquery ="SELECT `course_id`, `course_title`, `course_code`, `unit`, `level`, `lecturer_id`, `staff_name`
          FROM `course` INNER JOIN staff ON course.lecturer_id = staff_id ORDER BY level";
          //bind connection with query
          $resl = mysqli_query($conn, $selquery);
          //loop through the table
          $j = 0;
          while($row = mysqli_fetch_assoc($resl)){

          $j++;
          $id = $row['course_id'];
          $lid = $row['lecturer_id'];
          if ($lid == $idn) {
          
          ?>

            <tbody>
            <tr class="" >
              <td class="center"> <?php echo $j;?></td>
              <td class="center"> <?php echo $row['course_title'] ?></td>
              <td class="center"> <?php echo $row['course_code'] ?></td>
              <td class="center"> <?php echo $row['unit'] ?></td>
              <td class="center"> <?php echo $row['level'] ?></td>
              <td class="center"> <?php echo $row['staff_name'] ?></td>
              <td><a href="<?php echo 'show.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a></td>
              <td><a href="<?php echo 'delete.php?id='.$id; ?>"><span class="fa fa-trash btn btn-danger"></span></a></td>
            </tr>
            <?php }
            }
                          mysqli_free_result($resl);
                          mysqli_close($conn);
                          ?>
            </tbody>
        </table>
    </div>
</div>
</main>

<?php include("includes/footer.php") ?>