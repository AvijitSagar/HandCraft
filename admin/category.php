<!DOCTYPE html>
<html lang="en">
<head>
    <!-- -----head include---- -->
    <?php include("partials/head.php"); ?>
    <title>Admin Category</title>
</head>
<body>
    <!-- ------------menu include--------- -->
    <?php include("partials/menu.php") ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br><br><br>
            <!-- button to add category -->
            <a href="<?php echo HOME_URL; ?>admin/add_category.php" class="btn-primary">Add Category</a>
            <span class="form-center">
                <?php
                    if(isset($_SESSION['add_category'])){
                        echo $_SESSION['add_category'];
                        unset($_SESSION['add_category']);
                    }
                    
                    if(isset($_SESSION['delete_category'])){
                        echo $_SESSION['delete_category'];
                        unset($_SESSION['delete_category']);
                    }

                    if(isset($_SESSION['remove_image'])){
                        echo $_SESSION['remove_image'];
                        unset($_SESSION['remove_image']);
                    }

                    if(isset($_SESSION['category_not_found'])){
                        echo $_SESSION['category_not_found'];
                        unset($_SESSION['category_not_found']);
                    }

                    if(isset($_SESSION['category_updated'])){
                        echo $_SESSION['category_updated'];
                        unset($_SESSION['category_updated']);
                    }

                    if(isset($_SESSION['img_upload'])){
                        echo $_SESSION['img_upload'];
                        unset($_SESSION['img_upload']);
                    }
                ?>
            </span>
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //query to get all category from db
                    $sql = "SELECT * FROM tbl_category";

                    //exeute the query
                    $res = mysqli_query($conn, $sql);

                    //$count rows
                    $count = mysqli_num_rows($res);

                    //create serial number variable and assign value to 1
                    $sn = 1;

                    //check whether we have data in db or not
                    if($count > 0){
                        //we have data in db
                        //get the data and display 
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>

                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td><?php echo $title ?></td>

                                    <td>
                                        <?php
                                            //check whether image name is available or not
                                            if($image_name != ""){
                                                //display the image
                                                //break php to show
                                                ?>
                                                    <img src="<?php echo HOME_URL; ?>/img/category/<?php echo $image_name; ?>" width="100px" height="50px">
                                                <?php
                                            }
                                            else{
                                                // display the message
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <!-- passing the id through the URL which should be updated  -->
                                        <a href="<?php echo HOME_URL; ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <!-- passing the id and image_name through the URL which should be deleted  -->
                                        <a href="<?php echo HOME_URL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else{
                        //we dont have data in db
                        //we will show the message in the table
                        //so we have to break the php code so that we can write html code insile the fragment
                        ?> 
                            <tr>
                                <td colspan="6">
                                    <div class="error">No Category found</div>
                                </td>
                            </tr>
                        <?php
                    }
                    
                ?>

                
                
            </table>
        </div>
    </div>


    <!-- -------------include footer--------- -->
    <?php include("partials/footer.php"); ?>
</body>
</html>