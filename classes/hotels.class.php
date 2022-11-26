<?php 
require_once 'database.php';

Class hotels{

    private $hotel_id;
    private $user_id;
    private $hotel_name;
    private $hotel_status_id;
    private $hotel_background_photo;
    private $hotel_thumbnail_photo;
    private $hotel_description;
    private $hotel_address;
    private $hotel_phone_number;
    private $hotel_location_longitude;
    private $hotel_location_latitude;
    private $hotel_amenity_id;

    // setter and getter
    function setHotel_id($hotel_id){$this->hotel_id = $hotel_id;}
    function setUser_id($user_id){$this->user_id = $user_id;}
    function setHotel_name($hotel_name){$this->hotel_name = $hotel_name;}
    function setHotel_status_id($hotel_status_id){$this->hotel_status_id = $hotel_status_id;}
    function setHotel_background_photo($hotel_background_photo){$this->hotel_background_photo = $hotel_background_photo;}
    function setHotel_thumbnail_photo($hotel_thumbnail_photo){$this->hotel_thumbnail_photo = $hotel_thumbnail_photo;}
    function setHotel_description($hotel_description){$this->hotel_description = $hotel_description;}
    function setHotel_address($hotel_address){$this->hotel_address = $hotel_address;}
    function setHotel_phone_number($hotel_phone_number){$this->hotel_phone_number = $hotel_phone_number;}
    function setHotel_location_longitude($hotel_location_longitude){$this->hotel_location_longitude = $hotel_location_longitude;}
    function setHotel_location_latitude($hotel_location_latitude){$this->hotel_location_latitude = $hotel_location_latitude;}
    function setHotel_amenity_id($hotel_amenity_id){$this->hotel_amenity_id = $hotel_amenity_id;}

    function getHotel_id(){return $this->hotel_id;}
    function getUser_id(){return $this->user_id;}
    function getHotel_name(){return $this->hotel_name;}
    function getHotel_status_id(){return $this->hotel_status_id;}
    function getHotel_background_photo(){return $this->hotel_background_photo;}
    function getHotel_thumbnail_photo(){return $this->hotel_thumbnail_photo;}
    function getHotel_description(){return $this->hotel_description;}
    function getHotel_address(){return $this->hotel_address;}
    function getHotel_phone_number(){return $this->hotel_phone_number;}
    function getHotel_location_longitude(){return $this->hotel_location_longitude;}
    function getHotel_location_latitude(){return $this->hotel_location_latitude;}
    function getHotel_amenity_id(){return $this->hotel_amenity_id;}

    // constructor
    function __construct()
    {
        $this->db = new Database();
    }
    // note that
    function getHotels($index){
        // return only 50 using limit
        $limit = 50;
        $offset = $limit*$index;
        try
        {    
            $sql = "SELECT * from hotels
            ORDER By hotel_id
            LIMIT ".$limit." OFFSET ".$offset.";";
            $query=$this->db->connect()->prepare($sql);
            // $query->bindParam(':varLimit', $limit);
            // $query->bindParam(':varOffset', $offset);
            if($data = $query->execute()){
                $data = $query->fetchAll();
                return $data;
            }
            
        }
        catch (PDOException $e)
        {
            return false;
        }
    } 

    function getUserHotel($user_id){
        try
        {    
            $sql = "SELECT * from hotels
            WHERE user_id=:user_id";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            if($data = $query->execute()){
                $data = $query->fetch();
                return $data;
            }
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    function getHotelDetails($hotel_id){
        try
        {    
            $sql = "SELECT * from hotels
            WHERE hotel_id=:hotel_id";
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':hotel_id', $hotel_id);
            if($data = $query->execute()){
                $data = $query->fetch();
                return $data;
            }
        }
        catch (PDOException $e)
        {
            return false;
        }
    }


}
?>