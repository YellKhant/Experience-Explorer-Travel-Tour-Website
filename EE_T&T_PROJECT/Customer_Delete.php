<?php  
session_start();
include('Connect.php');

$CustomerID=$_SESSION['Customer_ID'];

$delete="DELETE FROM Customers WHERE Customer_ID='$CustomerID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Customer Account Successfully Deleted!')</script>";
	echo "<script>window.location='Customer_Entry.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Customer Account." . mysqli_error($connect) . "</p>";
}
?>