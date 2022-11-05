<?php  
session_start(); //Session Declare
include('Connect.php');
include('Header.php');

if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$check="SELECT * FROM Staffs
			WHERE EMail='$txtEmail'
			AND Password='$txtPassword'
			";
	$result=mysqli_query($connect,$check); // Run the Query for Email and Password Checking
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);

	// print_r($arr);	Showing array

	if($count < 1) 
	{
		echo "<script>window.alert('Staff Email or Password Incorrect!')</script>";
		echo "<script>window.location='Home.php'</script>";
		exit();
	}
	else
	{
		$_SESSION['Staff_ID']=$arr['Staff_ID'];
		$_SESSION['Name']=$arr['Name'];
		$_SESSION['PositionStatus']=$arr['PositionStatus'];
		echo "<script>window.alert('Login Success.')</script>";
		echo "<script>window.location='Staff_Home.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Login</title>
</head>
<body>
<form action="" method="post">

<fieldset>
<legend>Staff Login Form:</legend>

<table>
<tr>
	<td>E-Mail</td>
	<td>
		<input type="email" name="txtEmail" placeholder="user@email.com" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
		<input type="password" name="txtPassword" placeholder="***********" required />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" value="Login" name="btnLogin"/>
		<input type="reset" value="Clear" />
	</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>

<?php include "Footer1.php" ?>