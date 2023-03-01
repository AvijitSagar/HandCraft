<?php include('partials_front/menu.php'); ?>





<?php include('partials_front/category_link.php'); ?>




    <!-- ================================carousel start============================= -->
    <div id="slideimg">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">



            <?php
              //sql
              //je shob category featured ebong active ache sudhu shei category er image gulai show korar query
              //chaile amra category er shob image gulai show korate pari abar limit diyeo show korate pari 

              // $sql = "SELECT * FROM tbl_category";
              // $sql = "SELECT * FROM tbl_category LIMIT 3";
              $sql = "SELECT * FROM tbl_category WHERE featured = 'yes' AND active = 'yes'";

              //execute
              $res = mysqli_query($conn, $sql);
              //count
              $count = mysqli_num_rows($res);
              //check
              if($count > 0){
                //category is available
                //get data
                while($rows = mysqli_fetch_assoc($res)){
                  // ja ja lagbe tai tai nite hobe. ekhane sudhu item imge gula carusel a show korte hobe tai sudhu image_name e naoa hoyeche
                  $image = $rows['image_name'];

                  //php brake to use html
                  ?>
                    
                    <div class="carousel-item active" data-bs-interval="5000">
                      <?php
                        //check if image is available or not
                        if($image == ""){
                          //no image
                          echo "<div class=''error>Image not available</div>";
                        }
                        else{
                          //image is available
                          ?>
                            <img src="<?php echo HOME_URL; ?>img/category/<?php echo $image; ?>" class="d-block w-100" alt="...">
                          <?php
                        }
                      ?>
                      
                    </div>

                  <?php
                }

              }
              else{
                //category is not available
                echo "<div class='error'>Category is not added yet</div>";
              }
            ?>







              <!-- <div class="carousel-item active" data-bs-interval="5000">
                <img src="img/img_1.jpg" class="d-block w-100" alt="...">
              </div> -->
              <!-- <div class="carousel-item" data-bs-interval="5000">
                <img src="img/img_2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="5000">
                <img src="img/img_3.jpg" class="d-block w-100" alt="...">
              </div> -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- ================================carousel end============================= -->





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
                              if($image == ""){
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
                                <a href="<?php echo HOME_URL; ?>item_details.php" class="btn btn-primary">BUY</a>
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