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
    }else {
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
        }else{
            // ask them to add their hotel
            header('location: MyHotel.php');
        }
    }
    echo 
    '<br>
    <br>
    <br>
    <br>
    <br>
    <br>';
    if(isset($_POST['save'])){
        if(validateHotel($_POST)){

            

            // get hotel id
            $hotelObj = new Hotels();
            $result = $hotelObj->getHotelID($_SESSION['user_id']);
            $hotelObj->setUser_id($_SESSION['user_id']);
            $hotelObj->setHotel_id($result['hotel_id']);
            $hotelObj->setHotel_name($_POST['hname']);
            $hotelObj->setHotel_description($_POST['hdesc']);
            $hotelObj->setHotel_address($_POST['haddr']);
            $hotelObj->setHotel_phone_number($_POST['hphone']);

            
            

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
                // echo '<br>here';
                // print_r($_FILES);
            }else{
                
                $hotelObj->setHotel_thumbnail_photo($hotelObj->getHotel_id().'.jpg');
                $hotelObj->setHotel_back_ground_photo($hotelObj->getHotel_id().'.jpg');
            }
            
            $result = $hotelObj->updateHotel();
            // update data
            $result = $hotelObj->getUserHotel($_SESSION['user_id']);
        }
    }
    
    
    
    
    
    ?> 
    
    
    <form  class="login-form" action="updateHotel.php" method="post" enctype="multipart/form-data">
            <label for="username">Hotel Name</label>
            <input class ="form" type="text" id="hname" name="hname" value="<?php echo $result['hotel_name']?>" required tabindex="1">
            <label for="username">Hotel Description</label>
            <input class ="form" type="text" id="hdesc" name="hdesc" value="<?php echo $result['hotel_description']?>" required tabindex="1">
            <label for="username">Hotel Address</label>
            <input class ="form" type="text" id="haddr" name="haddr" value="<?php echo $result['hotel_address']?>" required tabindex="1">
            <label for="username">Hotel Phone</label>
            <input class ="form" type="text" id="hphone" name="hphone" value="<?php echo $result['hotel_phone_number']?>" required tabindex="1">
            <label for="username">Hotel Photo</label>
            <input class="inputfile" type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
            <input class="button" type="submit" value="save" name="save" tabindex="5">

</form>

