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
            <br><br>

            <!-- admin added successfully message show -->
            <span class="form-center">
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //it will remove th emessagae after sometime
                    }
                ?>
            </span>
            <br><br>
            
            


            <!-- button to add admin -->
            <a href="add_admin.php" class="btn-primary">Add Admin</a>
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
                        $sn = 1; //create a variable to assign thevaalue.. etar sahajje amra DB te id er serial break ba delete holeo user ke serially sl_no dekhano jay
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
                                        <a href="#" class="btn-secondary">Update</a>
                                        <a href="#" class="btn-danger">Delete</a>
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