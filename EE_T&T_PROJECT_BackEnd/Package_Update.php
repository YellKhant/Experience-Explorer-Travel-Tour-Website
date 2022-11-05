<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if (isset($_SESSION['Staff_ID'])) 
{
	$staffid=$_SESSION['Staff_ID'];
	$select="SELECT * from Staffs where Staff_ID='$staffid'";
	$run=mysqli_query($connect,$select);
	$ret=mysqli_fetch_array($run);
	$staffname=$ret['Name'];
}

if(isset($_POST['btnUpdate'])) 
{
	$txtPackageID=$_POST['txtPackageID'];
	$txtPackageName=$_POST['txtPackageName'];
	$cboPackageType=$_POST['cboPackageType'];
	$cboDuration=$_POST['cboDuration'];
	$numPrice=$_POST['numPrice'];
	$txtStaff=$_POST['txtStaff'];
	
	$update_data="UPDATE Packages
				  SET 
				  Name='$txtPackageName',
				  Type='$cboPackageType',
				  Duration='$cboDuration',
				  Price='$numPrice',
				  Staff_ID='$txtStaff'
				  WHERE Package_ID='$txtPackageID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Package Infromation Successfully Updated!')</script>";
		echo "<script>window.location='Package_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Package Information Update" . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Package_ID'])) 
{
	$txtPackageID=$_GET['Package_ID'];

	$query="SELECT * FROM Packages WHERE Package_ID='$txtPackageID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtPackageID="";
	echo "<script>window.alert('Somthing went wrong | Package_ID not found')</script>";
	echo "<script>window.location='Package_Register.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Package Update</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="" method="post">

<fieldset>
<legend>Package Information Update Form:</legend>

<table>

			<tr>
    <td>Uploader</td>
    <td>:</td>
    <td>
    	<input type="hidden" name="txtStaff" value="<?php echo $staffid ?>" required=""/>
    	<input type="text" value="<?php echo $staffname ?>" readonly/>
    </td>
			</tr>
			<tr>			
				<td>Package Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtPackageName" value="<?php echo $rows['Name'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Package Type</td>
				<td>:</td>
				<td>
					<select name="cboPackageType">
						<option><?php echo $rows['Type'] ?></option>
						<option>Adventure</option>
						<option>Historical</option>
						<option>Environmental</option>
					</select>
				</td>
			</tr>
			<tr>			
				<td>Duration(Days)</td>
				<td>:</td>
				<td>
					<select name="cboDuration">
						<option><?php echo $rows['Duration'] ?></option>
						<option>5</option>
						<option>8</option>
						<option>10</option>
					</select>
				</td>
			</tr>
			<tr>			
				<td>Price(USD)</td>
				<td>:</td>
				<td>
					<input type="Number" name="numPrice" value="<?php echo $rows['Price'] ?>" min="100" max="3000" required=""/>
				</td>
			</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="hidden" name="txtPackageID" value="<?php echo $rows['Package_ID'] ?>" />
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