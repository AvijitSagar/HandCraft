<?php include("../config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin login</title>
    <?php include("partials/head.php") ?>
</head>
<body>
    <div class="main-content ">
        <div class="wrapper ">
            <h1 class="form-center">Admin Login</h1>
            <br><br>

            <!-- display session message -->
            <span class="form-center">
                <?php
                
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    if(isset($_SESSION['no_login_message'])){
                        echo $_SESSION['no_login_message'];
                        unset($_SESSION['no_login_message']);
                    }
                ?>
            </span>
            

            <br><br>
            <form action="" method="POST" class="form-center">
                <table class="tbl-30">
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="Username" id="" required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" placeholder="Password" id="" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <input type="submit" name="submit" value="Login" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- -------------footer include--------- -->
    <?php include("partials/footer.php"); ?>




    <?php
        //process the value from form 
        //check whether the button is clicked or not
        if(isset($_POST['submit'])){
            //button clicked

            // 1. get the data form form
            $username = $_POST["username"];
            $password = md5($_POST["password"]);//md5 is for encryption of the data

            //selecting username and password from 'admin_login' table
            // $sql = "SELECT username, password FROM admin_login";
            $sql = "SELECT * FROM admin_login WHERE username = '$username' AND password = '$password'";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //getting rows
            $count = mysqli_num_rows($res);

            //check whether the query is qexecuted or not
            if($count == 1){

                //user available and login success
                $_SESSION['login'] = "<div class = 'success'>Login success</div>";


                //authoraization or access control
                $_SESSION['user'] = $username; //to check whether the user is log in or not and logout will unset this sessio. this is for acess control or authentication. without login user cannot go to other pages with URL

                //redirect page to home
                header("location:". HOME_URL ."admin/home.php");


                }
                else{
                    //user unavailable and login success
                    $_SESSION['login'] = "<div class='error'>Login Failed. Either username or password incorrect</div>";
                    //redirect page to home
                    header("location:". HOME_URL . "admin/");
                }
            }
    ?>
</body>
</html>