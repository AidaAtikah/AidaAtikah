<?php 

session_start();
include("mysqli_connect.php");

if (!isset($_SESSION['username'])) {
    header("Location: login_admin.php");
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Welcome Page- Murni Bus.Com</title>
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
             <li><a href="home_admin.html">Home</a></li>
             <li><a href="dashboard_admin.php">Dashboard</a></li>
             <li><a href="logout_admin.php">Logout</a></li>
            </ul>
        </div>

         <div class="welcome-text">
              <h1>Welcome and Hi <span> Admin ! </span></h1>
         </div>
     </header>
</body>
</html>