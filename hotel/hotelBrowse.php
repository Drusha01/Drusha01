<?php 
    session_start();
    //print_r($_SESSION);

    require_once '../tools/functions.php';
    require_once '../classes/hotels.class.php';


    require_once '../includes/header.php';
    require_once '../includes/topnav.php';

    if(isset($_GET['index'])){
        $index = $_GET['index'];
    }else{
        $index=0;
    }
    
    $hotelObj = new Hotels();

    $result =$hotelObj->getHotels($index);

    $counter = 0;

    
    
    //print_r($result);
    echo '<br><br><br>';
    echo '<br><br><br>';
    echo '<br><br><br>';
    echo '<br><br><br>';
    $value = count($result);
    $counter = 0;
    $var =0;

    echo '
    <div class="row">';
    while($counter < $value){
        if($result[$counter]['hotel_status_id'] == 1){
        echo '
        <div class="column">
            <a href="../hotel/viewhotel.php?index='.$result[$counter]['hotel_id'].'">
                <img src="../img/hotel_thumbnail_photo.jpg" alt="Snow" style="width:100%">
            </a>
            <h2 class="centered">'.$result[$counter]['hotel_name'].'</h2>
        </div>';
        $var++;
        }
        $counter++;
        if(($var % 4 ==0)){
            echo '
            </div>';
            echo '
            <div class="row">';
        }
    }
    echo '
        </div>';
    
?>

    






    
   
</body>
</html>