<?php 
session_start();
include ('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if (isset($_POST['btnSave']))
{
	$txtHotelID=$_POST['txtHotelID'];
	$txtHotel=$_POST['txtHotel'];
	$txtLocation=$_POST['txtLocation'];
	$cboServiceLevel=$_POST['cboServiceLevel'];

	//Image Upload Coding Start--------------------------------------
	$txtImage1=$_FILES['txtImage1']['name']; //Shirt1.jpg
	$Folder="Image/Hotel_Images/";

	$filename1=$Folder . '_' . $txtImage1; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage1']['tmp_name'], $filename1);

	if(!$copied) 
	{
		echo "<p>Image 1 cannot upload!</p>";
		exit();
	}
	//======================================================
	$txtImage2=$_FILES['txtImage2']['name']; //Shirt1.jpg
	$Folder="Image/Hotel_Images/";

	$filename2=$Folder . '_' . $txtImage2; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage2']['tmp_name'], $filename2);

	if(!$copied) 
	{
		echo "<p>Image 2 cannot upload!</p>";
		exit();
	}
	//======================================================
	$txtImage3=$_FILES['txtImage3']['name']; //Shirt1.jpg
	$Folder="Image/Hotel_Images/";

	$filename3=$Folder . '_' . $txtImage3; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage3']['tmp_name'], $filename3);

	if(!$copied) 
	{
		echo "<p>Image 3 cannot upload!</p>";
		exit();
	}
	//Image Upload Coding End--------------------------------------
	
	$insert="INSERT INTO Hotels
	(Hotel_ID,Name,Location,ServiceLevel,Image1,Image2,Image3) VALUES
	('$txtHotelID','$txtHotel','$txtLocation','$cboServiceLevel','$filename1','$filename2','$filename3')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Hotel Successfully Registered :-D')</script>";
		// echo "<script>window.location='.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Hotel Registeration :-(".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Hotel Register</title>

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

<form action="Hotel_Register.php" method="POST" enctype="multipart/form-data">

	Go to Staff Home From >><a href="Staff_Home.php">Here</a><<
	
	<fieldset>
		<legend>Hotel Register Form: </legend>
		<table>
			<tr>
				<td>ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtHotelID" value="<?php echo AutoID('Hotels','Hotel_ID','Ho-',6) ?>" required readonly />
				</td>
			</tr>
			<tr>			
				<td>Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtHotel" placeholder="Enter Hotel Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Location</td>
				<td>:</td>
				<td>
					<input type="text" name="txtLocation" placeholder="Enter Location" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Service Level</td>
				<td>:</td>
				<td>
					<select name="cboServiceLevel">
						<option>3 Stars</option>
						<option>4 Stars</option>
						<option>5 Stars</option>
					</select>
				</td>
			</tr>
			<tr>			
				<td>Upload Image 1</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage1" required="" />
				</td>
			</tr>
			<tr>			
				<td>Upload Image 2</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage2" required="" />
				</td>
			</tr>
			<tr>			
				<td>Upload Image 3</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage3" required="" />
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
<legend>Hotel Listing :</legend>

<table id="tableid" class="display" border="1">
<thead  align='center'>
<tr>
	<th>Hotel ID</th>
	<th>Overall view</th>
	<th>Front view</th>
	<th>Inside view</th>
	<th>Name</th>
	<th>Service Level</th>
	<th>Location</th>
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php
	
	$h_select="SELECT * FROM Hotels";
	$h_ret=mysqli_query($connect,$h_select);
	$h_count=mysqli_num_rows($h_ret);

	for($i=0;$i<$h_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($h_ret);
		$HotelID=$rows['Hotel_ID'];
		$h1_Image=$rows['Image1'];
		$h2_Image=$rows['Image2'];
		$h3_Image=$rows['Image3'];

		echo "<tr>";
			echo "<td  align='center'>$HotelID</td>";
			echo "<td  align='center'><img src='$h1_Image' width='120px' height='100px'/></td>";
			echo "<td  align='center'><img src='$h2_Image' width='120px' height='100px'/></td>";
			echo "<td  align='center'><img src='$h3_Image' width='120px' height='100px'/></td>";
			echo "<td  align='center'>" . $rows['Name'] . "</td>";
			echo "<td  align='center'>" . $rows['ServiceLevel'] . "</td>";
			echo "<td  align='center'>" . $rows['Location'] . "</td>";
			echo "<td  align='center'>
				  <a href='Hotel_Update.php?Hotel_ID=$HotelID'>Edit</a> |
				  <a href='Hotel_Delete.php?Hotel_ID=$HotelID'>Delete</a>
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