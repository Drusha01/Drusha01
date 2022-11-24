
<div class="navbar">
    <h1><a href="../hotel/hotelBrowse.php"  style ="text-decoration: none;">Hotel Reservation</a></h1>
    <ul>
        <li><a href="../hotel/hotelBrowse.php"  style ="text-decoration: none;">Look for Hotel</a></li>
        <li><a href="../hotel/AddHotel.php"  style ="text-decoration: none;">My Hotel</a></li>
        <li><a href="#"  style ="text-decoration: none;">My bookings</a></li>
        <li><a href="#"  style ="text-decoration: none;">Notifications</a></li>
        
        <?php 
            if(isset($_SESSION['user_id'])){
                echo '<li><a href="../myaccount/profile.php" style ="text-decoration: none;">My Account</a></li>
                        <li><a href="../login/logout.php" style ="text-decoration: none;" >Log out</a></li>';
            }else{
                echo '<li><a href="../login/login.php" style ="text-decoration: none;">Login</a></li>';
            }
        ?>




        
            