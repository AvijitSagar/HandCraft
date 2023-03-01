<?php include('config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HANDCRAFT</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- ============================NAVBAR START======================== -->
    <div id="navbar" class="header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <div class="logo">
                <a href="<?php echo HOME_URL; ?>"><img class="img-responsive" src="img/logo.png" alt=""></a>
              </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="<?php echo HOME_URL; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                      </a>
                      <ul class="dropdown-menu">

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
                                    <a class="dropdown-item" href="<?php echo HOME_URL; ?>category.php"><?php echo $title; ?></a>
                                  </li>
                                
                              <?php
                            }
                          }
                          else{
                            //category unavailable
                            echo "<div class='error'>category not found</div>";
                          }
                        ?>
                        <!-- <li><hr class="dropdown-divider"></li>
                        <li>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </li> -->
                      </ul>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="<?php echo HOME_URL; ?>search.php" method="POST">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
    </div>
    <!-- =================================NAVBAR END========================= -->