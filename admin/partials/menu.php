<!-- database connection credentials from config/constants.php -->
<?php
    include("../config/constants.php");
    include('login_check.php');
?>



<!-- ===========================MENU SECTION START=========================== -->
<div class="menu">
        <div class="wrapper">
            <ul>
                <!-- <li><a href="home.php">Home</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="item.php">Item</a></li>
                <li><a href="order.php">Order</a></li>
                <li class="logout"><a href="logout.php">Logout</a></li> -->

                <li <?php if (strpos($_SERVER['REQUEST_URI'], '/home.php') !== false) echo 'class="active"'; ?>><a href="home.php">Home</a></li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], '/admin.php') !== false) echo 'class="active"'; ?>><a href="admin.php">Admin</a></li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], '/category.php') !== false) echo 'class="active"'; ?>><a href="category.php">Category</a></li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], '/item.php') !== false) echo 'class="active"'; ?>><a href="item.php">Item</a></li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], '/order.php') !== false) echo 'class="active"'; ?>><a href="order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
<!-- ===============================MENU SECTION END================================ -->