<?php  
session_start();
include('Connect.php');

$VehicleID=$_GET['Vehicle_ID'];

$delete="DELETE FROM Vehicles WHERE Vehicle_ID='$VehicleID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Vehicle Profile Successfully Deleted!')</script>";
	echo "<script>window.location='Vehicle_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Vehicle Profile" . mysqli_error($connect) . "</p>";
}
?>