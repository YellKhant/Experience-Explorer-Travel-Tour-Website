<?php  
session_start();
include('Connect.php');

$StaffID=$_GET['Staff_ID'];

$delete="DELETE FROM Staffs WHERE Staff_ID='$StaffID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Staff Account Successfully Deleted!')</script>";
	echo "<script>window.location='Staff_Entry.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleting Staff Account." . mysqli_error($connect) . "</p>";
}
?>