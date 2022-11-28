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
            //print_r($result);
        }else{
            // ask them to add their hotel
            echo 'add your hotel';
        }
    }

   

    // first check if we have hotel else ask to add 

    // are we trying to save a hotel?
    
   
    

    $content ='
    <div class="content">
        <div class="img">
            <img src="../img/hotel/'.$result['hotel_thumbnail_photo'].'" alt="">
            <div class="centered1">Welcome to '.$result['hotel_name'].'</div>
        </div>
        <div> '.$result['hotel_description'].'</div>
        <div class="rooms">
            <img src="https://www.hostinger.com/tutorials/wp-content/uploads/sites/2/2018/11/what-is-html-3.jpg" alt="">
            <p class="roomname">Type: <span>Single</span></p>
            <p class="roomprice">Price: <span>696.9 PHP</span></p>
            <p class="roomfeatures">Features: City view -Non-smoking- Shower and bathtub -Free Wi-Fi</p>
        </div>
    </div>';
    echo $content;
    ?>


    <br>
</body>
</html>