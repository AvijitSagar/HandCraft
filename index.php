<?php include('partials_front/menu.php'); ?>




<?php include('partials_front/category_link.php'); ?>




<?php include('carousel.php') ?>





    <!-- ================================cart start============================= -->
    <div id="cart" class="container">
        <h1>Our Products</h1>
        <div class="container text-center">
            <div class="row align-items-center">



              <?php

              //sql
              $sql_2 = "SELECT * FROM tbl_item WHERE active = 'yes'";
              //execute
              $res_2 = mysqli_query($conn, $sql_2);
              //count
              $count_2 = mysqli_num_rows($res_2);
              //check
              if($count_2 > 0){
                //we have item
                //get the item
                while($rows_2 = mysqli_fetch_assoc($res_2)){
                  //get the data
                  $item_id = $rows_2['id'];
                  $item_title = $rows_2['title'];
                  $item_description = $rows_2['description'];
                  $item_price = $rows_2['price'];
                  $item_image = $rows_2['image_name'];
                  $item_category = $rows_2['category_id'];
                  $item_featured = $rows_2['featured'];
                  $item_active = $rows_2['active'];

                  ?>

                    <div class="col">
                      <div class="g-col-6 g-col-md-4">
                          <div class="card" style="width: 18rem;">

                            <?php
                              if($item_image == ""){
                                //image not available
                                echo "<div class='error'> Image not added</div>";
                              }
                              else{
                                //image is available
                                ?>
                                  <img src="<?php echo HOME_URL; ?>img/item/<?php echo $item_image; ?>" class="cart-card-img-top" alt="...">
                                <?php
                              }
                            ?>
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $item_title; ?></h5>
                                <p class="card-text">price: <span><?php echo $item_price; ?></span> tk</p>
                                <a href="<?php echo HOME_URL; ?>item_details.php?id=<?php echo $item_id; ?>" class="btn btn-primary">BUY</a>
                              </div>
                          </div>
                      </div>
                    </div>

                  <?php


                }

              }
              else{
                //we dont have item
                echo "<div class='error'>There is no products</div>";
              }

              ?>


            </div>
        </div>
    </div>
    <!-- ================================cart end============================= -->





    <?php include('partials_front/footer.php'); ?>