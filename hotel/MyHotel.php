<?php 
    session_start();
    //print_r($_SESSION);

    require_once '../tools/functions.php';
    require_once '../classes/hotels.class.php';

    require_once '../includes/header.php';
    require_once '../includes/topnav.php';
    require_once '../includes/bottomnav.php';

     // check if logged in else go to log in stuff, if logged in proceed
    if(!isset($_SESSION['user_id'])){
        header('location: ../login/login.php'); 
    }else{
        // first check if we have hotel else ask to add 
        echo '<br><br><br>';
        echo '<br><br><br>';
        echo '<br><br><br>';
        echo '<br><br><br>';
        $hotelObj = new Hotels();
        $result = $hotelObj->getUserHotel($_SESSION['user_id']);
        if($result){
            // edit their hotel
            //print_r($result);
            $content ='
            <div class="content">
            <div class="img">
                <img src="../img/hotel/'.$result['hotel_thumbnail_photo'].'" alt="">
                <div class="centered1">Welcome to '.$result['hotel_name'].'</div>
            </div>
            <div> '.$result['hotel_description'].'</div>
            <a href="updateHotel.php?hotelid='.$result['hotel_id'].'&id='.$_SESSION['user_id'].'">edit</a>
            <div class="rooms">
                <img src="https://www.hostinger.com/tutorials/wp-content/uploads/sites/2/2018/11/what-is-html-3.jpg" alt="">
                <p class="roomname">Type: <span>Single</span></p>
                <p class="roomprice">Price: <span>696.9 PHP</span></p>
                <p class="roomfeatures">Features: City view -Non-smoking- Shower and bathtub -Free Wi-Fi</p>
            </div>
            </div>';
            echo $content;
        }else{
            // ask them to add their hotel
            $content ='
            <br><br><br><br><br><br><br><br><br>
            <form  class="login-form" action="MyHotel.php" method="post" enctype="multipart/form-data">
                <label for="username">Hotel Name</label>
                <input class ="form" type="text" id="hname" name="hname" value="" placeholder="enter hotel name" required tabindex="1">
                <label for="username">Hotel Description</label>
                <input class ="form" type="text" id="hdesc" name="hdesc" value="" placeholder="enter hotel description" required tabindex="1">
                <label for="username">Hotel Address</label>
                <input class ="form" type="text" id="haddr" name="haddr" value="" required placeholder="enter hotel address" tabindex="1">
                <label for="username">Hotel Phone</label>
                <input class ="form" type="text" id="hphone" name="hphone" value="" required placeholder="enter hotel phone number" tabindex="1">
                <label for="username">Hotel Photo</label>
                <input class="inputfile" type="file" name="myImage" accept="image/png, image/gif, image/jpeg" required />
                <input class="button" type="submit" value="save" name="save" tabindex="5">
            
            </form>';
            echo $content;

        }
    }

    if(isset($_POST['save'])){
        if(validateHotel($_POST)){
            $hotelObj = new Hotels();


            $hotelObj->setUser_id($_SESSION['user_id']);
            $hotelObj->setHotel_name($_POST['hname']);
            $hotelObj->setHotel_status_id('1');
            $hotelObj->setHotel_back_ground_photo('hotel_thumbnail_photo.jpg');
            $hotelObj->setHotel_thumbnail_photo('hotel_thumbnail_photo.jpg');
            $hotelObj->setHotel_description($_POST['hdesc']);
            $hotelObj->setHotel_address($_POST['haddr']);
            $hotelObj->setHotel_phone_number($_POST['hphone']);

            $result = $hotelObj->createHotel();
            if($result){
                $hotelObj->setHotel_id($hotelObj->getHotelID($_SESSION['user_id'])['hotel_id']);
            }

            if(validateProfilePhoto($_FILES)){
                $uploaddir = 'C:\Apache24\htdocs\WebProgFinal\Drusha01\img\hotel\\';
                $thumb = 'C:\Apache24\htdocs\WebProgFinal\Drusha01\img\hotelthumbnail\\';
                $uploadfile = $uploaddir . ($hotelObj->getHotel_id()).'.jpg';
                $newpng = $_FILES['myImage']['tmp_name'];
                $filename = $_FILES['myImage']['tmp_name'];
                $quality = 90;
                if(basename($_FILES['myImage']['type']) =='png'){
                    $png = imagejpeg(imagecreatefrompng($filename), $newpng, $quality );
                    if($png && move_uploaded_file($newpng, $uploadfile)){

                        $hotelObj->setHotel_thumbnail_photo($hotelObj->getHotel_id().'.jpg');
                        $hotelObj->setHotel_back_ground_photo($hotelObj->getHotel_id().'.jpg');
                        //$_SESSION['user_photo'] = $_SESSION['user_id'].'.jpg';

                        // create thumbnail
                        $image = imagecreatefromjpeg($uploadfile);

                        // get ratio 
                        list($width, $height) = getimagesize($uploadfile);
                        // check who got the lowest
                        $thumbnail_size = 1600;
                        if($width < $height){
                            $ratio = $height/$width;
                            $width = $thumbnail_size;
                            $height = intval($width * $ratio) ;
                        }else{
                            $ratio = $width/$height;
                            $height = $thumbnail_size;
                            $width = intval($height * $ratio) ;
                        }
                        $imgResized = imagescale($image , $width, $height);
                        imagejpeg($imgResized, $thumb .$hotelObj->getHotel_id().'.jpg');
                    }
                }else if(basename($_FILES['myImage']['type']) =='jpeg'){
                    
                    if(move_uploaded_file($newpng, $uploadfile)){

                        $hotelObj->setHotel_thumbnail_photo($hotelObj->getHotel_id().'.jpg');
                        $hotelObj->setHotel_back_ground_photo($hotelObj->getHotel_id().'.jpg');

                        //$_SESSION['user_photo'] = $_SESSION['user_id'].'.jpg';

                        // create thumbnail
                        $image = imagecreatefromjpeg($uploadfile);

                        // get ratio 
                        list($width, $height) = getimagesize($uploadfile);
                        // check who got the lowest
                        $thumbnail_size = 1600;
                        if($width < $height){
                            $ratio = $height/$width;
                            $width = $thumbnail_size;
                            $height = intval($width * $ratio) ;
                        }else{
                            $ratio = $width/$height;
                            $height = $thumbnail_size;
                            $width = intval($height * $ratio) ;
                        }
                        $imgResized = imagescale($image , $width, $height);
                        imagejpeg($imgResized, $thumb .$hotelObj->getHotel_id().'.jpg');
                    }
                }
            }else{
                
                $hotelObj->setHotel_thumbnail_photo($hotelObj->getHotel_id().'.jpg');
                $hotelObj->setHotel_back_ground_photo($hotelObj->getHotel_id().'.jpg');
            }
            
            // create hotel
            $result = $hotelObj->updatePhoto();
            if($result){
                header('location: updateHotel.php');
            }else{
                print_r($result);
            }
            // update data
            $result = $hotelObj->getUserHotel($_SESSION['user_id']);
            
            echo 'nice?';
        }
        
    }
    // $hotelObj->setHotel_id(strval($hotelObj->getHotelID($_SESSION['user_id'])['hotel_id']));
    // $hotelObj->setHotel_thumbnail_photo((25).'.jpg');
    // $hotelObj->setHotel_back_ground_photo((25).'.jpg');
    // $result = $hotelObj->updatePhoto();

    // first check if we have hotel else ask to add 

    // are we trying to save a hotel?
    
   
    
    ?>


    
    <br>
</body>
</html>