<?php include('config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>message</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div>
            <span class="form-center">
                <?php
                    if(isset($_SESSION['order'])){
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                    }
                ?>
            </span>
        </div>
        <div class="message-button">
            <a href="<?php echo HOME_URL; ?>index.php"><input type="button" value="okay"></a>
        </div>
    </div>
    
</body>
</html>


