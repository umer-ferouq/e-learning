<?php

$title = "Register Student";
include("includes/header.php");
include("includes/nav.php");
include('config/config.php');

if(isset($_POST['Register']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])){
    
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $reg = mysqli_real_escape_string($conn, $_POST['reg_no']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $gender = mysqli_real_escape_string($conn, $_POST['gender']);
  $dept = $_POST['dept'];
  $password = $_POST['password'];
  
  $check_phone = mysqli_num_rows(mysqli_query($conn, "SELECT std_phone FROM student WHERE std_phone = '$phone' limit 1"));

  if (empty($email) && empty($password) && empty($name) && empty($reg) && empty($phone) && empty($gender)) {
    echo "<script>alert('Fields can't be empty!');</script>";
  }elseif($check_phone > 0) {
      echo"<script>alert('Phone already exist.');</script>";
  }else{
      $sql = "INSERT INTO student (std_name,reg_number, std_email, std_phone, gender, std_dept, std_password) 
      VALUES ('$name','$reg','$email','$phone','$gender', '$dept','$password')";
      $result = mysqli_query($conn, $sql);

        if($result) {
          echo"<script>alert('Student added successfully.');</script>";
        } else{
          echo"<script>alert('Failed to add Student.');</script>";
        }
  }
}
?>

<main class="flex-shrink-0">
    <div class="row mt-5">

        <div class="col-md-3 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Register Page</h3>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                
                <div class="form-group mb-1">
                    <label for="name" class="form-label mt-3">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                </div>
                <div class="form-group mb-1">
                    <label for="reg_no" class="form-label mt-3">Reg Number</label>
                    <input type="text" class="form-control" name="reg_no" placeholder="eg. UG17/SCCS/1052">
                </div>
                <div class="form-group mb-1">
                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="user@mail.com">
                </div>
                <div class="form-group mb-1">
                    <label for="dept">Department</label><br>
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
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Phone</label>
                    <input type="phone" class="form-control" name="phone" placeholder="080-111-00-111">
                </div>
                <div class="form-group mb-1">
                    <label for="phone" class="form-label mt-3">Gender</label>
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
                <div class="form-group mb-1">
                    <label for="password" class="form-label mt-3">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="form-group mb-1">
                    <label for="cpassword" class="form-label mt-3">Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
                </div>
                <button type="submit" name="Register" class="btn btn-primary btn-block w-100 mt-3">Register</button>
            </form>
            <p class="text-muted d-block text-center mt-3">Have an account <a href="login.php">Login</a></p>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>