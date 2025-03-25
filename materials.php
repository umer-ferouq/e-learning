<?php
$title = "Get Materials";
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
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
              
            <h3 class="">Course Materials</h3>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" target="_self">
                 <div class="row">
                   <div class="col-sm-12">
                        <div class="form-group">
                            <label for="level">Level</label>
                                <select class="form-control" id="level" name="level">
                                <option value='100 Level'>100 Level</option>
                                <option value='200 Level'>200 Level</option>
                                <option value='300 Level'>300 Level</option>
                                <option value='400 Level'>400 Level</option>
                                <option value='500 Level'>500 Level</option>
                                </select>
                        </div>
                        <div class="form-group">
                        <button type="submit" name="search" class="btn btn-info button-full">Get Materials</button>
                     </div> 
                     
                   </div>
                   
                 </div>
            </form> 
        </div>
        <?php
            if (isset($_POST['search']) && isset($_POST['level'])) {
                $level = mysqli_real_escape_string($conn, $_POST['level']);

                // fetch files
                $selquery = "SELECT course.course_id, course.course_title, course.unit, course.level,
                course.course_code, staff.staff_name 
                FROM course INNER JOIN staff ON staff.staff_id = course.lecturer_id WHERE level = '$level'";
                $resl = mysqli_query($conn, $selquery);
                // $j = 0;
                while($row = mysqli_fetch_array($resl)){
                    // $j++;
                    $id = $row['course_id'];
                    // echo $j;
                    echo "<div class='card'><div class='card-header'>" . $row['course_title'].
                    " <br>" . $row['course_code']. " (" . $row['unit'] ."CU)</div>
                    <div class='card-footer'>";?>
                    <a href="<?php echo 'handout.php?id='.$id; ?>"><span class="fa fa-eye btn btn-info"></span></a>
                   <?php echo "
                    ". $row['staff_name']. "</div></div>";
                    }
                    mysqli_free_result($resl);
                }  
        ?>
    </div>
</div> 
    
    <!-- FOOTER -->
    <?php include("includes/footer.php") ?>