<?php  
session_start(); //Session Declare
include('Connect.php');
include('Header1.php');

if (!isset($_SESSION['Staff_ID']))
	{
	echo "<script>alert('Please Login an Staff Account');</script>";
	echo "<script>window.location='Home.php';</script>";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Home</title>
</head>
<body>
<form action="#" method="POST">

<h2>Welcome From Staff Home, <?php echo $_SESSION['Name'] . '     ( ' . $_SESSION['PositionStatus']. ' ) '?></h2>
<h3>Have a Nice Day...</h3>

<hr/>

<table>
<tr>
	<td width="170pt">Manage Staffs</td>
	<td width="50pt">:</td>
	<td><a href="Staff_Entry.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Routes</td>
	<td>:</td>
	<td><a href="Route_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Vehicles</td>
	<td>:</td>
	<td><a href="Vehicle_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Hotels</td>
	<td>:</td>
	<td><a href="Hotel_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Packages</td>
	<td>:</td>
	<td><a href="Package_Register.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Schedules</td>
	<td>:</td>
	<td><a href="Schedule.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Manage Bookings</td>
	<td>:</td>
	<td><a href="Booking_Search.php">Here</a></td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>View Payments</td>
	<td>:</td>
	<td><a href="Payment_Search.php">Here</a></td>
</tr>

</table>

</form>
</body>
</html>

<?php include "Footer1.php" ?>