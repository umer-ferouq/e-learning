<?php

$title = "Post Handout";
include("includes/header.php");

?>
    <div class="col-md-3 mx-auto">

        <form action="upload.php" method="POST" target="_self" enctype="multipart/form-data">
           
        <?php if(isset($_GET['st'])) { ?>
                <div class="alert alert-danger text-center">
                <?php if ($_GET['st'] == 'success') {
                        echo "File Uploaded Successfully!";
                    }
                    else
                    {
                        echo 'Invalid File Extension!';
                    } ?>
                </div>
            <?php } ?>
        
          <input type="hidden" name= "size" value="10000000">
            <div class="form-group mb-1">
                <label for="desc" class="form-label mt-3">Description</label>
                <textarea class="form-control" rows="5" name="desc" placeholder="Write Something"></textarea>
            </div>
            <div class="form-group mb-1">
                <label for="file" class="form-label mt-3">Handout Document</label>
                <input type="file" class="form-control" name="filename">
            </div>
            <button type="submit" name="send" class="btn btn-primary btn-block w-100 mt-3">Send Material</button>
        </form>
    </div>
<?php include("includes/footer.php") ?>