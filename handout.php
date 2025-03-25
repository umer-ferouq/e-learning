<?php
$title = "View";
require 'includes/header.php';
$id = $_GET['id'];
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    include('config/config.php');
    $sql = "SELECT `material_id`, `created`, `material_desc`, `file`, `course_id`, `level` FROM `material` WHERE course_id = '$id'";  
    $result = mysqli_query($conn, $sql); ?>  
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Download</th>
                        <th>Created on</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['material_desc']; ?></td>
                    <td><a href="materials/<?php echo $row['file']; ?>" target="_blank">View</a></td>
                    <td><a href="materials/<?php echo $row['file']; ?>" download>Download</td>
                    <td><?php echo $row['created']; ?></td>
                </tr>
                <?php } 
                    mysqli_free_result($result);
                }else{
                        // URL doesn't contain id parameter. Redirect to error page
                        header("location: error.php");
                        exit();
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>          
          
            <?php  
        include("includes/footer.php") ?>