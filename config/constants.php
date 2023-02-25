<?php
    //starting session
    session_start();


    //create constants to store non repeating values
    //constant name has to be capital letter
    define('HOME_URL', 'http://localhost/php/HandCraft/');
    define('SERVER_NAME', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'handcraft');

    $conn = mysqli_connect(SERVER_NAME, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //this is database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //connect to the correspondent database
?>