<?php 

include 'mysqli_connect.php';

if (isset($_SESSION['username'])) {
    header("Location:login.php");
    exit();
}
error_reporting(0);

session_start();

?>

<?php

$id= $_SESSION['username'];

$query = "SELECT * FROM customer WHERE username = '$id'";
$row = mysqli_query($dbc,$query);
$show = mysqli_fetch_assoc($row);
$customer_id= $show["customer_id"]; // to get customer id 


if (isset($_POST['submit'])) {
	$depart_date = $_POST['depart_date'];
	$Depart_time= $_POST['Depart_time'];
	$journey = $_POST['journey'];
	$depart_station = $_POST['depart_station'];
	$dest_station = $_POST['dest_station'];

	
    $sql = "SELECT * FROM busbooking WHERE booking_id ='$id'";
    $result = mysqli_query($dbc, $sql);
    if (!$result->num_rows > 0) {
        $sql = "INSERT INTO busbooking (depart_date, Depart_time, journey, depart_station, dest_station)
                VALUES ('$depart_date', '$Depart_time', '$journey', '$depart_station', '$dest_station')";
        $result = mysqli_query($dbc, $sql);
        if ($result) {
            echo "<script>alert('Wow! You successfully booked your ticekt.')</script>";
            $username = "";
            $email = "";
            $f_name = "";
            $l_name = "";
            $mobilehp = "";
            $_POST['password'] = "";
            $_POST['cpassword'] = "";
        } else {
				echo "<script>alert('Whoops! Something Went Wrong.')</script>";
			}
		} else {
			echo "<script>alert('Whoops! Booking ID Already Exists.')</script>";
		}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/login.css"> 
    
	<title>Book Ticket- Murni Bus.Com</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight 800;">Book Ticket</p>
			<div class="input-group">
				<input type="username" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="date" placeholder="Date" name="depart_date" value="<?php echo $depart_date; ?>" required>
			</div>
			<div class="input-group">
				<input type="time" placeholder="Time" name="Depart_time" value="<?php echo $Depart_time; ?>" required>
			</div>

            <div class="input-group">
                <fieldset>
                <label for="journey">Journey</label><p></p>
                <select name='journey' value="<?php echo $journey; ?>" required>>
                         <option value="">Select a journey ...</option>
                         <option value="One Way Trip ">One Way Trip</option>
                         <option value="Round Trip">Round Trip</option>
                 </select>
                </fieldset>
            </div>

			<div class="input-group">
                <fieldset>
                <label for="depart_station">Depart Station</label><p></p>
                <select name='depart_station' value="<?php echo $depart_station; ?>" required>>
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
                <select name='dest_station' value="<?php echo $dest_station; ?>" required>>
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
				<button name="submit" class="btn">Book Ticket</button>
			</div>
			<p class="login-register-text">Back to Home Page? <a href="home.html">Home Page</a>.</p>
		</form>
	</div>
</body>
</html>