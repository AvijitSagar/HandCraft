<?php
    // ACCESS CONTROL or AUTHENTICATION
    //check whether the user is logged in or not
    //this is called authoraization or access control
    if(!isset($_SESSION['user'])){ //if user session is not sets.... it means if user is not logged in
        //user is not logged in
        //redirect in login page with message
        $_SESSION['no_login_message'] = "<div class='error'>Please Login to Access Admin Panel</div>";
        //redirect to login pge
        header("location: " . HOME_URL . "admin"); // ekhane constants.php include kora hoy nai karon ei login_check.php file ke amra menu.php file a include korbo ar menu.php file a age thekei constants.php file include kora ache
    }
?>