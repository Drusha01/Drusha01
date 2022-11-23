<?php 
    // ressume session if logged in
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location: ../hotel/hotelBrowse.php');
    }else{
        // validation 

        // check if same password

        // check if npassword is same as ncpassword

        // change in in the database
    }
    print_r($_POST);


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