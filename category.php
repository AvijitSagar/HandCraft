
<?php include('partials_front/menu.php'); ?>

<?php include('partials_front/category_link.php') ?>

    <!-- ================================cart start============================= -->
    <div id="cart" class="container">
      <h1>Showing items from category</h1>


      <span class="form-center">
        <?php
          if(isset($_SESSION['category_wise_item_not_found'])){
            echo $_SESSION['category_wise_item_not_found'];
            unset($_SESSION['category_wise_item_not_found']);
          }
        ?>
      </span>


      <div class="container text-center">
          <div class="row align-items-center">

          <?php

            if(isset($_GET['id'])){
              //getting id from category_link.php
              // 1. store the id in a variable which we got from the category_link.php page
              $id = $_GET['id'];
              // 2. sql query to got all the item data with the id we have got
              $sql = "SELECT * from tbl_item where category_id = $id AND active = 'yes'";
              // 3. execute
              $res = mysqli_query($conn, $sql);
              // 4. check
              if($res == true){
                // 5. check whether the data is available or not
                //get the rows
                $count = mysqli_num_rows($res);
                if($count > 0){
                  //item available
                  // echo "item found";
                  // 6. get all rows from the item table with the category id which we got from the category_link.php page and store them in an array
                  while($rows = mysqli_fetch_assoc($res)){
                    //storing row data in individual variables
                    $item_id = $rows['id'];
                    $item_title = $rows['title'];
                    $item_description = $rows['description'];
                    $item_price = $rows['price'];
                    $item_image = $rows['image_name'];
                    $item_category = $rows['category_id'];
                    $item_featured = $rows['featured'];
                    $item_active = $rows['active'];
                    ?>
                      <div class="col">
                        <div class="g-col-6 g-col-md-4">
                            <div class="card" style="width: 18rem;">

                            <?php
                              if($item_image == ""){
                                //no image found
                                echo "<div class='error'>No image found</div>";
                              }
                              else{
                                //image found
                                ?>
                                  <img src="<?php echo HOME_URL; ?>img/item/<?php echo $item_image; ?>" class="cart-card-img-top" alt="...">
                                <?php
                              }
                            ?>
                                <div class="card-body">
                                  <h5 class="card-title"><?php echo $item_title; ?></h5>
                                  <p class="card-text">price: <span><?php echo $item_price; ?></span> tk</p>
                                  <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                  <a href="<?php echo HOME_URL; ?>item_details.php?id=<?php echo $item_id; ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                      </div>
                    <?php
                  }
                  
                }
                else{
                  //item not available
                  //session message
                  // $_SESSION['category_wise_item_not_found'] = "<div class='error'>Sorry, no items in this category</div>";
                  //redirect
                  // header("location: " . HOME_URL . "category.php");
                  echo "<div class='error'>Sorry product not available</div>";
                }
              }
            }
            else{
              //not getting id from category_link.php page
              //redirect to home page
              header("location: " . HOME_URL);
            }

          ?>
          </div>
      </div>
  </div>
  <!-- ================================cart end============================= -->




<?php include('partials_front/footer.php'); ?>

