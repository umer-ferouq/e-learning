<?php
$title = "Create Staff";
include("includes/header.php");
include('config/config.php');
$msg = "";

if(isset($_POST['create']) && isset($_POST['email']) && isset($_POST['phone'])){
    
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $reg = mysqli_real_escape_string($conn, $_POST['reg_no']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  $dept = mysqli_real_escape_string($conn, $_POST['dept']);
  $faculty = "Science";
  $password = "password123";
  
  $check_phone = mysqli_num_rows(mysqli_query($conn, "SELECT phone FROM staff WHERE phone = '$phone' limit 1"));

  if (empty($email) or empty($password) or empty($name) or empty($reg) or empty($phone) or empty($gender)) {
    echo "Fields can't be empty";
  }elseif($check_phone > 0) {
      echo"<script>alert('Phone already exist.');</script>";
  }else{
      $sql = "INSERT INTO staff (staff_name,staff_number,email, phone, password,role, dpt_id,faculty, gender)
       VALUES ('$name','$reg','$email','$phone','$password','$role','$dept','$faculty','$gender')";
      $result = mysqli_query($conn, $sql);
        if($result) {
          echo"<script>alert('Staff added successfully.');</script>";
        } else{
          echo"<script>alert('Failed to add Staff.');</script>";
        }
  }
}
?>
        <div class="col-md-4 mx-auto">
        <?php 
              if(isset($_POST['Register'])){
                echo '<div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo $msg;
                echo '</div>';
              }
              ?>
            <h3 class="mb-0 display-5 text-center fw-semibold">Create Staff</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            
                <div class="form-group mb-1">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Full Name">
                </div>
                <div class="form-group mb-1">
                    <label for="reg_no" class="form-label mt-3">Staff Number</label>
                    <input type="text" class="form-control" name="reg_no" placeholder="eg. STFF/1052">
                </div>
                <div class="form-group mb-1">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="user@mail.com">
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="phone" class="form-control" name="phone" placeholder="080-111-00-111">
                </div>
                <div class="form-group mb-1">
                    <label for="dept" class="form-label mt-3">Department</label><br>
                    <select class="form-control" name="dept" id="dept">
                        <?php 
                        $dept = mysqli_query($conn, "select dept_id, dept_name from dept ORDER BY dept_name ASC");
                        while($row = mysqli_fetch_array($dept)){
                            echo '<option value='.$row["dept_id"].'>'.$row["dept_name"].'</option>';
                            }
                            mysqli_free_result($dept);
                            ?>
                        </select> 
                </div>
                <div class="form-group">
                    <label for="sel1" class="form-label mt-3">Role</label>
                    <select name="role"class="form-control" id="sel1">
                        <option value="Admin">Admin</option>
                        <option value="HOD">Hod</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <div class="form-group mb-1">
                    <label for="Gender" class="form-label mt-3">Gender</label>
                <div class="form-check">
                    <label class="form-check-label" for="radio">
                        <input type="radio" class="form-check-input" id="male" name="gender" value="Male" checked>Male
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="Female">Female
                    </label>
                </div>
                </div>
                <button type="submit" name="create" class="btn btn-primary btn-block w-100 mt-3">Create Staff</button>
            </form>
        </div>

<?php include("includes/footer.php") ?>