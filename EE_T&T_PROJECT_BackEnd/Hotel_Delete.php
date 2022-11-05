<?php  
session_start();
include('Connect.php');

$HotelID=$_GET['Hotel_ID'];

$delete="DELETE FROM Hotels WHERE Hotel_ID='$HotelID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Hotel Profile Successfully Deleted!')</script>";
	echo "<script>window.location='Hotel_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleteing Hotel Profile" . mysqli_error($connect) . "</p>";
}
?>