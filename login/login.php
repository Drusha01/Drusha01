<?php 
    session_start();

    require_once '../tools/functions.php';
    require_once '../classes/users.class.php';

    if(isset($_SESSION['user_id'])){
        header('location: ../hotel/hotelBrowse.php'); 
    } else {    // not logged in proceed to check the post method for validation and queries in database
        if(isset($_POST['password'])){
            $user_entered_password = $_POST['password'];
        }
        if(validateLogin($_POST)){
            // not doing sanitation here  

            // validate 
            $userObj = new Users();
            $userObj->setUser_name($_POST['username']);
            $userObj->setUser_password($_POST['password']);
            $result = $userObj->validate();
            if($result && password_verify($user_entered_password,$result['user_password'])){
                $_SESSION['user_id']= $result['user_id'];
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
                
                //print_r($result);
                
            }else{
                echo 'invalid username/password';
            }
            // go to profile or browsing hotels

        }
    }

    require_once '../includes/header.php';
    require_once '../includes/topnav.php';
    require_once '../includes/bottomnav.php';

?>





    <div class="login-container">
        <form class="login-form" action="login.php" method="post">
            
            <div class="logo-details">
                <span class="logo-name">Login</span>
            </div>
            <hr class="divider">
            <label for="username">Username</label>
            <input class ="form" type="text" id="username" name="username" placeholder="Enter username" required tabindex="1">
            <label for="password">Password</label>
            <input class ="form" type="password" id="password" name="password" placeholder="Enter password" required tabindex="2" minlength="8">
            <input class="button" type="submit" value="Login" name="login" tabindex="3">
            <a href="signup.php" style ="text-decoration: none;">Signup?</a>
            <?php
                //Display the error message if there is any.
                if(isset($error)){
                    echo '<div><p class="error">'.$error.'</p></div>';
                }
                
            ?>
        </form>
    </div>
</body>
</html>
