<?php include('partials_front/menu.php'); ?>

<!-- ================================cart start============================= -->
<div id="cart" class="container">
    <?php
        //get the search keyword
        $search = $_POST['search'];
    ?>
    <h1>Products on your search ' <a href="#" class="text-violet"><?php echo $search; ?></a> '</h1>
    <div class="container text-center">
        <div class="row align-items-center">


        <?php
            
            // echo $search;
            //sql query to get products based on search keyword
            //theis query will seach items or products from the table 
            //query for search from table
            $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //execute
            $res = mysqli_query($conn, $sql);
            //count
            $count = mysqli_num_rows($res);
            //check if there is any product available or not in the db
            if($count > 0){
                //product available
                while($rows = mysqli_fetch_assoc($res)){
                    //get table data
                    $item_id = $rows['id'];
                    $item_title = $rows['title'];
                    $item_description = $rows['description'];
                    $item_price = $rows['price'];
                    $item_image = $rows['image_name'];

                    ?>

                        <div class="col">
                            <div class="g-col-6 g-col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <?php
                                        if($image = ""){
                                            //image unavailable
                                            echo "<div class='error'>Image unavailable</div>";

                                        }
                                        else{
                                            //image available
                                            ?>
                                                <img src="<?php echo HOME_URL; ?>img/item/<?php echo $item_image; ?>" class="cart-card-img-top" alt="...">
                                            <?php

                                        }
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $item_title; ?></h5>
                                        <p class="card-text">price: <span><?php echo $item_price; ?></span> tk</p>
                                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                        <a href="itemdetails.html" class="btn btn-primary">BUY</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php


                }

            }
            else{
                //product unavailable
                echo "<div class='error'>Product not available</div>";
            }
        ?>


        </div>
    </div>
</div>
<!-- ================================cart end============================= -->

<?php include('partials_front/footer.php'); ?>