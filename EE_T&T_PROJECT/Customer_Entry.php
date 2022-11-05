<?php 
session_start();
include ('Connect.php');
include ('AutoID_Function.php');
include ('Header.php');

if (isset($_POST['btnSave']))
{
	$txtCustomerID=$_POST['txtCustomerID'];
	$txtFirstName=$_POST['txtFirstName'];
	$txtLastName=$_POST['txtLastName'];
	$txtPassword=$_POST['txtPassword'];
	$txtEMail=$_POST['txtEMail'];
	$txtPhoneNumber=$_POST['txtPhoneNumber'];
	$txtNationality=$_POST['txtNationality'];
	$txtAddress=$_POST['txtAddress'];
	
	$fileCustomerImage=$_FILES['fileCustomerImage']['name'];
    $Folder="Image/Customer_Images/";


    $filename=$Folder . "_" . $fileCustomerImage;
    $copy=copy($_FILES['fileCustomerImage']['tmp_name'], $filename);
    if(!$copy)
    {
        echo "<p>Cannot upload Customer Image.</p>";
        exit();
    }


	$check_email="SELECT * FROM Customers WHERE EMail='$txtEMail'";
	$result=mysqli_query($connect,$check_email);
	$count=mysqli_num_rows($result);

	if ($count > 0) 
	{
		echo "<script>window.alert('Customer E-Mail is already exist :-(')</script>";
		echo "<script>window.location='Customer_Entry.php'</script>";
		exit();
	}

	$insert="INSERT INTO Customers 
	(Customer_ID,FirstName,LastName,Password,EMail,PhoneNumber,Nationality,Address,Image) VALUES 
	('$txtCustomerID','$txtFirstName','$txtLastName','$txtPassword','$txtEMail','$txtPhoneNumber','$txtNationality','$txtAddress','$filename')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Customer Account Successfully Created :-D')</script>";
		echo "<script>window.location='Customer_Login.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Customer Entry :-(".mysqli_error($connect)."</p>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Entry</title>
</head>
<body>

<form action="Customer_Entry.php" method="POST" enctype="multipart/form-data">
	
	<fieldset>
		<legend> Please Fill Your Information To Register: </legend>	
		<table>
			<tr>			
				<td>ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtCustomerID" value="<?php echo AutoID('Customers','Customer_ID','Cu-',6) ?>" required readonly />
				</td>
			</tr>
			<tr>			
				<td>First Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtFirstName" placeholder="Enter Your First Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Last Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtLastName" placeholder="Enter Your Last Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="txtPassword" placeholder="**********" required=""/>
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
				<td>Nationality</td>
				<td>:</td>
				<td>
					<input type="text" name="txtNationality" placeholder="Enter Your Country" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Current Address</td>
				<td>:</td>
				<td>
					<textarea name="txtAddress" required=""/></textarea>
				</td>
			</tr>
			<tr>			
				<td>Choose An Image</td>
				<td>:</td>
				<td>
					<input type="file" name="fileCustomerImage" required=""/>
				</td>
			</tr>
			<tr>
				<td></td>			
				<td></td>			
				<td>
					<input type="submit" value="Sign-Up" name="btnSave" required=""/>
					<input type="reset" value="Clear" name="btnClear" required=""/>
				</td>
			</tr>
		</table>
	</fieldset>
	
</form>

</body>
</html>
<?php include "Footer.php" ?>