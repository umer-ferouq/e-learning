<?php 
    $title = "View Student";
    include("includes/header.php");
    include('config/config.php');
?>
       <link rel="stylesheet" href="resource/css/bootstrap.min.css">
           <link rel="stylesheet" href="../resource/css/font-awesome.min.css">
     <link rel="stylesheet" href="../resource/css/animate.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../resource/css/tooplate-style.css">
     <link rel="stylesheet" href="../resource/css/tellocss.css">

   
  <div class="container">
  
             <div class="col-sm-4 col-md-4"></div>
               <div class=""><h3>Student</h3></div>

                          <hr>
                            <table class="table">
        <thead>
            <tr>
            <th>S/N</th>
            <th>Student Name</th>
            <th>Student Number</th>
            <th>Email</th>
            <th>Phone</th>
            <!-- <th>Faculty</th> -->
            <th>Department</th>
            <th>Gender</th>
            <th>Profile</th>
            <th>Remove</th>
            </tr>
        </thead>
        <?php
          $selquery ="SELECT `std_id`, `std_name`, `reg_number`, `std_email`,`std_phone`, `std_dept`, `gender`, 
          `dept_name` FROM `student` INNER JOIN dept ON student.std_dept = dept_id";

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
          </table><hr>
                          </div>
                      
                  </div>

        
        </div>
              
      </div>
</div>
    <!-- FOOTER -->
    <?php include("includes/footer.php") ?>
