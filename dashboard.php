<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    	<title>Dashboard- Murni Bus.Com </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/dashboard.css">

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>


    </head>

    <body>
 
    <div class="wrapper">
        <div class="logo">
            <img src="https://i.postimg.cc/4Nz3q2jm/logo.png" alt="">
        </div>
            <ul class="nav-area">
              <li><a href="home.html">Home</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="about.html">About US</a></li>
            </ul>
    </div>

    <div class="col-md-12">
                    <div class="section-heading">
                        <h2>DASHBOARD - MANAGE BUS BOOKING DETAILS</h2>
                        <p></p>
                    </div>
    </div>

<table>
<tr>
<th>Edit</th>
<th>Delete</th>
<th>Depart Date</th>
<th>Depart Time</th>
<th>Journey</th>
<th>Depart Station</th>
<th>Destination Station</th>
</tr>


<?php

include("mysqli_connect.php");

session_start();

if (!isset ($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}


      $query = "SELECT * FROM busbooking";
      $result = mysqli_query ($dbc, $query); //Run the query.
      $num = mysqli_num_rows($result);

      if ($num > 0){ // If it ran OK, display the records. 

        

        while($row = mysqli_fetch_assoc($result))  {
            echo '<tr>
                  <td align="left"><a href="edit_booking.php?id=' . $row['booking_id'] . '">Edit</a></td>
                  <td align="left"><a href="delete_booking.php?id=' . $row['booking_id'] . '">Delete</a></td>
                  <td align="left">' . $row['depart_date'] . '</td> 
                  <td align="left">' . $row['Depart_time'] . '</td> 
                  <td align="left">' . $row['journey'] . '</td> 
                  <td align="left">' . $row['depart_station'] . '</td> 
                  <td align="left">' . $row['dest_station'] . '</td> 
                  </tr> ';


         }

         echo "</table>";

        mysqli_free_result ($result); // Free up the resources.

    } else { // If it did not run OK. 
        echo "0 results"; 
    }

mysqli_close($dbc); // Close the database connection. 
?>

</table>
</body>
</html>