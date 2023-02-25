<!DOCTYPE html>
<html lang="en">
<head>
    <!-- -----head include---- -->
    <?php include("partials/head.php"); ?>
    <title>Admin Home</title>
</head>
<body>
    <!-- ------------menu include---------- -->
    <?php include("partials/menu.php"); ?>



    <!-- ============================MAIN SECTION START================================= -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>

            <span class="form-center">
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
            </span>
            
            <br><br>
            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                categories
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- ==============================MAIN SECTION END============================== -->


    <!-- -------------footer include--------- -->
    <?php include("partials/footer.php"); ?>

</body>
</html>