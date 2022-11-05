<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtRouteID=$_POST['txtRouteID'];
	$txtRoute=$_POST['txtRoute'];
	$txtDetail=$_POST['txtDetail'];
	
	$update_data="UPDATE Routes
				  SET 
				  Name='$txtRoute',
				  Detail='$txtDetail'
				  WHERE Route_ID='$txtRouteID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Route Infromation Successfully Updated!')</script>";
		echo "<script>window.location='Route_Register.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Route Information Update" . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Route_ID'])) 
{
	$txtRouteID=$_GET['Route_ID'];

	$query="SELECT * FROM Routes WHERE Route_ID='$txtRouteID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtRouteID="";
	echo "<script>window.alert('Somthing went wrong | Route_ID not found')</script>";
	echo "<script>window.location='Route_Register.php'</script>";
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
<legend>Route Information Update Form:</legend>

<table>
			<tr>			
				<td>Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtRoute" value="<?php echo $rows['Name'] ?>" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Detail</td>
				<td>:</td>
				<td>
					<textarea name="txtDetail" required=""/><?php echo $rows['Detail'] ?></textarea>
				</td>
			</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="hidden" name="txtRouteID" value="<?php echo $rows['Route_ID'] ?>" />
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