<?php
    include('../config/constants.php');



    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //get the value and delete
        

        //get relavant category id and image_name which should be deleted
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file from the img/category folder
        if($image_name != ""){
            //image is available so remove it
            $path = "../img/category/" . $image_name;

            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove == false){
                //session message
                $_SESSION['remove_image'] = "<div class='error'>Failed to remove category image from folder</div>";

                //redirect
                header("location: " . HOME_URL . "admin/category.php");
                
                //stop the process
                // die();
            }

        }

        //sql query to delete admin
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //checks if the query executed or not
        if($res == true){
            //delete the category
            // echo "category deleted";
            //create session message to display message
            $_SESSION['delete_category'] = "<div class='success'>Category deleted sucessfully</div>";
            //redirect to the category page
            header("location: " . HOME_URL . "admin/category.php");
        }
        else{
            //failed to delete the category
            $_SESSION['delete_category'] = "<div class='error'>Failed to delete category</div>";
            //redirect
            header("location: " . HOME_URL . "admin/category.php");

        }

    }
    else{
        //redirect to the category page
        header("location: " . HOME_URL . "admin/category.php");
    }


?>  