    <!-- =============================CATEGORY START=================== -->
    <div class="container">
      <div class="category">
        <ul>

          <?php
            //create sql to get all data from tbl_category
            $sql = "SELECT * FROM tbl_category";
            //execute
            $res = mysqli_query($conn, $sql);
            //count rows to check
            $count = mysqli_num_rows($res);
            //check
            if($count > 0){
              //category is available
              while($rows = mysqli_fetch_assoc($res)){
                //get the values like title
                $id = $rows['id'];
                $title = $rows['title'];

                ?>

                    <li>
                      <a href="<?php echo HOME_URL; ?>category.php"><?php echo $title; ?></a>
                    </li>
                  
                <?php
              }
            }
            else{
              //category unavailable
              echo "<div class='error'>category not found</div>";
            }
          ?>


        </ul>
      </div>
    </div>
    <!-- =======================CATEGORY END======================== -->
