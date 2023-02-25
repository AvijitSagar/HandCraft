<!DOCTYPE html>
<html lang="en">
<head>
    <!-- -----head include---- -->
    <?php include("partials/head.php"); ?>
    <title>Admin Item</title>
</head>
<body>
    <!-- ------------menu include--------- -->
    <?php include("partials/menu.php") ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Items</h1>
            <br><br>

            <span class="form-center">
                <?php
                    //display session message
                    if(isset($_SESSION['item_data_inserted'])){
                        echo $_SESSION['item_data_inserted'];
                        unset($_SESSION['item_data_inserted']);
                    }

                    if(isset($_SESSION['remove_item_image'])){
                        echo $_SESSION['remove_item_image'];
                        unset($_SESSION['remove_item_image']);
                    }

                    if(isset($_SESSION['admin_item_delete'])){
                        echo $_SESSION['admin_item_delete'];
                        unset($_SESSION['admin_item_delete']);
                    }

                    if(isset($_SESSION['item_not_found'])){
                        echo $_SESSION['item_not_found'];
                        unset($_SESSION['item_not_found']);
                    }

                    if(isset($_SESSION['image_remove_failed_updating_item'])){
                        echo $_SESSION['image_remove_failed_updating_item'];
                        unset($_SESSION['image_remove_failed_updating_item']);
                    }

                    if(isset($_SESSION['item_updated'])){
                        echo $_SESSION['item_updated'];
                        unset($_SESSION['item_updated']);
                    }
                ?>
            </span>
            

            <br><br>
            <!-- button to add admin -->
            <a href="<?php echo HOME_URL; ?>admin/add_item.php" class="btn-primary">Add Item</a>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Catrgory</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>



                <?php
                    //to display items in table
                    // 1. sql query to get all items from DB
                    $sql = "SELECT * FROM tbl_item";
                    // 2. run the query
                    $res = mysqli_query($conn, $sql);
                    // 3. getting rows
                    $count = mysqli_num_rows($res);
                    //creating serial number
                    $sn = 1;
                    // 4. check if there is any dada in database
                    if($count > 0){
                        //we have data in db
                        //get the data
                        while($rows = mysqli_fetch_assoc($res)){
                            //get the values from each columns
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            $category = $rows['category_id'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];

                            
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <div class="scrollable">
                                            <?php echo $description; ?>
                                        </div>
                                    </td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            //check whether we have any image or not
                                            if($image_name == ""){
                                                //we do not have any image
                                                //display error message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                            else{
                                                //we have image to display
                                                ?>
                                                    <img src="<?php echo HOME_URL; ?>img/item/<?php echo $image_name; ?>" width="100px" height="50px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $category; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <!-- passing the id which should be updated -->
                                        <a href="<?php echo HOME_URL; ?>admin/update_item.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <!-- passing the id and the image name which should be deleted -->
                                        <a href="<?php echo HOME_URL; ?>admin/delete_item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else{
                        //we have no data in db
                        //show messege
                        echo "<tr><td colspan='7' class='error'>You have no data in item</td></tr>";
                    }
                ?>



                
            </table>
        </div>
    </div>


    <!-- -------------include footer--------- -->
    <?php include("partials/footer.php"); ?>
</body>
</html>