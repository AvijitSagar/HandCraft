<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/head.php'); ?>
    <title>Update Category</title>
</head>
<body>
    <?php include('partials/menu.php'); ?>

    

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br><br>


            <?php
            

                //check whether the id is selected or not
                if(isset($_GET['id'])){
                    //get the id of the selected category
                    $id = $_GET['id'];

                    //create sql query to get the category details
                    $sql = "SELECT * FROM tbl_category WHERE id = $id";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check whether the query is executed or not
                    /////////////////// this is also for validatiuon... jate keu address bar a jeye id pass kore page access korte na pare
                    if($res == true){
                        //check whether the data is available or not
                        $count = mysqli_num_rows($res);
                        //check whether we have any category data or not
                        if($count == 1){
                            //show the details
                            // echo "category available";
                            //get all rows from the table and store in rows array
                            $rows = mysqli_fetch_assoc($res);

                            //storing row array data in variables
                            $title = $rows['title'];
                            $current_image = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                        }
                        else{
                            //sesson message
                            $_SESSION['category_not_found'] = "<div class='error'>Category not found</div>";
                            //redirect page to category
                            header("location: " . HOME_URL . "admin/category.php");
                        }
                    }
                }
                else{
                    //redirect to category page
                    header("location: " . HOME_URL . "admin/category.php");
                }

            ?>





            <!-- form start -->
            <form action="" method="POST" class="form-center" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title" value="<?php echo $title ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image != ""){
                                    //show the image
                                    //breaking php to display image in html tag
                                    ?>
                                        <img src="<?php echo HOME_URL; ?>/img/category/<?php echo $current_image; ?>" width="100px" height="50px">
                                    <?php
                                }
                                else{
                                    //error message
                                    echo "<div class='error'>Image is not added yet</div>";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Change or add image:</td>
                        <td>
                            <input type="file" name="image" value="<?php echo $image_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <!-- showing the yes or no button selected or not with "checked" -->
                            <input <?php if($featured == "yes"){ echo "checked"; } ?> type="radio" name="featured" value="yes">Yes
                            <input <?php if($featured == "no"){ echo "checked"; } ?> type="radio" name="featured" value="no">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <!-- showing the yes or no button selected or not with "checked" -->
                            <input <?php if($active == "yes"){ echo "checked"; } ?> type="radio" name="active" value=yes>Yes
                            <input <?php if($active == "no"){ echo "checked"; } ?> type="radio" name="active" value=no>No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <a href="<?php echo HOME_URL; ?>admin/category.php"><input class="btn-primary" type="button" value="Cancel"></a>
                            <input type="submit" value="Update" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- form end -->




            <?php

                if(isset($_POST['submit'])){
                    // echo "clicked";
                    // 1. get all the values from form to update db
                    $id = $_POST['id'];
                    $raw_title = $_POST['title'];
                    $title = mysqli_real_escape_string($conn, $raw_title);
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // 2. updating new image if selected
                    //check whether the image is selected or not
                    //jodi image select thake tahole r image upload korbe na r jodi select na kora thake tahole upload korbe
                    if(isset($_FILES['image']['name'])){
                        //get the image details
                        $image_name = $_FILES['image']['name'];

                        //check whether the image is available or not
                        //if image is available we will update the image and delete the previous one
                        if($image_name != ""){
                            //image is available
                            // A. upload the new image

                            //renaming the image name... karon eki image abar o upload dile ager image replace hoye jacche
                            //auto rename imaage
                            //get the extension of the image (jpg, png, etc)
                            $extension = end(explode('.', $image_name));//this will break the image name from dot(.) and get the extension

                            //rename the image
                            $image_name = "item_category_" . rand(000, 999) . "." . $extension; //this will do this... example: item_category_100.jpg
                            
                            $source_path = $_FILES['image']['tmp_name']; //getting source path
                            $destination_path = "../img/category/" . $image_name; //declaring the destination path and get the image_name. here the destination path is image > category. so first we have to go back to main directory from admin folder and go to img and then category folder. and then concatenate the image_name

                            //upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            // check whether the image is uploaded or not
                            //if the image is not uploaded then we will stop process and redirect with error message
                            if($upload == false){
                                //set message
                                $_SESSION['img_upload'] = "<div class='error'>Failed to upload image</div>";
                                //redirect to add category page
                                header("location: " . HOME_URL . "admin/category.php");
                                //stop the process
                                die();
                            }


                            // B. remove the current image
                            if($current_image != ""){
                                //declaring the image path which will be deleted
                                $remove_path = "../img/category/" . $current_image;

                                //remove the image
                                $remove = unlink($remove_path);

                                //check whether the image is removed or not
                                //if failed to remove then show the session message and stop the process
                                if($remove == false){
                                    //failed to remove the image
                                    $_SESSION['image_remove_failed_updating_category'] = "<div class='error'>Failed to remove image</div>";

                                    //redirect
                                    header("location: " . HOME_URL . "admin/category.php");

                                    //stop the process
                                    die();
                                }
                            }

                        }
                        else{
                            //our image name will be current_image name
                            $image_name = $current_image;

                        }
                    }
                    else{
                        $image_name = $current_image;
                    }

                    // 3. update the database
                    //sql query to update category
                    $sql_2 = "UPDATE tbl_category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE id = $id ";
                    //execute the query
                    $res_2 = mysqli_query($conn, $sql_2);
                    //check if the query executed or not
                    if($res_2 == true){
                        //query executed and category updated
                        $_SESSION['category_updated'] = "<div class='success'>Category updated successfully</div>";
                        //redirect to category page
                        header("location: " . HOME_URL . "admin/category.php");
                    }
                    else{
                        //failed to update category
                        $_SESSION['category_updated'] = "<div class='error'>Failed to update category</div>";
                        // redirect to category page
                        header("location: " . HOME_URL . "admin/category.php");
                    }

                }

            ?>
            
        </div>
    </div>

    


    <?php include('partials/footer.php') ?>
</body>
</html>