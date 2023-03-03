<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Admin</title>
    <?php include('partials/head.php'); ?>
</head>
<body>
    <!-- ------------menu include---------- -->
    <?php include("partials/menu.php"); ?>



    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br><br><br>


            <?php
                //get the id of the selected admin
                $id = $_GET['id'];

                //create sql query to get the details
                $sql = "SELECT * FROM tbl_admin WHERE id = $id";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //check whether the query is executed or not
                if($res == true){
                    //check whether the data is available or not
                    $count = mysqli_num_rows($res);
                    //check whether we have admin data or not
                    if($count == 1){
                        //show the details
                        // echo "admin available";
                        $rows = mysqli_fetch_assoc($res);
                        $full_name = $rows['fullname'];
                        $username = $rows['username'];
                    }
                    else{
                        //redirect page to admin
                        $_SESSION['admin_not_found'] = "<div class='error'>Admin not found</div>";
                        header("location: " . HOME_URL . "admin/admin.php");
                    }
                }


            ?>




            <form action="" method="POST" class="form-center">
                <table class="tbl-30">
                    <tr>
                        <td>FullName: </td>
                        <td>
                            <input type="text" name="full_name" id="" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" id="" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <a href="<?php echo HOME_URL; ?>admin/admin.php"><input class="btn-primary" type="button" value="cancel"></a>
                            <input type="submit" value="update admin" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>




    <?php
        if(isset($_POST['submit'])){
            // echo "clicked";
            //get all the value from form to update
            //preventing input from sqlinjectiion with mysqli_real_escape_string function
            $raw_id = $_POST['id'];
            $id = mysqli_real_escape_string($conn, $raw_id);

            $raw_full_name = $_POST['full_name'];
            $full_name = mysqli_real_escape_string($conn, $raw_full_name);

            $raw_username = $_POST['username'];
            $username = mysqli_real_escape_string($conn, $raw_username);

            //sql query to update admin
            $sql = "UPDATE tbl_admin SET fullname = '$full_name', username = '$username' WHERE id = $id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //check whether thhe query executed sucessfully or not
            if($res == true){
                //query executed and admin updated
                $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
                //redirect to admin page
                header("location: " . HOME_URL . "admin/admin.php");
            }
            else{
                //admin update failed
                $_SESSION['update'] = "<div class='error'>Admin update failed</div>";
            }

        }
    ?>

    
    <?php include('partials/footer.php'); ?>
</body>
</html>
