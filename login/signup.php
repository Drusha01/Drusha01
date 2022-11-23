<?php 
    // ressume session if logged in
    session_start();

    require_once '../tools/functions.php';
    require_once '../classes/users.class.php';

    if(isset($_SESSION['user_id'])){
        header('location: ../hotel/hotelBrowse.php');
    } else {    // not logged in proceed to check the post method for validation and queries in database

        // remove this long shits
        if(isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['fname'])  && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['sex']) && isset($_POST['birthdate']) ){
            //print_r($_POST);
            if(validate_signup($_POST)){
                $userObj = new Users();

                $userObj->setUser_status_id('1');
                $userObj->setUser_verified('0');
            
                $userObj->setUser_name($_POST['username']);
                $userObj->setUser_password($_POST['password']);
                $userObj->setUser_firstname($_POST['fname']);
                $userObj->setUser_lastname($_POST['lname']);
                $userObj->setUser_email($_POST['email']);
                $userObj->setUser_gender($_POST['sex']);
                $userObj->setUser_birthdate($_POST['birthdate']);

                $result = $userObj->signUp();
                if($result){
                    $result = $userObj->getUserDetails();
                    //print_r($result);
                    $_SESSION['user_id'] = $result['user_id'];
                    $_SESSION['user_status_id']=$result['user_status_id'];
                    $_SESSION['user_verified']=$result['user_verified'];
                    $_SESSION['user_name']=$result['user_name'];
                    $_SESSION['user_firstname']=$result['user_firstname'];
                    $_SESSION['user_lastname']=$result['user_lastname'];
                    $_SESSION['user_email']=$result['user_email'];
                    $_SESSION['user_phonenumber']=$result['user_name'];
                    $_SESSION['user_gender']=$result['user_gender'];
                    $_SESSION['user_birthdate']=$result['user_birthdate'];
                    $_SESSION['user_photo']=$result['user_photo'];
                    $_SESSION['user_address']=$result['user_address'];
                    $_SESSION['date_created']=$result['date_created'];
                    header('location: ../hotel/hotelBrowse.php');
                }else{
                    echo 'invalid username/password/email';
                }

            }else {
                'invalid';
            }
            // go to profile or browsing hotels
        }
    }

    require_once '../includes/header.php';
    require_once '../includes/topnav.php';
    require_once '../includes/bottomnav.php';
?>



<div class="login-container">
        <form class="login-form" action="signup.php" method="post" enctype="multipart/form-data">
            <div class="logo-details">
                <img src="#" alt="">
                <span class="logo-name">HotelBooking</span>
            </div>
            <hr class="divider">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required tabindex="1">
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" value = "" required tabindex="2" minlength="8">
            <br>
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="fname" placeholder="Enter First Name" required tabindex="3">
            <br>
            <label for="fname">Last Name</label>
            <input type="text" id="lname" name="lname" placeholder="Enter Last Name" required tabindex="4">
            <br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Enter Email" required tabindex="5">
        
            <div>
                <label for="sex">Sex</label><br>
                <label class="container" for="M">Male
                    <input type="radio" name="sex" id="M" value="M" >
                    <span class="checkmark"></span>
                </label>
                <label class="container" for="F">Female
                    <input type="radio" name="sex" id="F" value="F" >
                    <span class="checkmark"></span>
                </label>
            </div>
            <br>
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="start" name="birthdate"
                value="2000-08-31"
                min="1900-01-01" max="2022-12-12" >

            
            <br>
            <input class="button" type="submit" value="Signup" name="signup" tabindex="5">
            <a href="login.php" style ="text-decoration: none;">Login?</a>
            <?php
            
                if(isset($error)){
                    echo '<div><p class="error">'.$error.'</p></div>';
                }
                
            ?>
        </form>
    </div>



</body>
</html>