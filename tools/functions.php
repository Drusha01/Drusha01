<?php
function validateString($POST,$name){
    return (isset($POST[$name]) && strlen(trim($POST[$name]))>1 ) ;
}

function validate_password($POST,$passname){
    // to do
    if(!isset($POST[$passname])){
        return false;
    }
    elseif (strlen($_POST[$passname]) <= '8') {
        return false;
    }
    elseif(!preg_match("#[0-9]+#",$_POST[$passname])) {
        return false;
    }
    elseif(!preg_match("#[A-Z]+#",$_POST[$passname])) {
        return false;
    }
    elseif(!preg_match("#[a-z]+#",$_POST[$passname])) {
        return false;
    }
    $user_entered_password = $POST[$passname];
    $hashed_password = password_hash($user_entered_password, PASSWORD_ARGON2I);
    $_POST[$passname] = $hashed_password ; // global tho
    return true; 
}

function validateSameNewPassword($POST){
    return isset($POST['npassword']) && isset($POST['ncpassword']) && strcmp($POST['ncpassword'],$POST['npassword']) == 0 ;
}

function validate_passwordErr($POST,$passname){
    // to do
    if (strlen($_POST["password"]) <= '8') {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
    return true; 
}

function validate_email($POST){
    // Remove all illegal characters from email
    if(!isset($POST['email'])){
        return false;
    }
    $email = filter_var($POST['email'], FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_sex($POST){
    return isset($POST['sex']);
}

function validate_phone($POST){
    // to do
    return true;
}

function validate_birthdate($POST){
    return isset($POST['birthdate']);
}
function validate_signup($POST){
    return (validateString($POST,'username') && validate_password($POST,'password') && validateString($POST,'fname') && validateString($POST,'lname') && 
    validate_email($POST) && validate_sex($POST,'sex') && validate_birthdate($POST,'birthdate'));
}

function validateUpdateProfile($POST){
    return validateString($POST,'fname') && validateString($POST,'lname') && 
    validate_email($POST) && validate_phone($POST) && validate_sex($POST,'sex')&& validate_birthdate($POST,'birthdate');
}

function validateLogin($POST){
    return (validateString($POST,'username') && validate_password($POST,'password'));
}

function validateProfilePhoto($FILES){
    return isset($_FILES['myImage']['tmp_name']) && $_FILES['myImage']['size']< 10000000  && $_FILES['myImage']['size'] > 0;
}

function sessionHandler($SESSION){
    return true;
}

function validatePassword($POST){
    return validateSameNewPassword($POST) && 
    true;
}

function validateHotel($POST){
    return validateString($POST,'hname') && validateString($POST,'hdesc') && validateString($POST,'haddr') && validate_phone($POST);
}

?>