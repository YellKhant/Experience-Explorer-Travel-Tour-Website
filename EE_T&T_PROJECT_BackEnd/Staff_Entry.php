<?php 
session_start();
include ('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if (!isset($_SESSION['Staff_ID'])) {
		echo "<script>alert('Access Denied. Please Login Wih Admin Account.');</script>";
		echo "<script>window.location='Home.php';</script>";
	}

if ($_SESSION['PositionStatus'] <> 'Website Admin')
	{
	echo "<script>alert('Access Denied. Please Login With Admin Account.');</script>";
	echo "<script>window.location='Home.php';</script>";
	}

if (isset($_POST['btnSave']))
{
	$txtStaffID=$_POST['txtStaffID'];
	$txtStaffName=$_POST['txtStaffName'];
	$txtPassword=$_POST['txtPassword'];
	$cboPositionStatus=$_POST['cboPositionStatus'];
	$txtEMail=$_POST['txtEMail'];
	$txtPhoneNumber=$_POST['txtPhoneNumber'];
	$txtAddress=$_POST['txtAddress'];

	$fileStaffImage=$_FILES['fileStaffImage']['name'];
    $Folder="Image/Staff_Images/";


    $filename=$Folder . "_" . $fileStaffImage;
    $copy=copy($_FILES['fileStaffImage']['tmp_name'], $filename);
    if(!$copy)
    {
        echo "<p>Cannot upload Staff Image.</p>";
        exit();
    }

	$check_email="SELECT * FROM Staffs WHERE EMail='$txtEMail'";
	$result=mysqli_query($connect,$check_email);
	$count=mysqli_num_rows($result);

	if ($count > 0) 
	{
		echo "<script>window.alert('Staff E-Mail is already exist :-(')</script>";
		echo "<script>window.location='Staff_Entry.php'</script>";
		exit();
	}

	$insert="INSERT INTO Staffs 
	(Staff_ID,Name,Password,PositionStatus,EMail,PhoneNumber,Address,Staff_Image) VALUES 
	('$txtStaffID','$txtStaffName','$txtPassword','$cboPositionStatus','$txtEMail','$txtPhoneNumber','$txtAddress','$filename')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Staff Account Successfully Created :-D')</script>";
		echo "<script>window.location='Staff_Entry.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Staff Entry :-(".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Entry</title>	

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

<form action="Staff_Entry.php" method="POST" enctype="multipart/form-data">
	
Go back to Staff Home From >><a href="Staff_Home.php">Here</a><<

	<fieldset>
		<legend>Staff Register Form:</legend>	
		<table>
			<tr>			
				<td>ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtStaffID" value="<?php echo AutoID('Staffs','Staff_ID','St-',6) ?>" required readonly />
				</td>
			</tr>
			<tr>			
				<td>Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtStaffName" placeholder="Enter Staff Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="Password" name="txtPassword" placeholder="**********" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Position Status</td>
				<td>:</td>
				<td>
					<select name="cboPositionStatus">
						<option>Website Admin</option>
						<option>Marketing Manager</option>
						<option>Tours Manager</option>
						<option>Receptionist</option>
					</select>
				</td>
			</tr>
			<tr>			
				<td>E-Mail</td>
				<td>:</td>
				<td>
					<input type="email" name="txtEMail" placeholder="user@email.com" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Phone Number</td>
				<td>:</td>
				<td>
					<input type="text" name="txtPhoneNumber" placeholder="+95*********" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Address</td>
				<td>:</td>
				<td>
					<textarea name="txtAddress" required=""/></textarea>
				</td>
			</tr>
			<tr>
				<td>Choose An Image</td>
				<td>:</td>
				<td>
					<input type="file" name="fileStaffImage" required=""/>
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
<legend>Staff Listing :</legend>

<table id="tableid" class="display" border="1">
<thead align='center'>
<tr>
	<th>Staff ID</th>
	<th>Profile Picture</th>
	<th>Name</th>
	<th>Position Status</th>
	<th>E-Mail</th>
	<th>Phone Number</th>
	<th>Address</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$staff_select="SELECT * FROM Staffs";
	$staff_ret=mysqli_query($connect,$staff_select);
	$staff_count=mysqli_num_rows($staff_ret);

	for($i=0;$i<$staff_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($staff_ret);
		$StaffID=$rows['Staff_ID'];
		$S_Image=$rows['Staff_Image'];

		echo "<tr>";
			echo "<td align='center'>$StaffID</td>";
			echo "<td align='center'><img src='$S_Image' width='130px' height='130px'/></td>";
			echo "<td align='center'>" . $rows['Name'] . "</td>";
			echo "<td align='center'>" . $rows['PositionStatus'] . "</td>";
			echo "<td align='center'>" . $rows['EMail'] . "</td>";
			echo "<td align='center'>" . $rows['PhoneNumber'] . "</td>";
			echo "<td align='center'>" . $rows['Address'] . "</td>";
			echo "<td align='center'>
				  <a href='Staff_Update.php?Staff_ID=$StaffID'>Edit</a> |
				  <a href='Staff_Delete.php?Staff_ID=$StaffID'>Delete</a>
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