<?php 
    $title = "View Staff";
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
               <div class=""><h3>Staff</h3></div>

                          <hr>
                            <table class="table">
        <thead>
            <tr>
            <th>S/N</th>
            <th>Staff Name</th>
            <th>Staff Number</th>
            <th>Email</th>
            <th>Phone</th>
            <!-- <th>Faculty</th> -->
            <th>Department</th>
            <th>Role</th>
            <th>Gender</th>
            <th>Profile</th>
            <th>Remove</th>
            </tr>
        </thead>
        <?php
          $selquery ="SELECT `staff_id`, `staff_name`, `staff_number`, `email`, `phone`, `role`, 
          `dpt_id`, `gender`,`dept_name` FROM `staff` INNER JOIN dept ON staff.dpt_id = dept_id";

          //bind connection with query
          $resl = mysqli_query($conn, $selquery);
          //loop through the table
          $j = 0;
          while($row = mysqli_fetch_assoc($resl)){

          $j++;
          $id = $row['staff_id'];
          ?>       
          <tbody>
          <tr class="" >
                              <td class="center"> <?php echo $j;?></td>
                              <td class="center"> <?php echo $row['staff_name'] ?></td>
                              <td class="center"> <?php echo $row['staff_number'] ?></td>
                              <td class="center"> <?php echo $row['email'] ?></td>
                              <td class="center"> <?php echo $row['phone'] ?></td>
                              <!-- <td class="center"> <?php //echo $row['faculty'] ?></td> -->
                              <td class="center"> <?php echo $row['dept_name'] ?></td>
                              <td class="center"> <?php echo $row['role'] ?></td>
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
