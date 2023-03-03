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
            <div class="col-4 text-center" id="bg-blue">
                <?php
                    $sql_category = "SELECT * FROM tbl_category";
                    $res_category = mysqli_query($conn, $sql_category);
                    $count_category = mysqli_num_rows($res_category);
                ?>
                <h1><?php echo $count_category; ?></h1>
                <br>
                categories
            </div>

            <div class="col-4 text-center home-item" id="bg-violet">
                <?php
                    $sql_item = "SELECT * FROM tbl_item";
                    $res_item = mysqli_query($conn, $sql_item);
                    $count_item = mysqli_num_rows($res_item);
                ?>
                <h1><?php echo $count_item; ?></h1>
                <br>
                Products
            </div>

            <div class="col-4 text-center home-order" id="bg-yellow">
                <?php
                    $sql_order = "SELECT * FROM tbl_order";
                    $res_order = mysqli_query($conn, $sql_order);
                    $count_order = mysqli_num_rows($res_order);
                ?>
                <h1><?php echo $count_order; ?></h1>
                <br>
                Total Orders
            </div>

            <div class="col-4 text-center" id="bg-red">
                <?php
                    //sql to get total revenue
                    //here we will use aggregate function
                    $sql_revenue = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='delivered'";
                    $res_revenue = mysqli_query($conn, $sql_revenue);
                    $rows_revenue = mysqli_fetch_assoc($res_revenue);
                    $total_revenue = $rows_revenue['Total'];
                ?>
                <h1><?php echo $total_revenue; ?> tk</h1>
                <br>
                Revenue
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- ==============================MAIN SECTION END============================== -->


    <!-- -------------footer include--------- -->
    <?php include("partials/footer.php"); ?>

</body>
</html>