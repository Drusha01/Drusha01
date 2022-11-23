<?php 
    // ressume session if logged in
    session_start();

    require_once '../tools/functions.php';
    require_once '../classes/users.class.php';

    if(!isset($_SESSION['user_id'])){
        header('location: ../hotel/hotelBrowse.php');
    }else if(isset($_POST['save']) && validateSameNewPassword($_POST)){
        $cpassword = $_POST['cpassword'];
        $npassword = $_POST['npassword'];
        $ncpassword = $_POST['ncpassword'];

        $userObj = new Users();

        $result =  $userObj->getUserHashedPassword($_SESSION['user_id']);
        if(password_verify($cpassword,$result['user_password'])){
            // since we know that the password is the same, we will now hash the password
            $hashed_password = password_hash($npassword, PASSWORD_ARGON2I);
            $result =  $userObj->saveNewPassword($_SESSION['user_id'], $hashed_password );
            if($result){
                echo 'password saved';
            }
        }
        

        // if(validatePassword()){
        //     // query the hashed password from the database
        //     if(password_verify($user_entered_password,$result['user_password'])){

        //     }
        // }
        // validation 

        // check if same password

        // check if npassword is same as ncpassword

        // change in in the database
    }
    //print_r($_POST);


    require_once '../includes/header.php';
    require_once '../includes/topnav.php';
    require_once '../includes/profile.php';
    require_once '../includes/bottomnav.php';
?>




<div class="login-container">
        <form class="login-form" action="password.php" method="post" enctype="multipart/form-data">
            <div class="logo-details">
                <img src="#" alt="">
                <span class="logo-name">HotelBooking</span>
            </div>
            <hr class="divider">
            <label for="currentPassword">Current Password</label>
            <input type="password" id="cpassword" name="cpassword" placeholder="" required tabindex="2" minlength="8">
            <br>
            <label for="password">New Password</label>
            <input type="password" id="npassword" name="npassword" placeholder="" required tabindex="2" minlength="8">
            <br>
            <label for="password">Confirm Password</label>
            <input type="password" id="ncpassword" name="ncpassword" placeholder="" required tabindex="2" minlength="8">
            <br>
            <input class="button" type="submit" value="save" name="save" tabindex="5">
        </form>
</div>

</body>
</html>