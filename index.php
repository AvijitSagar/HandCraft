<?php include('partials_front/menu.php'); ?>





    <!-- =============================CATEGORY START=================== -->
    <div class="container">
      <div class="category">
        <ul>
          <li>
            <a href="category.php">handcraft</a>
          </li>
          <li>
            <a href="">art gallery</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- =======================CATEGORY END======================== -->





    <!-- ================================carousel start============================= -->
    <div id="slideimg">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="5000">
                <img src="img/img_1.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="5000">
                <img src="img/img_2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="5000">
                <img src="img/img_3.jpg" class="d-block w-100" alt="...">
              </div>
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
              <div class="col">
                <div class="g-col-6 g-col-md-4">
                    <div class="card" style="width: 18rem;">
                      <img src="img/img_4.jpg" class="cart-card-img-top" alt="...">
                        <div class="card-body">
                          <a href="itemdetails.html"><h5 class="card-title">Card title</h5></a>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="itemdetails.php" class="btn btn-primary">BUY</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="g-col-6 g-col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/img_5.jpg" class="cart-card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">BUY</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="g-col-6 g-col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/img_6.jpg" class="cart-card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">BUY</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="g-col-6 g-col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/img_7.jpg" class="cart-card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">BUY</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="g-col-6 g-col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/img_8.jpg" class="cart-card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">BUY</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col">
                <div class="g-col-6 g-col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/carft_1.jpg" class="cart-card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">BUY</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- ================================cart end============================= -->





    <?php include('partials_front/footer.php'); ?>