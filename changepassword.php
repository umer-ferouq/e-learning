<?php
$title = "Change Password";
include("includes/header.php");
include('config/config.php');
$msg = "";
$id = $_SESSION['id'];

if ($_SESSION['role'] == 'student') {
  if(isset($_POST['change']) && isset($_POST['opass']) && isset($_POST['npass']) && isset($_POST['cpass'])){
      
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    
    $check_pass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT std_password, std_id FROM student WHERE std_id = $id "));
    $pass = $check_pass['std_password'];
  
    if (empty($opass)) {
      echo "Fields can't be empty";
      }elseif($pass !== $opass ) {
      echo"<script>alert('Old password not correct');</script>";
      }elseif($npass !== $cpass) {
        echo"<script>alert('Password does not match!');</script>";
    }else{
        $sql = "UPDATE `student` SET `std_password`= '$npass' WHERE std_id = $id";
        $result = mysqli_query($conn, $sql);
          if($result) {
            echo"<script>alert('Password changed.');</script>";
          } else{
            echo"<script>alert('Failed to change password.');</script>";
          }
    }
  }
}else {
  if(isset($_POST['change']) && isset($_POST['opass']) && isset($_POST['npass']) && isset($_POST['cpass'])){
      
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    
    $check_pass = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password, staff_id FROM staff WHERE staff_id = $id "));
    $pass = $check_pass['password'];
  
    if (empty($opass)) {
      echo "Fields can't be empty";
      }elseif($pass !== $opass ) {
      echo"<script>alert('Old password not correct');</script>";
      }elseif($npass !== $cpass) {
        echo"<script>alert('Password does not match!');</script>";
    }else{
        $sql = "UPDATE `staff` SET `password`= '$npass' WHERE staff_id = $id";
        $result = mysqli_query($conn, $sql);
          if($result) {
            echo"<script>alert('Password changed.');</script>";
          } else{
            echo"<script>alert('Failed to change password.');</script>";
          }
    }
  }
}
?>

<main class="flex-shrink-0">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h5 class="mb-0 display-5 text-center fw-semibold">Change Password</h5>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="form-group mb-1">
                    <label for="opassword" class="form-label mt-3">Old Password</label>
                    <input type="password" class="form-control" name="opass" placeholder="Old Password">
                </div>
                <div class="form-group mb-1">
                    <label for="password" class="form-label mt-3">New Password</label>
                    <input type="password" class="form-control" name="npass" placeholder="New Password">
                </div>
                <div class="form-group mb-1">
                    <label for="cpassword" class="form-label mt-3">Confirm Password</label>
                    <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
                </div>
                    <button type="submit" name="change" class="btn btn-primary btn-block w-100 mt-3">Change Password</button>
            </form>
        </div>
    </div>
</main>

<?php include("includes/footer.php") ?>