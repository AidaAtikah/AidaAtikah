<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    	<title>Edit Booking - Murni Bus.Com </title>
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

<br><br>
<?php 
include("mysqli_connect.php");

session_start();
if (!isset ($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

?>

<?php
//Check for a valid user ID, through GET or POST:
    if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
        $id = $_GET['id'];
    } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
        $id = $_POST['id'];
    } else { // No valid ID, kill the script. 
        echo '<p class="error"><script>This page has been accessed in error.</p></script>';
        exit();
    }


//Check if the form has been submitted. 
if (isset($_POST['submit'])) {

    $errors = array();

    if (empty($_POST['depart_date'])) {
        $errors[] = '<script>Whoops! You forgot to enter your depart date.</script>';
    } else {
        $depart_date = $_POST['depart_date'];
    }

    if (empty($_POST['Depart_time'])) {
        $errors[] = '<script>Whoops! You forgot to enter your depart time.</script>';
    } else {
        $Depart_time = $_POST['Depart_time'];
    }

    if (empty($_POST['journey'])) {
        $errors[] = '<script>Whoops! You forgot to enter your journey.</script>';
    } else {
        $journey = $_POST['journey'];
    }

    if (empty($_POST['depart_station'])) {
        $errors[] = '<script>Whoops! You forgot to enter your depart station.</script>';
    } else {
        $depart_station = $_POST['depart_station'];
    }

    if (empty($_POST['dest_station'])) {
        $errors[] = '<script>Whoops! You forgot to enter your destination station.</script>';
    } else {
        $dest_station = $_POST['dest_station'];
    }

    if (empty($errors)) { //If everything's OK. 

            $q = "SELECT booking_id FROM busbooking WHERE booking_id ='$id'";
            $r = mysqli_query ($dbc,$q);
            if (mysqli_num_rows($r) == 0){

                //Make the query: 
                $q = "UPDATE busbooking SET depart_date='$depart_date', Depart_time='$Depart_time', journey='$journey'
                ,depart_station='$depart_station',dest_station= '$dest_station' WHERE booking_id='$id' LIMIT 1";
                $r = @mysqli_query ($dbc, $q);
                if (mysqli_affected_rows ($dbc) == 1){ //If it ran OK. 

                    //Print a message: 
                    echo '<script>The data has been successfully edited </script>';

                } else { //If it did not run OK. 
                    echo'<p class="error"><script>The data could not be edited due to a system error. We apologize for any inconvenience.</script></p>'; //Public message.  
                    //echo '<p>' .mysqli_connect_error() .'<br />Query:' .$q. '</p>'; //Debugging message.
                }

            }else { //Already registered. 
                echo'<p class="error"><script>The booking id has already been registered.</script></p>';
            }

    } else{ //Report the errors. 

        echo '<p class="error"><script>The following error(s) occured:<br /></script></p>';
        foreach ($errors as $msg){ //Print each error.
            echo " - $msg<br />\n";
        }
        echo '<p><script> Please try again.</script></p>';

    } //End of it (empty($errors)) IF. 

} // End of submit conditional. 

//Always show the form.. 

//Retrieve user info
$q = "SELECT * FROM busbooking";
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1){ //Valid user ID, show the form. 

    //Get the user's information. 
    $row = mysqli_fetch_array ($r, MYSQLI_NUM);

    echo'
    <!DOCTYPE html>
    <html>
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

	<title>Book Ticket- Murni Bus.Com</title>
    </head>

    <div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight 500;">Edit Booking Details</p>
			<div class="input-group">
				<input type="date" placeholder="Date" name="depart_date" value="' .$row[0] .'"  required>
			</div>
			<div class="input-group">
				<input type="time" placeholder="Time" name="Depart_time" value="' .$row[1] .'"  required>
			</div>

            <div class="input-group">
                <fieldset>
                <label for="journey">Journey</label><p></p>
                <select name="journey" value="' .$row[2] .'" required>>
                         <option value="">Select a journey ...</option>
                         <option value="One Way Trip ">One Way Trip</option>
                         <option value="Round Trip">Round Trip</option>
                 </select>
                </fieldset>
            </div>

			<div class="input-group">
                <fieldset>
                <label for="depart_station">Depart Station</label><p></p>
                <select name="depart_station" value="' .$row[3] .'" required>>
                         <option value="">Select a location ...</option>
                         <option value="Kuala Lumpur">Kuala Lumpur</option>
                         <option value="Putrajaya">Putrajaya</option>
                         <option value="Selangor">Selangor</option>
                         <option value="Negeri Sembilan">Negeri Sembilan</option>
                         <option value="Johor">Johor</option>
                         <option value="Melaka">Melaka</option>
                         <option value="Pahang">Pahang</option>
                         <option value="Terengganu">Terengganu</option>
                         <option value="Kelantan">Kelantan</option>
                         <option value="Penang">Penang</option>
                         <option value="Perak">Perak</option>
                         <option value="Perlis">Perlis</option>
                </select>
                </fieldset>
            </div>
            <div class="input-group">
                <fieldset>
                <label for="dest_station">Destination Station</label><p></p>
                <select name="dest_station" value="' .$row[4] .'" required>>
                         <option value="">Select a location ...</option>
                         <option value="Kuala Lumpur">Kuala Lumpur</option>
                         <option value="Putrajaya">Putrajaya</option>
                         <option value="Selangor">Selangor</option>
                         <option value="Negeri Sembilan">Negeri Sembilan</option>
                         <option value="Johor">Johor</option>
                         <option value="Melaka">Melaka</option>
                         <option value="Pahang">Pahang</option>
                         <option value="Terengganu">Terengganu</option>
                         <option value="Kelantan">Kelantan</option>
                         <option value="Penang">Penang</option>
                         <option value="Perak">Perak</option>
                         <option value="Perlis">Perlis</option>
                </select>
                </fieldset>
                </br>

                <div class="input-group">
				<button name="submit" class="btn">Submit</button>
                <input type="hidden" name="booking_id" value="' .$id. '" />
                </div>

                <p class="login-register-text">Back to Home Page? <a href="home.html">Home Page</a>.</p>
                </form>
    </html>';
			    

} else { //Not a valid user ID.
    echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc); 

?>