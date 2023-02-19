<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("partials/head.php") ?>
    <title>Add Admin</title>
</head>
<body>
    <?php include("partials/menu.php") ?>

    <div class="main-content ">
        <div class="wrapper ">
            <h1 class="form-center">Add Admin</h1>
            <br><br>


            <!-- display session message -->
            <span class="form-center">
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
            </span>


            <br><br><br>
            <form action="" method="POST" class="form-center">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" id="" placeholder="Enter Your Full Name" required></td>
                    </tr>
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
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include("partials/footer.php") ?>



    <?php

        //process the value from form and save it into database
        //check whether the button is clicked or not
        if(isset($_POST['submit'])){
            //button clicked
            // echo("clicked");

            // 1. get the data form form
            $full_name = $_POST["full_name"];
            $username = $_POST["username"];
            $password = md5($_POST["password"]);//md5 is for encryption of the data
            // echo $full_name, $username, $password;


            // 2. sql query to save the data to database
            // $sql = INSERT INTO tbl_admin SET
            $sql = "INSERT INTO tbl_admin (fullname, username, password) VALUES ('$full_name', '$username', '$password')";
            // echo $sql;

            // 3. execute sql query and insert data into database
            //this part gone to config/constants.php file and this part  will be included in partials/menu.php  because our all page have the menu page included already. go checkou menu.php in partials folder
            // $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); //this is database connection
            // $db_select = mysqli_select_db($conn, 'handcraft') or die(mysqli_error()); //connect to the correspondent database

            // 4. execute sql query and insert data into database
            $res = mysqli_query($conn, $sql) or die(mysqli_error()); 
                                //mysqli_query executes our query if $res is true
                                //die(mysqli_error()) executes if $res is false
            
            // 5 . check whether the data is inserted in the database or not
            if($res == true){
                // echo "New admin has been created!";
                // 5. we will display the "new admin created successfully" by session
                // 6. session also created in constants.php file and will be included in the menu.php file as we did before for database connection
                // 7. creating a session variable to display message
                $_SESSION['add'] = "Admin addedd successfully";
                // 8. redirect page to manage admin
                header("location:". HOME_URL ."admin/admin.php"); //HOME_URL is the constant and we concatenate the last part of the page url
                                // 'http://localhost/php/HandCraft/' <-- this is HOME_URL and 'admin/admin.php' <-- this is the concatenated part
                                // after concatenation the address will be 'http://localhost/php/HandCraft/admin/admin.php' <-- which is our admin display address
                
            }
            else{
                // echo "Admin not created";
                $_SESSION['add'] = "Failed to add admin";
                // 9. redirect page to manage admin
                header("location:". HOME_URL ."admin/add_admin.php"); //HOME_URL is the constant and we concatenate the last part of the page url
                                // 'http://localhost/php/HandCraft/' <-- this is HOME_URL and 'admin/add_admin.php' <-- this is the concatenated part
                                // after concatenation the address will be 'http://localhost/php/HandCraft/admin/add_admin.php' <-- which is our add new admin address
            }
        }
    ?>


</body>
</html>