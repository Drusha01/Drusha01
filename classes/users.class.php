<?php 
require_once 'database.php';

Class users{

    private $user_id;
    private $user_status_id;
    private $user_verified;
    private $user_name;
    private $user_password;
    private $user_firstname;
    private $user_lastname;
    private $user_email;
    private $user_phonenumber;
    private $user_gender;
    private $user_birthdate;
    private $user_photo;
    private $user_address;
    private $user_date_created;
    private $user_date_updated;

    function setUser_id($user_id){$this->user_id = $user_id;}
    function setUser_status_id($user_status_id){$this->user_status_id = $user_status_id;}
    function setUser_verified($user_verified){$this->user_verified = $user_verified;}
    function setUser_name($user_name){$this->user_name = $user_name;}
    function setUser_password($user_password){$this->user_password = $user_password;}
    function setUser_firstname($user_firstname){$this->user_firstname = $user_firstname;}
    function setUser_lastname($user_lastname){$this->user_lastname = $user_lastname;}
    function setUser_email($user_email){$this->user_email = $user_email;}
    function setUser_phonenumber ($user_phonenumber){$this->user_phonenumber = $user_phonenumber;}
    function setUser_gender($user_gender){$this->user_gender = $user_gender;}
    function setUser_birthdate($user_birthdate){$this->user_birthdate = $user_birthdate;}
    function setUser_photo($user_photo){$this->user_photo = $user_photo;}
    function setUser_address($user_address){$this->user_address = $user_address;}
    function setUser_date_created($user_date_created){$this->user_date_created = $user_date_created;}
    function setUser_date_updated($user_date_updated){$this->user_date_updated = $user_date_updated;}

    function getUser_id(){return $this->user_id;}
    function getUser_status_id(){return $this->user_status_id;}
    function getUser_verified(){return $this->user_verified;}
    function getUser_name(){return $this->user_name;}
    function getUser_password(){return $this->user_password;}
    function getUser_firstname(){return $this->user_firstname;}
    function getUser_lastname(){return $this->user_lastname;}
    function getUser_email(){return $this->user_email;}
    function getUser_phonenumber(){return $this->user_phonenumber;}
    function getUser_gender(){return $this->user_gender;}
    function getUser_birthdate(){return $this->user_birthdate;}
    function getUser_photo(){return $this->user_photo;}
    function getUser_address(){return $this->user_address;}
    function getUser_date_created(){return $this->user_date_created;}
    function getUser_date_updated(){return $this->user_date_updated;}



    function __construct()
    {
        $this->db = new Database();
    }

    function validate(){
        $sql = "SELECT * FROM users WHERE BINARY user_name =:user_name ;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_name', $this->user_name);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getUserDetails(){
        $sql = "SELECT user_id, user_status_id, user_verified, user_name, user_firstname, user_lastname, user_email, user_phonenumber,user_gender, user_birthdate,user_photo, user_address, date_created, date_updated FROM users 
        WHERE user_id = (SELECT user_id FROM users WHERE user_name =:user_name);";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_name', $this->user_name);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function getUserHashedPassword($user_id){
        try{
            $sql = "SELECT user_password from users WHERE user_id =:user_id";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            if($query->execute()){
                $data = $query->fetch();
            }
            return $data;
        }
        catch(PDOException $e){
            return false;
        }
    }

    function saveNewPassword($user_id, $hashed_password ){
        try{
            $sql = "UPDATE users  SET user_password =:user_password  WHERE user_id=:user_id;";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_password', $hashed_password);
            return $query->execute();
        }catch(PDOException $e){
            return false;
        }
    }

    function getUserDetailsWithId($user_id){
        $sql = "SELECT user_id, user_status_id, user_verified, user_name, user_firstname, user_lastname, user_email, user_phonenumber,user_gender, user_birthdate,user_photo, user_address, date_created, date_updated FROM users 
        WHERE user_id = (SELECT user_id FROM users WHERE user_id =:user_id);";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_id', $user_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function signUp(){
        try
        {    
            $sql = "INSERT INTO users (user_status_id, user_verified,user_name, user_password, user_firstname, user_lastname, user_email, user_gender, user_birthdate) VALUES(
                :user_status_id,:user_verified,:user_name, :user_password, :user_firstname, :user_lastname, :user_email, :user_gender, :user_birthdate
            )";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_status_id', $this->user_status_id);
            $query->bindParam(':user_verified', $this->user_verified);
            $query->bindParam(':user_name', $this->user_name);
            $query->bindParam(':user_password', $this->user_password);
            $query->bindParam(':user_firstname', $this->user_firstname);
            $query->bindParam(':user_lastname', $this->user_lastname);
            $query->bindParam(':user_email', $this->user_email);
            $query->bindParam(':user_gender', $this->user_gender);
            $query->bindParam(':user_birthdate', $this->user_birthdate);
            $data = $query->execute();
            return $data;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    function userUpdate(){
        $sql = "UPDATE users
        SET user_firstname=:user_firstname, user_lastname =:user_lastname,user_email =:user_email, user_phonenumber =:user_phonenumber,user_gender=:user_gender , user_birthdate =:user_birthdate, user_photo=:user_photo
        WHERE user_id=:user_id;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':user_firstname', $this->user_firstname);
        $query->bindParam(':user_lastname', $this->user_lastname);
        $query->bindParam(':user_email', $this->user_email);
        $query->bindParam(':user_phonenumber', $this->user_phonenumber);
        $query->bindParam(':user_gender', $this->user_gender);
        $query->bindParam(':user_birthdate', $this->user_birthdate);
        $query->bindParam(':user_id', $this->user_id);
        $query->bindParam(':user_photo', $this->user_photo);
        if($data = $query->execute()){
            return $data;
        }else{
            return false;
        }
    }
}

?>