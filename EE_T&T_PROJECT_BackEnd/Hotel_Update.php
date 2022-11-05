<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtHotelID=$_POST['txtHotelID'];
	$txtHotel=$_POST['txtHotel'];
	$txtLocation=$_POST['txtLocation'];
	$cboServiceLevel=$_POST['cboServiceLevel'];
	
	$update_data="UPDATE Hotels
				  SET 
				  Name='$txtHotel',
				  Location='$txtLocation',
				  ServiceLevel='$cboServiceLevel'
				  WHERE Hotel_ID='$txtHotelID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Hotel Infromation Successfully Updated!')</script>";
		echo "<script>window.location='Hotel_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Hotel Information Update" . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Hotel_ID'])) 
{
	$txtHotelID=$_GET['Hotel_ID'];

	$query="SELECT * FROM Hotels WHERE Hotel_ID='$txtHotelID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtHotelID="";
	echo "<script>window.alert('Somthing went wrong | Hotel_ID not found')</script>";
	echo "<script>window.location='Hotel_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Hotel Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="" method="post">

<fieldset>
<legend>Hotel Information Update Form:</legend>

<table>
			<tr>			
				<td>Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtHotel" value="<?php echo $rows['Name'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Location</td>
				<td>:</td>
				<td>
					<input type="text" name="txtLocation" value="<?php echo $rows['Location'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Service Level</td>
				<td>:</td>
				<td>
					<select name="cboServiceLevel">
						<option><?php echo $rows['ServiceLevel'] ?></option>
						<option>3 Stars</option>
						<option>4 Stars</option>
						<option>5 Stars</option>
					</select>
				</td>
			</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="hidden" name="txtHotelID" value="<?php echo $rows['Hotel_ID'] ?>" />
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