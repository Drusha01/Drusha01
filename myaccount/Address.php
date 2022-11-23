<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location: ../hotel/hotelBrowse.php');
    }else{
        // validation 

        
    }




    require_once '../includes/header.php';
    require_once '../includes/topnav.php';
    require_once '../includes/profile.php';
    require_once '../includes/bottomnav.php';

?>



</body>
</html>