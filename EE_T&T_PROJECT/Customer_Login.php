<?php  
session_start(); //Session Declare
include('Connect.php');
include('Header.php');


if (isset($_SESSION['loginCount']))
	{
	if($_SESSION ['loginCount'] >=3)
	{
		echo "<script> window.alert ('Please Try Again in 10 Minutes')</script>";
		echo "<script> window.location = 'LoginTimer.php'</script>";
	}
	}
	else if (!isset($_SESSION['loginCount']))
	{
	$_SESSION['loginCount']=0;
	}

if(isset($_POST['btnLogin'])) 
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];

	$check="SELECT * FROM Customers
			WHERE EMail='$txtEmail'
			AND Password='$txtPassword'
			";
	$result=mysqli_query($connect,$check); // Run the Query for Email and Password Checking
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);

	// print_r($arr);	Showing array

	if($count < 1) 
	{
		$_SESSION['loginCount']++;
 		echo "<script> window.alert ('Invalid! Login Attempt:".$_SESSION['loginCount']."')</script>";
 		echo" <script>alert ('Invalid User') </script>";
	}
	else
	{
		$_SESSION['Customer_ID']=$arr['Customer_ID'];
		$_SESSION['FirstName']=$arr['FirstName'];
		$_SESSION['LastName']=$arr['LastName'];
		$_SESSION['EMail']=$arr['EMail'];
		$_SESSION['PhoneNumber']=$arr['PhoneNumber'];
		echo "<script>window.alert('Login Success.')</script>";
		echo "<script>window.location='Home.php'</script>";
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
</head>
<body>
<form action="Customer_Login.php" method="post">

<fieldset>
<legend>Customer Login Form:</legend>

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
<?php include "Footer.php" ?>