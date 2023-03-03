<!-- this line of code is for header location already sent error....  -->
<!-- output buffering to solve it -->
<!-- got it from stackoverflow -->
<?php ob_start(); ?>  


<?php include('partials_front/menu.php'); ?>





  <!-- =====================================order start========================= -->
  <form action="" method="POST">
  <div class="container">
    <div class="form">
      <div class="text-center">
        <div class="row">


        <?php
          if(isset($_GET['id'])){
            $item_id = $_GET['id'];
            //sql
            $sql = "SELECT * FROM tbl_item where id = $item_id";
            //execute
            $res = mysqli_query($conn, $sql);
            //
            if($res == true){
              //query executed
              //count rows
              $count = mysqli_num_rows($res);
              //check
              if($count == 1){
                //we have data in db
                //row wise data retrieve
                while($rows = mysqli_fetch_assoc($res)){
                  $item_title = $rows['title'];
                  $item_description = $rows['description'];
                  $item_price = $rows['price'];
                  $item_image = $rows['image_name'];
                  $item_category = $rows['category_id'];
                  $item_featured = $rows['featured'];
                  $item_active = $rows['active'];

                  ?>

                    <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                      <div class="card mb-3">
                        <?php
                          if($item_image == ""){
                            //no image available
                            echo "<div class='error'>Image not added yet</div>";
                          }
                          else{
                            //image available
                            ?>
                              <img src="<?php echo HOME_URL; ?>img/item/<?php echo $item_image; ?>" class="card-img-top" alt="...">
                            <?php
                          }
                        ?>
                        
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $item_title; ?></h5>
                          <p class="card-text">Quantity</p>
                          <input type="hidden" name="item" value="<?php echo $item_title; ?>">
                          <input type="hidden" name="price" value="<?php echo $item_price ?>">
                          
                          <p class="card-text">Price: <span><?php echo $item_price; ?></span> tk</p>
                          <p class="card-text">Quantity <input type="number" name="quantity" value= 1 min="1" max="5"></p>
                        </div>
                      </div>
                    </div>

                  <?php

                }

              }
              else{
                //we do not have any data in db
                echo "<div class='error'>There is no product</div>";
              }

            }
            else{
              //query is not executed
              echo "<div class='error'>DB query execution problem</div>";
            }

          }
          else{
            //id not found
            //redirect
            header("location: " . HOME_URL);
          }
        ?>

          <div class="col-sm-5 col-md-6">
              <form class="row g-3 needs-validation" method="POST" novalidate>
                  <div class="col-md-12">
                    <label for="validationCustom01" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="validationCustom01" required>
                  </div>
                  <div class="col-md-12">
                    <label for="validationCustomUsername" class="form-label">Mobile</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">+88</span>
                      <input type="tel" name="contact" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <label for="validationCustomUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <input type="email" name="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <label for="validationCustomUsername" class="form-label">Detail address</label>
                    <div class="input-group has-validation">
                      <div class="input-group">
                        <textarea class="form-control" name="address" aria-label="With textarea" required></textarea>
                      </div>
                    </div>
                  </div>

                  <br>
                  <div class="col-12">
                    <button class="btn btn-primary" type="submit" name="submit">Confirm Order</button>
                  </div>
              </form>


            <?php
              //check whether the submit button is clicked or not
              if(isset($_POST['submit'])){
                //get all the details from the form
                // $item = $_POST['item'];
                // $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $item_price * $quantity; //total = price x quantity
                $order_date = date("Y-m-d h:i:sa"); //order date
                $status = 'ordered'; //ordered, ondelevary, delivered, canceled..... user sudhu order korte parbe baki gula admin handle korbe admin panel theke


                //securing given form data lfrom sql injection with mysdqli_real_escape_string function
                $raw_customer_name = $_POST['name'];
                $customer_name = mysqli_real_escape_string($conn, $raw_customer_name);

                $raw_customer_contact = $_POST['contact'];
                $customer_contact = mysqli_real_escape_string($conn, $raw_customer_contact);

                $raw_customer_email = $_POST['email'];
                $customer_email = mysqli_real_escape_string($conn, $raw_customer_email);

                $raw_customer_address = $_POST['address'];
                $customer_address = mysqli_real_escape_string($conn, $raw_customer_address);


                //save tehe order in db
                //sql
                $sql_2 = "INSERT INTO tbl_order SET
                  item = '$item_title',
                  price = $item_price,
                  quantity = $quantity,
                  total = $total,
                  order_date = '$order_date',
                  status = '$status',
                  customer_name = '$customer_name',
                  customer_contact = '$customer_contact',
                  customer_email = '$customer_email',
                  customer_address = '$customer_address'
                ";

                //execute
                $res_2 =mysqli_query($conn, $sql_2);
                //check
                if($res_2 == true){
                  //query executed and order saved
                  $_SESSION['order'] = "<div class='success'>Congrats, Your order placed successfully</div>";
                  //redirect
                  header("location: " . HOME_URL . "message.php");
                }
                else{
                  //failed to save order
                  $_SESSION['order'] = "<div class='error'>Sorry, Failed to place your order</div>";
                  //redirect
                  header("location: " . HOME_URL);
                }
              }

            ?>


            </div>
      </div>
  </div>
  </form>

  

  <!-- =====================================order end========================= -->





    <?php include('partials_front/footer.php'); ?>