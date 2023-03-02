<?php include('partials_front/menu.php'); ?>





  <!-- =====================================order start========================= -->
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
              if($count > 0){
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
                          <p class="card-text"><?php echo $item_description; ?></p>
                          <p class="card-text">price: <span><?php echo $item_price; ?></span> tk</p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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







          <!-- <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
            <div class="card mb-3">
              <img src="img/carft_3.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div> -->

          <div class="col-sm-5 col-md-6">
              <form class="row g-3 needs-validation" novalidate>
                  <div class="col-md-12">
                    <label for="validationCustom01" class="form-label">First name</label>
                    <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="validationCustom02" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="validationCustomUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                      <div class="invalid-feedback">
                        Please choose a username.
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="validationCustom03" class="form-label">City</label>
                    <input type="text" class="form-control" id="validationCustom03" required>
                    <div class="invalid-feedback">
                      Please provide a valid city.
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">State</label>
                    <select class="form-select" id="validationCustom04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>dhaka</option>
                      <option>khulna</option>
                      <option>barishal</option>
                      <option>sylhet</option>
                      <option>chittagong</option>
                      <option>rajshahi</option>
                      <option>rangpur</option>
                      <option>comilla</option>

                      
                    </select>
                    <div class="invalid-feedback">
                      Please select a valid state.
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom05" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="validationCustom05" required>
                    <div class="invalid-feedback">
                      Please provide a valid zip.
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                      <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                      </label>
                      <div class="invalid-feedback">
                        You must agree before submitting.
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary" type="submit">Confirm Order</button>
                  </div>
              </form>
            </div>
      </div>
  </div>
  </div>
  </div>
  <!-- =====================================order end========================= -->





    <?php include('partials_front/footer.php'); ?>