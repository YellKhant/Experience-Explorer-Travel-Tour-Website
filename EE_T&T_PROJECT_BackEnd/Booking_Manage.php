<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtBookingID=$_POST['txtBookingID'];
	$txtStatus=$_POST['cboStatus'];
	$numSub=$_POST['numSub'];
	$numTax=$_POST['numTax'];
	$txtTotal=($numSub + $numTax);
	
	$update_data="UPDATE Bookings
				  SET 
				  Total_Cost='$txtTotal',
				  Status='$txtStatus'
				  WHERE Booking_ID='$txtBookingID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Successfully Saved!')</script>";
		echo "<script>window.location='Booking_Search.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Booking Management." . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Booking_ID'])) 
{
	$txtBookingID=$_GET['Booking_ID'];

	$query="SELECT * FROM Bookings WHERE Booking_ID='$txtBookingID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtBookingID="";
	echo "<script>window.alert('Somthing went wrong | Booking_ID not found')</script>";
	echo "<script>window.location='Booking_Search.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Route Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="" method="post">

<fieldset>
<legend>Booking Detail Information :</legend>

<table>
<tr>
	<td>Booking Date</td>
	<td>
		<input type="text" name="txtBookingDate" value="<?php echo $rows['Booking_Date'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Customer ID</td>
	<td>
		<input type="text" name="txtCustomerID" value="<?php echo $rows['Customer_ID'] ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td>Package Name</td>
	<td>
		<input type="text" name="txtPackageName" value="<?php echo $rows['Package_Name'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Start Date</td>
	<td>
		<input type="text" name="txtStartDate" value="<?php echo $rows['Start_Date'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>End Date</td>
	<td>
		<input type="text" name="txtEndDate" value="<?php echo $rows['End_Date'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Quantity</td>
	<td>
		<input type="text" name="numQuantity" value="<?php echo $rows['Quantity'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Sub Total</td>
	<td>
		<input type="text" name="numSub" value="<?php echo $rows['SubTotal'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Tax</td>
	<td>
		<input type="text" name="numTax" value="<?php echo $rows['Tax'] ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td>Choose Status</td>
	<td>
			<select name="cboStatus">
			<option><?php echo $rows['Status'] ?></option>
			<option>Pending</option>
			<option>Confirmed</option>
			<option>Denied</option>
			<option>Paid</option>
			<option>Expired</option>
		</select>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="txtBookingID" value="<?php echo $rows['Booking_ID'] ?>" />
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