<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_start(); ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("partials/head.php"); ?>
    <title>Manage Order</title>
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
                ?>
            </span>

            <br><br><br>
            <?php
                //check whether the id is set or not
                if(isset($_GET['id'])){
                    //getting id
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_order WHERE id = $id";
                    $res = mysqli_query($conn, $sql);
                    if($res == true){
                        $count = mysqli_num_rows($res);

                        if($count == 1){
                            //have data in db
                            $rows = mysqli_fetch_assoc($res);

                            $item = $rows['item'];
                            $price = $rows['price'];
                            $quantity = $rows['quantity'];
                            $total = $rows['total'];
                            $order_date = $rows['order_date'];
                            $status = $rows['status'];
                            $customer_name = $rows['customer_name'];
                            $customer_contact = $rows['customer_contact'];
                            $customer_email = $rows['customer_email'];
                            $customer_address = $rows['customer_address'];
                        }
                        else{
                            //product not found
                            $_SESSION['order_not_found'] = "<div class='error'>Order not found</div>";
                            header("location: " . HOME_URL . "admin/order.php");
                        }
                    }
                    
                }
                else{
                    //not getting id
                    header("location: " . HOME_URL . "admin/order.php");
                }
            ?>






            <form action="" method="POST" class="form-center">
                <table class="tbl-30">
                    <tr>
                        <td>Product Name:</td>
                        <td><?php echo $item; ?></td>
                    </tr>

                    <tr>
                        <td>Product Price:</td>
                        <td><?php echo $price; ?></td>
                    </tr>

                    <tr>
                        <td>Quantity:</td>
                        <td>
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Status:</td>
                        <td>
                            <select name="status" id="">
                                <option <?php if($status == "ordered"){ echo "selected"; } ?> value="ordered">Ordered</option>
                                <option <?php if($status == "on_delivery"){ echo "selected"; } ?> value="on_delivery">On Delivery</option>
                                <option <?php if($status == "delivered"){ echo "selected"; } ?> value="delivered">Delivered</option>
                                <option <?php if($status == "cancelled"){ echo "selected"; } ?> value="cancelled">Cancelled</option>]
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>
                            <!-- <input type="text" name="customer_name" value=""> -->
                            <?php echo $customer_name; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td>
                            <!-- <input type="text" name="customer_contact" value=""> -->
                            <?php echo $customer_contact; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td>
                            <!-- <input type="text" name="customer_email" value=""> -->
                            <?php echo $customer_email; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="customer_address" cols="30" rows="10"><?php echo $customer_address; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <a href="<?php echo HOME_URL; ?>admin/order.php"><input type="button" value="Cancel" class="btn-primary"></a>
                            <input type="submit" value="Update Order" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                //check if update button clicked or not
                if(isset($_POST['submit'])){
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];

                    $total = $price * $quantity;

                    $status = $_POST['status'];

                    // $customer_name = $_POST['customer_name'];
                    // $customer_contact = $_POST['customer_contact'];
                    // $customer_email = $_POST['customer_email'];

                    //sql injection prevent
                    $raw_customer_address = $_POST['customer_address'];
                    $customer_address = mysqli_real_escape_string($conn, $raw_customer_address);

                    //update the values
                    $sql_2 = "UPDATE tbl_order SET
                        quantity = $quantity,
                        total = $total,
                        status = '$status',
                        customer_address = '$customer_address'
                        WHERE id = $id
                    ";

                    $res_2 = mysqli_query($conn, $sql_2);
                    if($res_2 == true){
                        //updated
                        $_SESSION['update_order'] = "<div class='success'>Order updated sucessfully</div>";
                        header("location: " . HOME_URL . "admin/order.php");
                    }
                    else{
                        //failed to update
                        $_SESSION['update_order'] = "<div class='error'>Failed to update order</div>";
                        header("location: " . HOME_URL . "admin/order.php");
                    }
                }
    
            ?>
        </div>
    </div>




    <!-- -------------include footer--------- -->
    <?php include("partials/footer.php"); ?>
</body>
</html>



<!-- this line of code is for a error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_end_flush(); ?>