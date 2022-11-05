<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtStaffID=$_POST['txtStaffID'];
	$txtStaffName=$_POST['txtStaffName'];
	$txtPassword=$_POST['txtPassword'];
	$cboPositionStatus=$_POST['cboPositionStatus'];
	$txtEMail=$_POST['txtEMail'];
	$txtPhoneNumber=$_POST['txtPhoneNumber'];
	$txtAddress=$_POST['txtAddress'];

	//Update Staff Data in table
	$update_data="UPDATE Staffs
				  SET 
				  Name='$txtStaffName',
				  Password='$txtPassword',
				  PositionStatus='$cboPositionStatus',
				  EMail='$txtEMail',
				  PhoneNumber='$txtPhoneNumber',
				  Address='$txtAddress'
				  WHERE Staff_ID='$txtStaffID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Staff Account Successfully Updated!')</script>";
		echo "<script>window.location='Staff_Entry.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Staff Update" . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Staff_ID'])) 
{
	$txtStaffID=$_GET['Staff_ID'];

	$query="SELECT * FROM Staffs WHERE Staff_ID='$txtStaffID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtStaffID="";
	echo "<script>window.alert('Somthing went wrong | Staff_ID not found')</script>";
	echo "<script>window.location='Staff_Entry.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Staff Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="Staff_Update.php" method="post" enctype="multipart/form-data">

Go back to Staff Home From >><a href="Staff_Home.php">Here</a><<

<fieldset>
<legend>Staff Information Update Form:</legend>

<table>
<tr>
	<td>Staff Name</td>
	<td>:</td>
	<td>
		<input type="text" name="txtStaffName" value="<?php echo $rows['Name'] ?>" required />
	</td>
</tr>
			<tr>			
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="Password" name="txtPassword" value="<?php echo $rows['Password'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Position Status</td>
				<td>:</td>
				<td>
					<select name="cboPositionStatus">
						<option><?php echo $rows['PositionStatus'] ?></option>
						<option>Website Admin</option>
						<option>Marketing Manager</option>
						<option>Receptionist</option>
					</select>
				</td>
			</tr>
<tr>
	<td>E-Mail</td>
	<td>:</td>
	<td>
		<input type="email" name="txtEMail" value="<?php echo $rows['EMail'] ?>" required />
	</td>
</tr>
<tr>
	<td>PhoneNumber</td>
	<td>:</td>
	<td>
		<input type="text" name="txtPhoneNumber" value="<?php echo $rows['PhoneNumber'] ?>" required />
	</td>
</tr>
<tr>
	<td>Address</td>
	<td>:</td>
	<td>
		<textarea name="txtAddress" required="">
			<?php echo $rows['Address'] ?>
		</textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="hidden" name="txtStaffID" value="<?php echo $rows['Staff_ID'] ?>" />
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
