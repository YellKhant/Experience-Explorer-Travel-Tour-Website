<?php  
session_start();
include('Connect.php');

$PackageID=$_GET['Package_ID'];

$delete="DELETE FROM Packages WHERE Package_ID='$PackageID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Package Successfully Deleted!')</script>";
	echo "<script>window.location='Package_Register.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Package." . mysqli_error($connect) . "</p>";
}
?>