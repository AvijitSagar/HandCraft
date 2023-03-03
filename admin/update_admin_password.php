<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Admin Password</title>
    <?php include('partials/head.php'); ?>
</head>
<body>
    <?php include('partials/menu.php'); ?>
    
    <div class="main-content">
        <div class="wrapper">
            <h1>Change Admin Password</h1>
            <br><br><br>

            <!-- to get the relavant id and password from table -->
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>


            <br><br><br>
            <form action="" class="form-center" method="POST" >
                <table class="tbl-30">
                    <tr>
                        <td>Current Password</td>
                        <td>
                            <input type="password" name="current_password" id="" placeholder="Enter your current password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td>
                            <input type="password" name="new_password" id="" placeholder="Enter new password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="confirm_password" id="" placeholder="Confirm new password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <a href="<?php echo HOME_URL; ?>admin/admin.php"><input class="btn-secondary" type="button" value="cancel"></a>
                            <input type="submit" value="change password" name="submit" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>


    <?php
        //check whether the update button clicked or not
        if(isset($_POST['submit'])){
            // echo "clicked";
            // 1. get the data from form

            //preventing sql injection with mysqli_real_escape_string function
            $raw_id = $_POST['id'];
            $id = mysqli_real_escape_string($conn, $raw_id);

            $raw_current_password = md5($_POST['current_password']);
            $current_password = mysqli_real_escape_string($conn, $raw_current_password);

            $raw_new_password = md5($_POST['new_password']);
            $new_password = mysqli_real_escape_string($conn, $raw_new_password);

            $raw_confirm_password = md5($_POST['confirm_password']);
            $confirm_password = mysqli_real_escape_string($conn, $raw_confirm_password);

            // 2. check whether the user with current id and password exist or not
            $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

            //execute the equery
            $res = mysqli_query($conn, $sql);
            if($res == true){
                //check if the data is available or not
                $count = mysqli_num_rows($res);

                if($count == 1){
                    //user exist password can be changed
                    // echo "user found";
                    //check if the new pass and confirm pass match
                    if($new_password == $confirm_password){
                        //update the password
                        $sql_2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                        //execute the query
                        $res_2 = mysqli_query($conn, $sql_2);

                        //check whether the query executed or not
                        if($res_2 == true){
                            //success message
                            $_SESSION['password_changed']="<div class='success'>Password changed successfully</div>";
                            //redirect to admin page
                            header("location: " . HOME_URL . "admin/admin.php");
                        }
                        else{
                            //error message
                            $_SESSION['password_changed']="<div class='error'>Failed to change password</div>";
                            //redirect to admin page
                            header("location: " . HOME_URL . "admin/admin.php");
                        }
                    }
                    else{
                        $_SESSION['password_not_match'] = "<div class='error'>Password did not match</div>";
                        header("location: " . HOME_URL . "admin/admin.php");
                    }

                }
                else{
                    //user doesnot exist
                    //resirect to admin
                    $_SESSION['user_not_found'] = "<div class='error'>Admin update failed. Admin not found</div>";
                    header("location: " . HOME_URL . "admin/admin.php");
                }
            }

            // 3. check whether the new password and confirm password match or not

            // 4. update the password if all logic is true

        }
    ?>

</body>
</html>