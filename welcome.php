<?php 

session_start();
include("mysqli_connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Murni Bus.Com</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">    
</head>
<body>
    <header>
    <div class="wrapper">
        <div class="logo">
            <img src="https://i.postimg.cc/4Nz3q2jm/logo.png" alt="">
        </div>
            <ul class="nav-area">
             <li><a href="home.html">Home</a></li>
             <li><a href="dashboard.php">Dashboard</a></li>
             <li><a href="booking.php">Book Now</a></li>
             <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

         <div class="welcome-text">
              <h1>Welcome and Hi <span><?php echo " " . $_SESSION['username'] . "!"; ?></span></h1>
              <a href="about.html">ABOUT US </a>
         </div>
     </header>
</body>
</html>
