<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_start(); ?>  



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/head.php') ?>
    <title>Add category</title>
</head>
<body>
    <?php include('partials/menu.php') ?>



    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            
            <span class="form-center">
                <?php
                    if(isset($_SESSION['img_upload'])){
                        echo $_SESSION['img_upload'];
                        unset($_SESSION['img_upload']);
                    }
                ?>
            </span>

            <br><br>

            <!-- form start -->
            <form action="" method="POST" class="form-center" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Image:</td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="yes">Yes
                            <input type="radio" name="featured" value="no">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value=yes>Yes
                            <input type="radio" name="active" value=no>No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="<?php echo HOME_URL; ?>admin/category.php"><input class="btn-primary" type="button" value="cancel"></a>
                            <input type="submit" value="Add Category" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- form end -->



            <!-- add deta to database -->
            <?php
                if(isset($_POST['submit'])){
                    // echo "button clicked";
                    // 1. storing form values in variables
                    $raw_title = $_POST['title'];
                    $title = mysqli_real_escape_string($conn, $raw_title);




                    //for radio input we need to check whether the radio button is selected or not
                    //for featured
                    if(isset($_POST['featured'])){
                        //get the value from form
                        $featured = $_POST['featured'];
                    }
                    else{
                        //set the default value
                        $featured = "no"; // this "no" should be spelt as input field's value
                    }

                    //for active
                    if(isset($_POST['active'])){
                        //get the value from form
                        $active = $_POST['active'];
                    }
                    else{
                        //set the default value
                        $active = "no";
                    }

                    // 2. check whether the inputted category title exist or not in db
                    $sql = "SELECT * FROM tbl_category WHERE title='$title'";

                    // 3. execute the query
                    $res = mysqli_query($conn, $sql);

                    // 3. fetch the result
                    $count = mysqli_num_rows($res);

                    
                    // 4. check if the category exists or not
                    if($count > 0){ // jodi database a eki title theke thake tahole
                        // echo "title exists";
                        $_SESSION['add_category'] = "<div class='error'>Category already exists.</div>";
                        //redirect to category page
                        header("location: " . HOME_URL . "admin/category.php");
                    }
                    else{ //jodi database a eki title na theke thake tahole 


                        //process the image to upload
                        // check whether the image is selected or not and set the value for imagename accordingly
                        // print_r($_FILES['image']);
                        // die(); // break the code here
                        //jodi image er name property te kono value thake taholei kebol db te upload hobe else upload hobe na
                        if(isset($_FILES['image']['name'])){
                            //upload the image
                            //to upload the image we need image name source path and destination path
                            $image_name = $_FILES['image']['name']; //getting image name

                            //upload the image only if the image is selected
                            if($image_name != ""){
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
                                    header("location: " . HOME_URL . "admin/add_category.php");
                                    //stop the process
                                    die();
                                }
                            }

                        }
                        else{
                            //dont upload the image and set the image name value as blank
                            $image_name = "";
                        }



                        // echo "title not exist";
                        // 2. storing data into database
                        //sql query
                        $sql_2 = "INSERT INTO tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";

                        // 3. execute the query and save it in database
                        $res_2 = mysqli_query($conn, $sql_2);

                        // 4. check whether th equery executed or not and data inserted or not
                        if($res_2 == true){
                            //query executed and category added
                            // echo "excecuted";
                            $_SESSION['add_category'] = "<div class='success'>Category added</div>";
                            //redirect to category page
                            header("location: " . HOME_URL . "admin/category.php");
                        }
                        else{
                            //failed to add category
                            // echo "not executed";
                            $_SESSION['add_category'] = "<div class='error'>Can't add category</div>";
                            //redirect to category
                            header("location: " . HOME_URL . "admin/category.php");
                        }
                    }
                }
            ?>

        </div>
    </div>


    <?php include('partials/footer.php') ?>
    
</body>
</html>


<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_end_flush(); ?>