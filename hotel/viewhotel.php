<?php 
    session_start();
    //print_r($_SESSION);

    require_once '../tools/functions.php';
    require_once '../classes/hotels.class.php';

    require_once '../includes/header.php';
    require_once '../includes/topnav.php';
    require_once '../includes/bottomnav.php';

     // check if logged in else go to log in stuff, if logged in proceed
     if(isset($_GET['index'])){
        $index = $_GET['index'];

        // first check if we have hotel else ask to add 
        echo '<br><br><br>';
        echo '<br><br><br>';
        echo '<br><br><br>';
        echo '<br><br><br>';
    
        $hotelObj = new Hotels();
        $result = $hotelObj->getHotelDetails($index);
        if($result){
            // edit their hotel
            print_r($result);
        }else{
            // ask them to add their hotel
            echo 'add your hotel';
        }
    }

   

    // first check if we have hotel else ask to add 

    // are we trying to save a hotel?
    
   
    
?>

    hotel_name 
    hotel_background_photo
    hotel_description
    hotel_address
    hotel_phone_number
    <br>
    DISPLAY HOTEL HERE IF HAVE, ELSE PROMPT TO REGISTER THEIR HOTEL, AFTER THAT WAIT FOR APPROVAL FROM ADMIN
</body>
</html>