<?php
    include('../config/constants.php');

    //check whether the id and image name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //get the value and delete
        //get the relavant item id and image name which should be deleted
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != ""){
            //image is available, remove it
            $path = "../img/item/" . $image_name;
            $remove = unlink($path);

            //if failed to remove image
            if($remove == false){
                //message
                $_SESSION['remove_item_image'] = "<div class='error'>Failed to remove item image from folder</div>";
                //redirect
                header("location: " . HOME_URL . "admin/item.php");
                //stop the process
                // die();
            }
        }

        //sql query to delete admin
        $sql = "DELETE FROM tbl_item WHERE id = $id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query executed or not
        if($res == true){
            //items deleted from DB
            //show session message
            $_SESSION['admin_item_delete'] = "<div class='success'>Item deleted successfully</div>";
            //redirect
            header("location: " . HOME_URL . "admin/item.php");
        }
        else{
            //failed to delete item from DB
            //show message
            $_SESSION['admin_item_delete'] = "<div class='error'>Failed to delete item</div>";
            // redirect
            header("location: " . HOME_URL . "admin/item.php");
        }

    }
    else{
        //redirect to the item page
        header("location: " . HOME_URL . "admin/item.php");
    }

?>