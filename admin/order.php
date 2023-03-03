<!DOCTYPE html>
<html lang="en">
<head>
    <!-- -----head include---- -->
    <?php include("partials/head.php"); ?>
    <title>Admin Order</title>
</head>
<body>
    <!-- ------------menu include--------- -->
    <?php include("partials/menu.php") ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            <br><br><br>
            <span class="form-center">
                <?php
                    if(isset($_SESSION['update_order'])){
                        echo $_SESSION['update_order'];
                        unset($_SESSION['update_order']);
                    }
                    if(isset($_SESSION['order_not_found'])){
                        echo $_SESSION['order_not_found'];
                        unset($_SESSION['order_not_found']);
                    }
                ?>
            </span>
            <br><br><br>
            <table class="tbl-full tbl-show">
                <tr>
                    <th>Sl</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

                <?php
                    //get all orders from db
                    //sql
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //descending order a show korbe jate latest order gula table er upore show kore
                    //execute
                    $res = mysqli_query($conn, $sql);
                    //count
                    $count = mysqli_num_rows($res);

                    $sn = 1;
                    //check data
                    if($count > 0){
                        //data available
                        //get all order
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $item = $rows['item'];
                            $price = $rows['price'];
                            $quantity = $rows['quantity'];
                            $total_price = $rows['total'];
                            $order_date = $rows['order_date'];
                            $status = $rows['status'];
                            $customer_name = $rows['customer_name'];
                            $customer_contact = $rows['customer_contact'];
                            $cuatomer_email = $rows['customer_email'];
                            $customer_address = $rows['customer_address'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $item; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $total_price; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        <?php
                                            //color changer for different status
                                            if($status == "ordered"){
                                                echo "<label>$status</label>";
                                            }
                                            elseif ($status == "on_delivery") {
                                                echo "<label style='color: orange;'>$status</label>";
                                            }
                                            elseif ($status == "delivered") {
                                                echo "<label style='color: green;'>$status</label>";
                                            }
                                            elseif ($status == "cancelled") {
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    
                                    <td><?php echo $customer_name; ?></td>
                                    <td style=" color:blue;"><?php echo $customer_contact; ?></td>
                                    <td><?php echo $cuatomer_email; ?></td>
                                    <td>
                                        <div class="scrollable">
                                            <?php echo $customer_address; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo HOME_URL; ?>admin/manage_order.php?id=<?php echo $id; ?>" class="btn-secondary">Status</a>
                                    </td>
                                </tr>
                            <?php
                        }

                    }
                    else{
                        //data unavailable
                        echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>


    <!-- -------------include footer--------- -->
    <?php include("partials/footer.php"); ?>
</body>
</html>