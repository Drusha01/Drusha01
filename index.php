<?php
    //start session
    session_start();
    header('location: hotel/hotelBrowse.php');
    //check if user is login already otherwise send to login page
    if (isset($_SESSION['username'])){
        header('location: faculty/faculty.php');
    }
    else{
        
    }

?>