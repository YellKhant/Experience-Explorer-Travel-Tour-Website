<?php 
session_start();
include ('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if (isset($_POST['btnSave']))
{
	$txtRouteID=$_POST['txtRouteID'];
	$txtRoute=$_POST['txtRoute'];
	$txtDetail=$_POST['txtDetail'];

	$insert="INSERT INTO Routes 
	(Route_ID,Name,Detail) VALUES ('$txtRouteID','$txtRoute','$txtDetail')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Route Successfully Registered :-D')</script>";
		// echo "<script>window.location=''</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Route Registeration :-(".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Route Register</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
</head>
<body>

	<script>
		$(document).ready( function (){
			$('#tableid').DataTable();
		} );
	</script>

<form action="#" method="POST">
	Go to Staff Home From >><a href="Staff_Home.php">Here</a><<
	
	<fieldset>
		<legend>Route Register Form:</legend>	
		<table>
			<tr>			
				<td>ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtRouteID" value="<?php echo AutoID('Routes','Route_ID','Ro-',6) ?>" required readonly/>
				</td>
			</tr>
			<tr>			
				<td>Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtRoute" placeholder="Enter Route Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Detail</td>
				<td>:</td>
				<td>
					<textarea name="txtDetail" required=""/></textarea>
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
<legend>Route Listing :</legend>

<table id="tableid" class="display" border="1">
<thead  align='center'>
<tr>
	<th>Route ID</th>
	<th>Name</th>
	<th>Detail</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$route_select="SELECT * FROM Routes";
	$route_ret=mysqli_query($connect,$route_select);
	$route_count=mysqli_num_rows($route_ret);

	for($i=0;$i<$route_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($route_ret);
		$RouteID=$rows['Route_ID'];

		echo "<tr>";
			echo "<td align='center'>$RouteID</td>";
			echo "<td align='center'>" . $rows['Name'] . "</td>";
			echo "<td align='center'>" . $rows['Detail'] . "</td>";
			echo "<td align='center'>
				  <a href='Route_Update.php?Route_ID=$RouteID'>Edit</a> |
				  <a href='Route_Delete.php?Route_ID=$RouteID'>Delete</a>
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