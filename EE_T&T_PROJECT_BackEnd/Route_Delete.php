<?php  
session_start();
include('Connect.php');

$RouteID=$_GET['Route_ID'];

$delete="DELETE FROM Routes WHERE Route_ID='$RouteID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Route Successfully Deleted!')</script>";
	echo "<script>window.location='Route_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Route" . mysqli_error($connect) . "</p>";
}
?>