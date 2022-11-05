<?php  
session_start();
include('Connect.php');

$ScheduleID=$_GET['Schedule_ID'];

$delete="DELETE FROM Schedules WHERE Schedule_ID='$ScheduleID'";
$result=mysqli_query($connect,$delete);

if($result) //True
{
	echo "<script>window.alert('Schedule Successfully Deleted!')</script>";
	echo "<script>window.location='Schedule.php'</script>";
}
else
{
	echo "<p>Something went wrong in Deleteing Schedule" . mysqli_error($connect) . "</p>";
}
?>