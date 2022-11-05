<?php  
session_start(); //Session Declare
include('Connect.php');
include('Header.php');
include('AutoID_Function.php');

if (!isset($_SESSION['Customer_ID']))
	{
	echo "<script>alert('Please Login Or Register Account And Comeback again...');</script>";
	echo "<script>window.location='Customer_Login.php';</script>";
	}

	if(isset($_REQUEST['PkID']))
	{
		$PackageID=$_REQUEST['PkID'];
		$Package="SELECT pa.*, sc.*
		FROM Packages pa, Schedules sc
		WHERE pa.Package_ID='$PackageID'
		AND pa.Package_ID=sc.Package_ID";
		$result=mysqli_query($connect,$Package);
		$arr=mysqli_fetch_array($result);
	}

if (isset($_POST['btnBook']))
{
	$txtBookingID=$_POST['txtBookingID'];
	$txtBookingDate=$_POST['txtBookingDate'];
	$txtPackageName=$_POST['txtPackageName'];
	$txtScheduleID=$_POST['txtScheduleID'];
	$txtStartDate=$_POST['txtStartDate'];
	$txtEndDate=$_POST['txtEndDate'];
	$numPkPrice=$_POST['numPkPrice'];
	$numQuantity=$_POST['numQuantity'];
	$txtCustomerID=$_POST['txtCustomerID'];
	$txtEmail=$_POST['txtEmail'];
	$txtPhoneNumber=$_POST['txtPhoneNumber'];
	$txtStatus='Pending';

	$txtSubtotal=($numPkPrice * $numQuantity);
	$txtTax=$txtSubtotal * 0.05;

	$insert="INSERT INTO Bookings 
	(Booking_ID,Booking_Date,Package_Name,Schedule_ID,Start_Date,End_Date,Price,Quantity,Customer_ID,E_Mail,Phone_Number,Status,SubTotal,Tax) VALUES 
	('$txtBookingID','$txtBookingDate','$txtPackageName','$txtScheduleID','$txtStartDate','$txtEndDate','$numPkPrice','$numQuantity','$txtCustomerID','$txtEmail','$txtPhoneNumber','$txtStatus','$txtSubtotal','$txtTax')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Booking Process Successfully Finished :-D')</script>";
		echo "<script>window.location='Home.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Booking :-(".mysqli_error($connect)."</p>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking Form</title>
</head>
<body>
<form action="" method="post">
<fieldset>
<legend>Booking Form :</legend>

<table>
<tr>
	<td>Booking ID</td>
	<td>
		<input type="text" name="txtBookingID" value="<?php echo AutoID('Bookings','Booking_ID','Bk-',6) ?>" readonly />
	</td>
</tr>
<tr>
	<td>Booking Date</td>
	<td>
		<input type="text" name="txtBookingDate" value="<?php echo date('d-m-Y') ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="txtPackageID" value="<?php echo $arr['Package_ID']; ?>" readonly />
	</td>
</tr>
<tr>
	<td>Package Name</td>
	<td>
		<input type="text" name="txtPackageName" value="<?php echo $arr['Name']; ?>" readonly />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="txtScheduleID" value="<?php echo $arr['Schedule_ID']; ?>" readonly />
	</td>
</tr>
<tr>
	<td>Start Date</td>
	<td>
		<input type="text" name="txtStartDate" value="<?php echo $arr['Start_Date']; ?>" readonly />
	</td>
</tr>
<tr>
	<td>End Date</td>
	<td>
		<input type="text" name="txtEndDate" value="<?php echo $arr['End_Date']; ?>" readonly />
	</td>
</tr>
<tr>
	<td>Package Price (USD)</td>
	<td>
		<input type="text" name="numPkPrice" value="<?php echo $arr['Price']; ?>" readonly />
	</td>
</tr>
<tr>
	<td>Quantity</td>
	<td>
		<input type="number" name="numQuantity" min="1" max="100" value="1" required />
	</td>
</tr>
<tr>
	<td colspan="2">
		<hr/>
	</td>
</tr>
<tr>
	<td>Please Fill Customer</td>
	<td>Information Here:</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="hidden" name="txtCustomerID" value="<?php echo $_SESSION['Customer_ID'] ?>" />
	</td>
</tr>
<tr>
	<td>First Name</td>
	<td>
		<input type="text" name="txtFirstName" value="<?php echo $_SESSION['FirstName'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Last Name</td>
	<td>
		<input type="text" name="txtLastName" value="<?php echo $_SESSION['LastName'] ?>" readonly />
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
		<input type="email" name="txtEmail" value="<?php echo $_SESSION['EMail'] ?>" required/>
	</td>
</tr>
<tr>
	<td>Phone Number</td>
	<td>
		<input type="text" name="txtPhoneNumber" value="<?php echo $_SESSION['PhoneNumber'] ?>" required/>
	</td>
</tr>

<tr>
	<td></td>
	<td>
		<input type="submit" name="btnBook" value="Book Now" />
		<input type="reset" name="btnReset" value="Reset" />
	</td>
</tr>

</table>
</fieldset>

</form>
</body>
</html>

<?php include "Footer.php" ?>