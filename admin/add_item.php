<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_start(); ?>  







<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/head.php'); ?>
    <title>Add Items</title>
</head>
<body>
    <?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Items</h1>
            <br><br>


            <span class="form-center">
                <?php
                    if(isset($_SESSION['upload_item_image'])){
                        echo $_SESSION['upload_item_image'];
                        unset($_SESSION['upload_item_image']);
                    }
                ?>
            </span>
            



            <br><br>
            <form action="" method="POST" enctype="multipart/form-data" class="form-center">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the item">
                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Description of the item"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="number" name="price" value= 10 min="10" max="1000000">
                        </td>
                    </tr>

                    <tr>
                        <td>Selece image</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <!-- we have to show all category from the database -->
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">

                                <?php
                                    //create php code to display categories from DB
                                    // 1. create sql to get all active categories from tbl_category
                                    $sql = "SELECT * FROM tbl_category WHERE active = 'yes'";
                                    //executing the query
                                    $res = mysqli_query($conn, $sql);
                                    //count rows to check whether we have caregories or not
                                    $count = mysqli_num_rows($res);
                                    //if $count is > 0 we have categories. else we have no categories
                                    if($count > 0){
                                        //we have category
                                        //while loop to get all the category from DB
                                        while($rows = mysqli_fetch_assoc($res)){
                                            //get the details from category
                                            $id = $rows['id'];
                                            $title = $rows['title'];
                                            //break the php code to show select category options vale dynamically from the tbl_
                                            ?>
                                                <option value="<?php echo $id; ?>">
                                                    <?php echo $title; ?>
                                                </option>
                                            <?php
                                        }
                                    }
                                    else{
                                        //we do not have category
                                        ?>
                                            <option value="0">No category found</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="yes">Yes
                            <input type="radio" name="featured" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="yes">Yes
                            <input type="radio" name="active" value="no"> No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <a href="<?php echo HOME_URL; ?>admin/item.php"><input type="button" value="Cancel" class="btn-primary"></a>
                            <input type="submit" value="Add item" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>




            <?php
                //for insert data from form into DB
                //check whether the button is clicked or not
                if(isset($_POST['submit'])){
                    // echo "button clicked";
                    //add items in database
                    // 1. get the data from form

                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    //for feature and active we have to first check if the radio button is mark as checked or not
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }
                    else{
                        $featured = "no"; //setting the default value
                    }


                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }
                    else{
                        $active = "no"; //setting the default value
                    }
                    
                    

                    // 2. upload the image if selected 
                    //check whether the select image button is clicked or not. only when the button is clicked then upload the image into DB
                    if(isset($_FILES['image']['name'])){
                        //get the details of the selected image
                        $image_name = $_FILES['image']['name'];

                        //check whether the image is selected or not and upload the image if selected
                        if($image_name != ""){
                            //image is selected
                            // A. rename the image
                            //get the extensions of the selected image (jpg, png etc)
                            $explode = explode('.', $image_name);
                            $extension = end($explode); //this will only gaet the last part of the dot(.)

                            //create new name for image
                            $image_name = "item_name_" . rand(000, 999) . "." . $extension;
                            
                            // echo $image_name;
                            // B. upload the image
                            //get the source path and the destination path

                            //source path is the current location of the image
                            $src = $_FILES['image']['tmp_name']; //getting source path

                            //destination path for the images to be uploaded
                            $dst = "../img/item/" . $image_name;

                            //finally upload the item image
                            $upload = move_uploaded_file($src, $dst);

                            //check whether the image is uploaded or naot
                            if($upload == false){
                                //failed to upload the image
                                //redirect to add_item page with session message
                                $_SESSION['upload_item_image'] = "<div class='error'>Failded to upload the item image</div>";
                                header("location: " . HOME_URL . "admin/add_item.php");
                                //stop the process
                                die();
                            }
                        }

                    }
                    else{
                        //set the default value as blank
                        $image_name = "";
                    }


                    // 3. insert the data from form into DB
                    //create the sql query to add the data into DB
                    //sdql query te number value quatation er moddhe rakhte hoy nas... sudhu string value quatation er moddhe rakhte hoy
                    $sql_2 = "INSERT INTO tbl_item SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'";

                    // $sql_2 = "INSERT INTO tbl_item(title, description, price, image_name, category_id, featured, active) VALUES ('$title', '$description', $price, '$image_name', $category, '$featured', '$active')";
                    //execute the query
                    $res_2 = mysqli_query($conn, $sql_2);

                    // 4. redirtect with session message
                    //check if the data is inserted or not
                    if($res_2 == true){
                        //data is inserted
                        $_SESSION['item_data_inserted'] = "<div class='success'>Item inserted successfully</div>";
                        //redirect to item page
                        header("location: " . HOME_URL . "admin/item.php");
                    }
                    else{
                        //data is not inserted
                        $_SESSION['item_data_inserted'] = "<div class='error'>Failed to upload item data into DB</div>";
                        //redirect to item page
                        header("location: " . HOME_URL . "admin/item.php");
                    }
                
                }
            ?>







        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>
</html>

<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_end_flush(); ?>