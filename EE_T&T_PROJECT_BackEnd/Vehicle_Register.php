<?php 
session_start();
include ('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if (isset($_POST['btnSave']))
{
	$txtVehicleID=$_POST['txtVehicleID'];
	$rdoDriver=$_POST['rdoDriver'];
	$txtVehicle=$_POST['txtVehicle'];
	$txtLicense=$_POST['txtLicense'];
	$numNumberOfSeats=$_POST['numNumberOfSeats'];

	$txtImage=$_FILES['txtImage']['name']; //Shirt1.jpg
	$Folder="Image/Vehicle_Images/";

	$filename=$Folder . '_' . $txtImage; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage']['tmp_name'], $filename);

	if(!$copied) 
	{
		echo "<p>Image cannot upload!</p>";
		exit();
	}

	$check_license="SELECT * FROM Vehicles WHERE LicenseNumber='$txtLicense'";
	$result=mysqli_query($connect,$check_license);
	$count=mysqli_num_rows($result);

	if ($count > 0) 
	{
		echo "<script>window.alert('Vehicle License is already exist :-(')</script>";
		echo "<script>window.location='Vehicle_Register.php'</script>";
		exit();
	}

	$insert="INSERT INTO Vehicles 
	(Vehicle_ID,DriverName,VehicleName,LicenseNumber,NumberOfSeats,Image) VALUES 
	('$txtVehicleID','$rdoDriver','$txtVehicle','$txtLicense','$numNumberOfSeats','$filename')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Vehicle Successfully Registered :-D')</script>";
		// echo "<script>window.location='.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Vehicle Registeration :-(".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Vehicle Register</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>

<script>
	$(document).ready( function (){
		$('#tableid').DataTable();
	} );
</script>

<form action="" method="POST" enctype="multipart/form-data">
	Go back to Staff Home From >><a href="Staff_Home.php">Here</a><<
	
	<fieldset>
		<legend>Vehicle Register Form: </legend>	
		<table>
			<tr>			
				<td>ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtVehicleID" value="<?php echo AutoID('Vehicles','Vehicle_ID','Ve-',6) ?>" required readonly />
				</td>
			</tr>
			<tr>			
				<td>Driver Name</td>
				<td></td>
				<td>
					<input name="rdoDriver" type="radio" value="Mr. John" checked> Mr. John 
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
					<input type="text" name="txtVehicle" placeholder="Enter Vehicle Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>License Number</td>
				<td>:</td>
				<td>
					<input type="text" name="txtLicense" placeholder="Enter License Number" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Number of Seats</td>
				<td>:</td>
				<td>
					<input type="number" name="numNumberOfSeats" value="20" min="20" max="60" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Choose An Image</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage" required />
				</td>
			</tr>
			<tr>			
				<td></td>
				<td></td>
				<td>
					<input type="submit" value="Save" name="btnSave" required=""/>
					<input type="reset" value="Clear" name="btnClear" required=""/>
				</td>
			</tr>
		</table>
	</fieldset>

		<fieldset>
<legend>Vehicle Listing :</legend>

<table id="tableid" class="display" border="1">
<thead align='center'>
<tr>
	<th>Vehicle ID</th>
	<th>Image</th>
	<th>Vehicle Name</th>
	<th>License Number</th>
	<th>Number of Seats</th>
	<th>Driver Name</th>
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php
	
	$v_select="SELECT * FROM Vehicles";
	$v_ret=mysqli_query($connect,$v_select);
	$v_count=mysqli_num_rows($v_ret);

	for($i=0;$i<$v_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($v_ret);
		$VehicleID=$rows['Vehicle_ID'];
		$v_Image=$rows['Image'];

		echo "<tr>";
			echo "<td align='center'>$VehicleID</td>";
			echo "<td align='center'><img src='$v_Image' width='180px' height='100px'/></td>";
			echo "<td align='center'>" . $rows['VehicleName'] . "</td>";
			echo "<td align='center'>" . $rows['LicenseNumber'] . "</td>";
			echo "<td align='center'>" . $rows['NumberOfSeats'] . "</td>";
			echo "<td align='center'>" . $rows['DriverName'] . "</td>";
			echo "<td align='center'>
				  <a href='Vehicle_Update.php?Vehicle_ID=$VehicleID'>Edit</a> |
				  <a href='Vehicle_Delete.php?Vehicle_ID=$VehicleID'>Delete</a>
				  </td>";
		echo "</tr>";
	}

?>
</tbody>
</table>

</fieldset>
	
</form>

</body>
</html>

<?php include "Footer1.php" ?>