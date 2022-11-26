
<div class="header">
  <div class="links">
    <ul>
      <li><a class="link" href="../hotel/hotelBrowse.php"  style ="text-decoration: none;">Look for Hotel</a></li>
            <li><a class="link" href="../hotel/MyHotel.php"  style ="text-decoration: none;">My Hotel</a></li>
            <li><a class="link" href="#"  style ="text-decoration: none;">Notifications</a></li>
            <?php 
                if(isset($_SESSION['user_id'])){
                    echo '<li><a class="link" href="../myaccount/profile.php" style ="text-decoration: none;">My Account</a></li>
                            <li><a class="link" href="../login/logout.php" style ="text-decoration: none;" >Log out</a></li>';
                }else{
                    echo '<li><a class="link" href="../login/login.php" style ="text-decoration: none;">Login</a></li>';
                    echo '<li><a class="link" href="../login/signup.php" style ="text-decoration: none;">Signup</a></li>';
                }
                ?>
    </ul>
  </div>
  <div class="home">
    <h1><a href="../hotel/hotelBrowse.php">H & S</a></h1>
  </div>
  <div class="search">
    <form action="../hotel/hotelBrowse.php">
      <input class="search" type="text" placeholder="Search.." id="search" name="search">
      <input class="searchimg" type="image" src="../img/search.png" alt="Submit" width="30" height="30">
      </form>
  </div>
</div>
  
  
  




        
            