<?php include('partials_front/menu.php'); ?>




    <!-- =================================item details start=========================== -->

  <?php

    if(isset($_GET['id'])){
      //getting id from the index page
      $item_id = $_GET['id'];
      // echo $item_id;
      //sql
      $sql = "SELECT * FROM tbl_item WHERE id = $item_id";
      //execute
      $res = mysqli_query($conn, $sql);
      //check
      if($res == true){
        //get rows
        $count = mysqli_num_rows($res);
        if($count > 0){
          //item available
          while($rows = mysqli_fetch_assoc($res)){
            $item_title = $rows['title'];
            $item_description = $rows['description'];
            $item_price = $rows['price'];
            $item_image = $rows['image_name'];
            $item_category = $rows['category_id'];
            $item_featured = $rows['featured'];
            $item_active = $rows['active'];

            ?>

              <div class="productdetails">
                  <div class="container">
                      <div class="container text-center">
                          <div class="row">
                            <div class="col-sm-5 col-md-6">
                              <div class="card mb-3">

                                <?php
                                  if($item_image == ""){
                                    //no image
                                    echo "<div class='eror'>Image not available</div>";
                                  }
                                  else{
                                    //image abailable
                                    ?>
                                      <!-- this div is for simple mouse hover image zoom with no move effect -->
                                      <div class="image-container">
                                       <img src="<?php echo HOME_URL; ?>img/item/<?php echo $item_image; ?>" class="card-img-top zoom-image" alt="...">
                                      </div>
                                    <?php
                                  }
                                ?>
                                  
                                  <!-- <div class="card-body">
                                    <div class="card mb-3">
                                      <div class="row align-items-center">
                                        <div class="col">
                                          <img class="itm-img-dtl" src="img/carft_1.jpg" alt="">
                                        </div>
                                        <div class="col">
                                          <img class="itm-img-dtl" src="img/carft_2.jpg" alt="">
                                        </div>
                                        <div class="col">
                                          <img class="itm-img-dtl" src="img/carft_3.jpg" alt="">
                                        </div>
                                      </div>
                                    </div>
                                  </div> -->
                                </div>
                            </div>
                            <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                              <div class="card text-center">
                                  <div class="card-header">
                                    Featured
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title"><?php echo $item_title; ?></h5>
                                    <p class="card-text"><?php echo $item_description; ?></p>
                                    <p class="card-text">price: <span><?php echo $item_price; ?></span> tk</p>
                                    <a href="<?php echo HOME_URL; ?>order.php?id=<?php echo $item_id; ?>" class="btn btn-primary">buy</a>
                                  </div>
                                  <div class="card-footer text-muted">
                                    2 days ago
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                  </div>
              </div>

            <?php
          }
        }
        else{
          //item not available
          echo "<div class='error form-center'>Product is not available</div>";
        }
      }

    }
    else{
      //not getting id
      //redirect
      header("location: " . HOME_URL);

    }


  ?>


    
    
    <!-- =================================item details end===================== -->

    <?php include('partials_front/footer.php'); ?>