<!DOCTYPE html>
<html lang="en">
<head>
    <!-- -----head include---- -->
    <?php include("partials/head.php"); ?>
    <title>Admin Admin</title>
</head>
<body>
    <!-- ------------menu include--------- -->
    <?php include("partials/menu.php") ?>



    <!-- ============================MAIN SECTION START================================= -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Admin</h1>
            <br><br><br>

            <a href="add_admin.php" class="btn-primary">Add Admin</a>
            <!-- admin added successfully message show -->
            <span class="form-center">
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //it will remove th emessagae after sometime
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user_not_found'])){
                        echo $_SESSION['user_not_found'];
                        unset($_SESSION['user_not_found']);
                    }
                    
                    if(isset($_SESSION['password_not_match'])){
                        echo $_SESSION['password_not_match'];
                        unset($_SESSION['password_not_match']);
                    }

                    if(isset($_SESSION['password_changed'])){
                        echo $_SESSION['password_changed'];
                        unset($_SESSION['password_changed']);
                    }
                ?>
            </span>
            


            <!-- button to add admin -->
            <!-- <a href="add_admin.php" class="btn-primary">Add Admin</a> -->
            <br><br><br>
            <table class="tbl-full">
                <tr>
                    <th>Sl.No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_admin";
                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check whether the query is qexecuted or not
                    if($res == true){
                        //count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res);
                        $sn = 1; //create a variable to assign the vaalue.. etar sahajje amra DB te id er serial break ba delete holeo user ke serially sl_no dekhano jay
                                //ebar amader table a id er jaygay $sn++ dilei hobe
                        //check the number of rows
                        if($count > 0){
                            //we have data in database
                            while($rows = mysqli_fetch_assoc($res)){
                                //using while loop to get all data from database
                                //while loop will run as long as we have data in database

                                //get individual data
                                $id = $rows['id'];
                                $fullname = $rows['fullname'];
                                $username = $rows['username'];

                                //display the values in our table
                                //broke php to show data
                                ?> 

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo HOME_URL; ?>admin/update_admin_password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo HOME_URL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo HOME_URL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                
                                <?php
                                //joint broken php
                            }
                        }
                        else{
                            //we do not have any database
                        }
                    }
                ?>

            </table>

            <!-- <div class="clearfix"></div> -->
        </div>
    </div>
    <!-- ==============================MAIN SECTION END============================== -->


    <!-- -----------footer include----------- -->
    <?php include("partials/footer.php") ?>

</body>
</html>