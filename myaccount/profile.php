<?php 
    session_start();

    require_once '../tools/functions.php';
    require_once '../classes/users.class.php';

    if(!isset($_SESSION['user_id'])){
        header('location: ../hotel/hotelBrowse.php');
    } else {    // not logged in proceed to check the post method for validation and queries in database
        if(validateUpdateProfile($_POST)){
            $userObj = new Users();

            print_r($_POST);
            echo '<br>';

            $userObj->setUser_id($_SESSION['user_id']);
            $userObj->setUser_firstname($_POST['fname']);
            $userObj->setUser_lastname($_POST['lname']);
            $userObj->setUser_email($_POST['email']);
            $userObj->setUser_gender($_POST['sex']);
            $userObj->setUser_birthdate($_POST['birthdate']);
            $userObj->setUser_phonenumber('');
            if(isset($_POST['phone'])){
                $userObj->setUser_phonenumber($_POST['phone']);
            }

            if(validateProfilePhoto($_FILES)){
                $uploaddir = 'C:\Apache24\htdocs\WebProgFinal\img\profile\\';
                $thumb = 'C:\Apache24\htdocs\WebProgFinal\img\thumbnail\\';
                $uploadfile = $uploaddir . ($_SESSION['user_id']).'.jpg';
                $newpng = $_FILES['myImage']['tmp_name'];
                $filename = $_FILES['myImage']['tmp_name'];
                $quality = 90;
                if(basename($_FILES['myImage']['type']) =='png'){
                    $png = imagejpeg(imagecreatefrompng($filename), $newpng, $quality );
                    if($png && move_uploaded_file($newpng, $uploadfile)){
                        $userObj->setUser_photo($_SESSION['user_id'].'.jpg');
                        $_SESSION['user_photo'] = $_SESSION['user_id'].'.jpg';

                        // create thumbnail
                        $image = imagecreatefromjpeg($uploadfile);

                        // get ratio 
                        list($width, $height) = getimagesize($uploadfile);
                        // check who got the lowest
                        $thumbnail_size = 80;
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
                        imagejpeg($imgResized, $thumb .$_SESSION['user_id'].'.jpg');
                    }
                }else if(basename($_FILES['myImage']['type']) =='jpeg'){
                    
                    if(move_uploaded_file($newpng, $uploadfile)){
                        $userObj->setUser_photo($_SESSION['user_id'].'.jpg');
                        $_SESSION['user_photo'] = $_SESSION['user_id'].'.jpg';

                        // create thumbnail
                        $image = imagecreatefromjpeg($uploadfile);

                        // get ratio 
                        list($width, $height) = getimagesize($uploadfile);
                        // check who got the lowest
                        $thumbnail_size = 80;
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
                        imagejpeg($imgResized, $thumb .$_SESSION['user_id'].'.jpg');
                    }
                }
                echo '<br>here';
                print_r($_FILES);
            }else{
                $userObj->setUser_photo($_SESSION['user_id'].'.jpg');
            }

            // update user 

            $result = $userObj->userUpdate();
            print_r($result);
    




            // set all things to update

            // validate file (image)
        }else {
            'invalid';
        }
        // go to profile or browsing hotels
    }
    


    //print_r($_SESSION);
   
    //print_r($_FILES);
    echo '<br>';
    echo '
    <html lang="en">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Hotel Booking</title>
    </head>
    <body>';

    require_once '../includes/topnav.php';
    require_once '../includes/profile.php';
    require_once '../includes/bottomnav.php';


        $userObj = new Users();
        $result = $userObj->getUserDetailsWithId($_SESSION['user_id']);

        print_r($result);
        echo '<br><br><br>';

        if(!isset($result['user_photo'])){
            $result['user_photo'] = 'default.png';
        }
        if(!isset($result['user_phonenumber'])){
            $result['user_phonenumber'] = '';
        }

        $sex['M'] ='';
        $sex['F'] ='';

        if($result['user_gender'] =='M'){
            $sex['M'] ='checked';
        }else if($result['user_gender'] =='F'){
            $sex['F'] ='checked';
        }


    $string = '
    <div>
        <form action="profile.php" method="post" enctype="multipart/form-data">
            <label for="username">Username</label>
            <div>'.htmlentities($result['user_name']).'</div>

            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" value="'.htmlentities($result['user_firstname']).'" required tabindex="3">
            <br>
            <label for="fname">Last Name</label>
            <input type="text" id="lname" name="lname" value="'.htmlentities($result['user_lastname']).'" required tabindex="4">
            <br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="'.htmlentities($result['user_email']).'" required tabindex="5">
            <br>
            <label for="phone">phone number</label>
            <input type="text" id="phone" name="phone" value="'.htmlentities($result['user_phonenumber']).'" tabindex="6">
            <div>
                <label for="sex">Sex</label><br>
                <label class="container" for="Male">Male
                    <input type="radio" name="sex" id="M" value="M"  '.htmlentities($sex['M']).'>
                    <span class="checkmark"></span>
                </label>
                <label class="container" for="Male">Female
                    <input type="radio" name="sex" id="F" value="F" '.htmlentities($sex['F']).'>
                    <span class="checkmark"></span>
                </label>
                <br>
                <label for="birthdate">Birthdate:</label>
                <input type="date" id="start" name="birthdate"
                    value="'.htmlentities($result['user_birthdate']).'"
                    min="1900-01-01" max="2022-12-12" >
            </div>

            
            <label>upload profile picture
            <input type="file" name="myImage" accept="image/png, image/gif, image/jpeg" />
            </label>


            <br>
            <input class="button" type="submit" value="save" name="save" tabindex="5">
            <br>
            <br>
            <img src="../img/thumbnail/'.htmlentities($result['user_photo']).'" alt="" >
            <br>
            <img src="../img/profile/'.htmlentities($result['user_photo']).'" alt="" >
        </form>
    </div>';
    echo $string;
    ?>

</body>
</html>