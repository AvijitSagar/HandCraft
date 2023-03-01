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
                  $featured = $rows['featured'];
                  $active = $rows['active'];

                  //php brake to use html
                  ?>
                    
                    <div class="carousel-item active" data-bs-interval="5000">
                      <?php
                        //check if image is available or not
                        if($image == "" ){
                          //no image
                          // echo "<div class=''error>Image not available</div>";
                          ?>
                          <img src="" class="d-block w-100" alt="IMAGE NOT FOUND">
                          <?php
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