<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_start(); ?>  




<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/head.php') ?>
    <title>Update Item</title>
</head>
<body>
    <?php include('partials/menu.php') ?>
    
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Item</h1>
            <br><br>


            <?php
                //check whether the item id is selected or not by the update button of the item.php page
                if(isset($_GET['id'])){
                    //getting id ftom item page
                    // 1. store the id in a variable which we got from the item page 
                    $id = $_GET['id'];
                    // 2. sql query to get all data of the item with the id we got
                    $sql = "SELECT * FROM tbl_item WHERE id = $id";
                    // 3. executing the query
                    $res = mysqli_query($conn, $sql);
                    // 4. check if the sql is executed or not
                    /////////////////// this is also for validatiuon... jate keu address bar a jeye id pass kore page access korte na pare
                    if($res == true){
                        // 5. check whether the data is available or not
                        $count = mysqli_num_rows($res);
                        if($count == 1){
                            //item available. show details
                            // echo "item found";
                            // 5. get all rows from item teble and store them in a array variable
                            $rows = mysqli_fetch_assoc($res);
                            // 6. storing row data in individual variables
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $current_image = $rows['image_name'];
                            $current_category = $rows['category_id'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                            
                        }
                        else{
                            //no data available
                            //session message
                            $_SESSION['item_not_found'] = "<div class='error'>Item not found</div>";
                            //redirect to item page
                            header("location: " . HOME_URL . "admin/item.php");
                        }
                        
                    }
                    
                }
                else{
                    //not getting id from item page
                    //redirect to the item page
                    header("location: " . HOME_URL . "admin/item.php");
                }
            ?>


            <!-- form start -->
            <form action="" method="POST" class="form-center" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>title</td>
                        <td>
                            <input type="text" name="title" placeholder="Item Title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image</td>
                        <td>
                            <?php
                                //if there is any current image then show it
                                if($current_image != ""){
                                    //show image
                                    ?>
                                        <img src="<?php echo HOME_URL; ?>img/item/<?php echo $current_image; ?>" width="100px" height="50px">
                                    <?php
                                }
                                else{
                                    //no fimage found
                                    echo "<div class='error'>image is not added yet</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Change or add image</td>
                        <td>
                            <input type="file" name="image" value="<?php echo $image_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                                <?php
                                    //query for active categories
                                    $sql_3 = "SELECT * FROM tbl_category WHERE active = 'yes'"; 
                                    //execute
                                    $res_3 = mysqli_query($conn, $sql_3);
                                    //count
                                    $count_3 = mysqli_num_rows($res_3);
                                    //check
                                    if($count_3 > 0){
                                        //category available
                                        while($rows_3 = mysqli_fetch_assoc($res_3)){
                                            $category_title = $rows_3['title'];
                                            $category_id = $rows_3['id'];

                                            // tag break
                                            ?>
                                                <option <?php if($current_category == $category_id){ echo "selected"; } ?> value="<?php echo $category_id; ?>">
                                                    <?php echo $category_title; ?>
                                                </option>
                                            <?php
                                        }

                                    }
                                    else{
                                        //category not available
                                        //nicher line take amra uporer while loop er moto php tag break koreo likhte partam. jehetu eita ek line er code tai amra php er moddhei html tag use korechi. evabeo kaj hobe
                                        echo "<option value='0'>Category not available</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured == "yes"){ echo "checked"; } ?> type="radio" name="featured" value="yes">Yes
                            <input <?php if($featured == "no"){ echo "checked"; } ?> type="radio" name="featured" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active</td>
                        <td>
                            <input <?php if($active == "yes"){ echo "checked"; } ?> type="radio" name="active" value="yes">Yes
                            <input <?php if($active == "no"){ echo "checked"; } ?> type="radio" name="active" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <a href="<?php echo HOME_URL; ?>admin/item.php"><input type="button" value="Cancel" class="btn-primary"></a>
                            <input type="submit" value="Update" name="submit" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            <!-- form end -->


            <?php
                //check if the button is clicked or not
                if(isset($_POST['submit'])){
                    // 1. get the form values to update the item
                    $id = $_POST['id'];

                    //sql injection prevention
                    $raw_title = $_POST['title'];
                    $title = mysqli_real_escape_string($conn, $raw_title);
                    $raw_description = $_POST['description'];
                    $description = mysqli_real_escape_string($conn, $raw_description);

                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // 2. updating new image if selected
                    //check whether the image is selected or not
                    if(isset($_FILES['image']['name'])){
                        //get the image details
                        $image_name = $_FILES['image']['name'];
                        //check whether the image is available or not
                        if($image_name != ""){
                            //image available
                            //upload the new image
                            //renaming image name... karon eki image abar upload dile ager image replace houe jacche
                            //get the extension of the image
                            $explode = explode('.',$image_name);
                            $ext = end($explode);
                            //rename image
                            $image_name = "item_name_" . rand(000, 999) . "." . $ext;

                            //upload the image
                            //get the source name and the destination name

                            //source path is the current path of the image
                            $src = $_FILES['image']['tmp_name'];

                            //destination for the image where it should be uploaded
                            $dst = "../img/item/" . $image_name;

                            //upload the image
                            $upload = move_uploaded_file($src, $dst);

                            //check whether the image is uploaded or not
                            //if image is not uploaded then we will stop the process with error message
                            if($upload == false){
                                //error message
                                $_SESSION['update_item_image'] = "<div class='error'>Failed to update item image</div>";
                                //redirect to item page
                                header("location: " . HOME_URL . "admin/item.php");
                                //stop process
                                die();
                            }

                            //remove current image from the folder
                            //check whether there is any cureent_image or not
                            if($current_image != ""){
                                //remove the image from folder
                                //declaring the image path which will be deleted
                                $remove_path = "../img/item/" . $current_image;
                                //remove the image
                                $remove = unlink($remove_path);
                                //check if the image is really removed or not
                                //if failed to remove then show the session message and stop the process
                                if($remove == false){
                                    //failed to remove the message
                                    //session message
                                    $_SESSION['image_remove_failed_updating_item'] = "<div class='error'>Failed to remove the image</div>";
                                    //redirect to item page
                                    header("location: " . HOME_URL . "admin/item.php");
                                    //stop the process
                                    die();
                                }
                            } 

                        }
                        else{
                            //image unavailable
                            $image_name = $current_image;
                        }
                    }
                    else{
                        $image_name = $current_image;
                    }


                    //updating the database
                    //sql query to update db
                    $sql_2 = "UPDATE tbl_item SET 
                        title = '$title', 
                        description = '$description', 
                        price = $price, 
                        image_name = '$image_name', 
                        category_id = '$category', 
                        featured = '$featured', 
                        active = '$active'
                        WHERE id = $id
                    ";

                    //execute the sql 
                    $res_2 = mysqli_query($conn, $sql_2);

                    //check whether the query is executed or not
                    if($res_2 == true){
                        //data updated
                        //session message
                        $_SESSION['item_updated'] = "<div class='success'>Item successfully updated</div>";
                        //redirect to item page
                        header("location: " . HOME_URL . "admin/item.php");
                    }
                    else{
                        //data not updated
                        //session message
                        $_SESSION['item_updated'] = "<div class='error'>Failed to update the item</div>";
                        //redirect to item page
                        header("location: " . HOME_URL . "admin/item.php");
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