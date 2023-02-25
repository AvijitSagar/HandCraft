<?php
    include('../config/constants.php');
    //get the id of the admin which will be deleted;
    echo  $id = $_GET['id'];
    //sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query successfully executed or not
    if($res == true){
        //echo "admin deleted";
        //echo "admin not deleted";
        //create session message to display message
        $_SESSION['delete'] = "<div class='success'>Admin deleted sucessfully </div>";
        //redirect to admin page
        header("location: " . HOME_URL . "admin/admin.php");
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
        header("location: " . HOME_URL . "admin/admin.php");
    }
?>