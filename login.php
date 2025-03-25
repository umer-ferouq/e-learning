<?php
    $title = "Login Page";
    include("includes/header.php");
    include("includes/nav.php");
    include('config/config.php');

if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   

    if (isset($_POST['email']) && isset($_POST['password'])) { 

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
      $email = test_input($_POST['email']);
      $password = test_input($_POST['password']);
      $role = $_POST['role'];
      if (empty($email) && empty($password)) {
        echo"<script>alert('Fields can't be empty!');</script>";

      }elseif ($role == "student") {
        $sql = "SELECT * FROM student WHERE std_email = '$email' AND std_password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
    
          $row = mysqli_fetch_assoc($result);
          if ($row['std_password'] === $password) {
            $_SESSION['name'] = $row['std_name'];
            $_SESSION['email'] = $row['std_email'];
            $_SESSION['id'] = $row['std_id'];
            $_SESSION['role'] = $role;
  
            header("Location: redirect.php");
          }
        }
      } elseif($role !== "student"){
        $sql = "SELECT * FROM staff WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
    
          $row = mysqli_fetch_assoc($result);
          $role = $row['role'];
          if ($row['password'] === $password) {
            $_SESSION['name'] = $row['staff_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['staff_id'];
            $_SESSION['role'] = $role;
  
            header("Location: redirect.php");
          }
        }
      } else{
        echo"<script>alert('Invalid Email or Password!');</script>";
      }
  }
}
?>

<main class="flex-shrink-0">
    <div class="row mt-5">
        <div class="col-md-3 mx-auto">
            <h3 class="mb-0 display-5 text-center fw-semibold">Login</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              
                <div class="form-group mb-3">
                    <label for="email" class="form-label mt-4">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="umr@gmail.com">
                </div>
                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between">
                        <label for="password" name="password" class="form-label">Password</label>
                        <a href="" class="text-muted">Forgot password?</a>
                      </div>
                      <input type="password" class="form-control" name="password" placeholder="password here...">
                    </div>
                    <div class="form-group">
                <label for="sel1">Role</label>
                    <select class="form-control" id="sel1" name="role">
                        <option value="staff">Staff</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
            </form>
            <p class="text-muted d-block text-center mt-3">Don't have an account <a href="register.php">Register</a></p>
        </div>
    </div>
</main>

<?php 
        include("includes/footer.php");
     ?>