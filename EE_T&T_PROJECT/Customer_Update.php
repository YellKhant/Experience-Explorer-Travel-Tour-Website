<?php 
session_start();
include('Connect.php');
include('Header.php');

if (!isset($_SESSION['Customer_ID'])) 
	{
		echo "<script>alert('Please Login Account.');</script>";
		echo "<script>window.location='Customer_Login.php';</script>";
	}

if (isset($_SESSION['Customer_ID'])) 
{
	$userid=$_SESSION['Customer_ID'];
	$select="SELECT * from Customers where Customer_ID='$userid'";
	$run=mysqli_query($connect,$select);
	$ret=mysqli_fetch_array($run);
	$FirstName=$ret['FirstName'];
	$LastName=$ret['LastName'];
	$Password=$ret['Password'];
	$EMail=$ret['EMail'];
	$PhoneNumber=$ret['PhoneNumber'];
	$Nationality=$ret['Nationality'];
	$Address=$ret['Address'];
}

if (isset($_POST['btnupdate']))
{
	$txtCustomerID=$_POST['txtCustomerID'];
	$txtFirstName=$_POST['txtFirstName'];
	$txtLastName=$_POST['txtLastName'];
	$txtPassword=$_POST['txtPassword'];
	$txtEMail=$_POST['txtEMail'];
	$txtPhoneNumber=$_POST['txtPhoneNumber'];
	$txtNationality=$_POST['txtNationality'];
	$txtAddress=$_POST['txtAddress'];

	$Update="UPDATE Customers
			 Set FirstName='$txtFirstName',
			 LastName='$txtLastName',
			 Password='$txtPassword',
			 EMail='$txtEMail',
			 PhoneNumber='$txtPhoneNumber',
			 Nationality='$txtNationality',
			 Address='$txtAddress'
			 where Customer_ID='$txtCustomerID'";

	$insert="INSERT INTO Customers 
	(Customer_ID,FirstName,LastName,Password,EMail,PhoneNumber,Nationality,Address) VALUES 
	('$txtCustomerID','$txtFirstName','$txtLastName','$txtPassword','$txtEMail','$txtPhoneNumber','$txtNationality','$txtAddress')";


	$runupdate=mysqli_query($connect,$Update);

	if ($runupdate) 
	{
		echo "<script>alert('Account Update Successful')</script>";
		echo "<script>window.location='Customer_Update.php'</script>";
	}
	else
	{
		echo "<script>alert('Something Went Wrong In Updating Profile.')</script>";
		echo "<script>window.location='Customer_Update.php'</script>";
	}
}

 ?>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <form action="" method="POST">
 	<fieldset>
		<legend> Update/Delete Your Account From Here: </legend>	
		<table>
			<tr>			
				<td>ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtCustomerID" value="<?php echo $userid ?>" readonly />
				</td>
			</tr>
			<tr>			
				<td>First Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtFirstName" value="<?php echo $FirstName ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Last Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtLastName" value="<?php echo $LastName ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Password</td>
				<td>:</td>
				<td>
					<input type="password" name="txtPassword" value="<?php echo $Password ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>E-Mail</td>
				<td>:</td>
				<td>
					<input type="email" name="txtEMail" value="<?php echo $EMail ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Phone Number</td>
				<td>:</td>
				<td>
					<input type="text" name="txtPhoneNumber" value="<?php echo $PhoneNumber ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Nationality</td>
				<td>:</td>
				<td>
					<input type="text" name="txtNationality" value="<?php echo $Nationality ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Current Address</td>
				<td>:</td>
				<td>
					<textarea name="txtAddress" required=""/>
						<?php echo $Address ?>
					</textarea>
				</td>
			</tr>
			<tr>
				<td>
					<a href='Customer_Delete.php'> Delete Account </a>
				</td>			
				<td></td>			
				<td>
					<input type="submit" value="Update" name="btnupdate" required=""/>
					<input type="reset" value="Reset" name="btnClear" required=""/>
				</td>
			</tr>
		</table>
	</fieldset>
 </form>
 </body>
 </html>

<?php include "Footer.php" ?>