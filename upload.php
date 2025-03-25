<?php
include('config/config.php');
//check if form is submitted
if (isset($_POST['send']) && isset($_POST['desc']))
{
    $filename = $_FILES['filename']['name'];

    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'ppt', 'xls'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            // get last record id
            $sql = 'select max(material_id) as material_id from material';
            $result = mysqli_query($conn, $sql);
            if (count($result) > 0)
            {
                $row = mysqli_fetch_array($result);
                $filename = ($row['material_id']+1) . '-' . $filename;
            }
            else
                $filename = '1' . '-' . $filename;

            //set target directory
            $path = 'materials/';

            $desc = $_POST['desc'];
            $created = @date('Y-m-d H:i:s');
            move_uploaded_file($_FILES['filename']['tmp_name'],($path . $filename));
            
            // insert file details into database
            $sql = "INSERT INTO `material`(`material_desc`, `file`, `course_id`, `level`) 
            VALUES ('$desc','$filename','2', '100 Level')";
            mysqli_query($conn, $sql);
            header("Location: posting.php?st=success");
        }
        else
        {
            header("Location: posting.php?st=error");
        }
    }
    else
        header("Location: posting.php");
}
?>