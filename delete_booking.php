<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    	<title>Delete Booking - Murni Bus.Com </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/about.css">

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
             <li><a href="dashboard.php">Dashboard</a></li>
             <li><a href="booking.php">Book Now</a></li>
             <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>



<br><br>

<?php 
include("mysqli_connect.php");

session_start();
if (!isset ($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$id= $_SESSION['username'];

$query = "SELECT * FROM customer WHERE username = '$id'";
$row = mysqli_query($dbc,$query);
$show = mysqli_fetch_assoc($row);
$customer_id= $show["customer_id"]; // to get customer id


    // Check for a valid user ID, through GET or POST: 
        if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From dashboard.php 
            $booking_id = $_GET['id']; 
        } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission. 
            $booking_id = $_POST['id']; 
        } else { // No valid ID, kill the script. 
            echo '<p class="error">This page has been accessed in error.</p>'; 
          exit(); 
      }    
      
      // Check if the form has been submitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($_POST['sure'] == 'Yes') { // Delete the record.
    
            // Make the query:
            $q =  "DELETE FROM busbooking  WHERE booking_id = '$booking_id'";		
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
    
                // Print a message:
                echo '<p><script>The user has been deleted.</p></script>';	
    
            } else { // If the query did not run OK.
                echo '<p class="error"><script>The user could not be deleted due to a system error.</script></p>'; // Public message.
                echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
            }
        
        } else { // No confirmation of deletion.
            echo '<p><script>The user has NOT been deleted.</p></script>';	
        }

    } else { // Show the form.
    
        // Retrieve the user's information:
        $q = "SELECT CONCAT(busbooking.depart_date, ', ', busbooking.Depart_time,  ', ', busbooking.journey, ', ', busbooking.depart_station, ', ',busbooking.dest_station) 
              FROM busbooking
              INNER JOIN customer ON taxibooking.customer_id = customer.customer_id 
              WHERE busbooking.booking_id = $booking_id ";
        $r = @mysqli_query ($dbc, $q);
    
        if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
    
            // Get the user's information:
            $row = mysqli_fetch_array ($r, MYSQLI_NUM);
            
            // Display the record being deleted:
            echo "<h4>Booking: $row[0]</h4>
            Are you sure you want to delete this booking ?";
            
            // Create the form:
            echo '<form action="delete_booking.php" method="post">
                    <input type="radio" name="sure" value="Yes" /> Yes 
                    <input type="radio" name="sure" value="No" checked="checked" /> No
                    <input type="submit" name="submit" value="Submit" />
                    <input type="hidden" name="id" value="' . $booking_id . '" />
                  </form>';
        
        } else { // Not a valid user ID.
            echo '<p><script>This page has been accessed in error.</p></script>';
        }
    
    } // End of the main submission conditional.
    
  mysqli_close($dbc); //Close the database connection.

?>


</body>
</html>


