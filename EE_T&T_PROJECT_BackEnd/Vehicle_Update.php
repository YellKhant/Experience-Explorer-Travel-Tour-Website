<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtVehicleID=$_POST['txtVehicleID'];
	$rdoDriver=$_POST['rdoDriver'];
	$txtVehicle=$_POST['txtVehicle'];
	$txtLicense=$_POST['txtLicense'];
	$numNumberOfSeats=$_POST['numNumberOfSeats'];
	
	$update_data="UPDATE Vehicles
				  SET 
				  DriverName='$rdoDriver',
				  VehicleName='$txtVehicle',
				  LicenseNumber='$txtLicense',
				  NumberOfSeats='$numNumberOfSeats'
				  WHERE Vehicle_ID='$txtVehicleID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Vehicle Infromation Successfully Updated!')</script>";
		echo "<script>window.location='Vehicle_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Vehicle Information Update" . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Vehicle_ID'])) 
{
	$txtVehicleID=$_GET['Vehicle_ID'];

	$query="SELECT * FROM Vehicles WHERE Vehicle_ID='$txtVehicleID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtVehicleID="";
	echo "<script>window.alert('Somthing went wrong | Vehicle_ID not found')</script>";
	echo "<script>window.location='Vehicle_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Vehicle Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="" method="post">

<fieldset>
<legend>Vehicle Information Update Form:</legend>

<table>
			<tr>			
				<td>Driver Name</td>
				<td></td>
				<td>
					<input name="rdoDriver" type="radio" value="<?php echo $rows['DriverName'] ?>" checked>
					<input name="rdoDriver" type="radio" value="Mr. John"> Mr. John 
					<input name="rdoDriver" type="radio" value="Mr. Smith"> Mr. Smith 
					<input name="rdoDriver" type="radio" value="Mr. Steve"> Mr. Steve 
					<input name="rdoDriver" type="radio" value="Mr. Nick"> Mr. Nick 
					<input name="rdoDriver" type="radio" value="Mr. Joe"> Mr. Joe
				</td>
			</tr>
			<tr>			
				<td>Vehicle Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtVehicle" value="<?php echo $rows['VehicleName'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>License Number</td>
				<td>:</td>
				<td>
					<input type="text" name="txtLicense" value="<?php echo $rows['LicenseNumber'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Number of Seats</td>
				<td>:</td>
				<td>
					<input type="number" name="numNumberOfSeats" value="<?php echo $rows['NumberOfSeats'] ?>" min="20" max="60" required=""/>
				</td>
			</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="hidden" name="txtVehicleID" value="<?php echo $rows['Vehicle_ID'] ?>" />
		<input type="submit" value="Update" name="btnUpdate"/>
		<input type="reset" value="Reset" />
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php include "Footer1.php" ?>