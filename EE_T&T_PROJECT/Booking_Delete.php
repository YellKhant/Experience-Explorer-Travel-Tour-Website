<?php  
session_start();
include('Connect.php');

$BookingID=$_GET['BookingID'];

$delete="DELETE FROM Bookings WHERE Booking_ID='$BookingID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Booking Canceled Successfully!!!')</script>";
	echo "<script>window.location='Booking_Display.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Information." . mysqli_error($connect) . "</p>";
}
?>