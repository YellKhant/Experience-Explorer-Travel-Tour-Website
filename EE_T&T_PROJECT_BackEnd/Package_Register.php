<?php 
session_start();
include ('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if (isset($_SESSION['Staff_ID'])) 
{
	$staffid=$_SESSION['Staff_ID'];
	$select="SELECT * from Staffs where Staff_ID='$staffid'";
	$run=mysqli_query($connect,$select);
	$ret=mysqli_fetch_array($run);
	$staffname=$ret['Name'];
}

if (isset($_POST['btnSave']))
{
	$txtPackageID=$_POST['txtPackageID'];
	$txtPackageName=$_POST['txtPackageName'];
	$cboPackageType=$_POST['cboPackageType'];
	$cboDuration=$_POST['cboDuration'];
	$numPrice=$_POST['numPrice'];
	$cboRoute=$_POST['cboRoute'];
	$txtStaff=$_POST['txtStaff'];
	
	$txtImage=$_FILES['txtImage']['name'];
    $Folder="Package_Images/";


    $filename=$Folder . "_" . $txtImage;
    $copy=copy($_FILES['txtImage']['tmp_name'], $filename);
    if(!$copy)
    {
        echo "<p>Cannot upload Image.</p>";
        exit();
    }

	//Image Upload Coding Start--------------------------------------
	$txtImage1=$_FILES['txtImage1']['name']; //Shirt1.jpg
	$Folder="Package_Images/";

	$filename1=$Folder . '_' . $txtImage1; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage1']['tmp_name'], $filename1);

	if(!$copied) 
	{
		echo "<p>Image 1 cannot upload!</p>";
		exit();
	}
	//======================================================
	$txtImage2=$_FILES['txtImage2']['name']; //Shirt1.jpg
	$Folder="Package_Images/";

	$filename2=$Folder . '_' . $txtImage2; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage2']['tmp_name'], $filename2);

	if(!$copied) 
	{
		echo "<p>Image 2 cannot upload!</p>";
		exit();
	}
	//======================================================
	$txtImage3=$_FILES['txtImage3']['name']; //Shirt1.jpg
	$Folder="Package_Images/";

	$filename3=$Folder . '_' . $txtImage3; //StaffImage/_Shirt1.jpg

	$copied=copy($_FILES['txtImage3']['tmp_name'], $filename3);

	if(!$copied) 
	{
		echo "<p>Image 3 cannot upload!</p>";
		exit();
	}
	//Image Upload Coding End--------------------------------------


	$check_name="SELECT * FROM Packages WHERE Name='$txtPackageName'";
	$result=mysqli_query($connect,$check_name);
	$count=mysqli_num_rows($result);

	if ($count > 0) 
	{
		echo "<script>window.alert('This Package name is already exist :-(')</script>";
		echo "<script>window.location='Package_Register.php'</script>";
		exit();
	}

	$insert="INSERT INTO Packages 
	(Package_ID,Name,Type,Duration,Price,Route_ID,Staff_ID,Image,Image1,Image2,Image3) VALUES 
	('$txtPackageID','$txtPackageName','$cboPackageType','$cboDuration','$numPrice','$cboRoute','$txtStaff','$filename','$filename1','$filename2','$filename3')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Package Successfully Registered :-D')</script>";
		echo "<script>window.location='Package_Register.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Package Registeration :-(".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Package Register</title>	

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

<form action="Package_Register.php" method="POST" enctype="multipart/form-data">
	
Go to Staff Home From >><a href="Staff_Home.php">Here</a><<

	<fieldset>
		<legend>Package Register Form: </legend>	
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
				<td>Package ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtPackageID" value="<?php echo AutoID('Packages','Package_ID','Pk-',6) ?>" required readonly />
				</td>
			</tr>
			<tr>			
				<td>Package Name</td>
				<td>:</td>
				<td>
					<input type="text" name="txtPackageName" placeholder="Enter Package Name" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Package Type</td>
				<td>:</td>
				<td>
					<select name="cboPackageType">
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
					<input type="Number" name="numPrice" value="100" min="100" max="3000" required=""/>
				</td>
			</tr>
			<tr>			
				<td>Choose an Image</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage" required="" />
				</td>
			</tr>
			<tr>
    <td>Choose Route</td>
    <td>:</td>
    <td>
    <select name="cboRoute" class="form-control">
        <?php 
        $query="SELECT * FROM Routes";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

 

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $Route_ID=$row['Route_ID'];
            $Route_Name=$row['Name'];

 

            echo "<option value='$Route_ID'> $Route_Name </option>";
        }

 

         ?>
    </select>
    </td>
			</tr>
	<td colspan="3">
		<hr/>
	</td>
			<tr>			
				<td>Choose Detail Image1</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage1" required="" />
				</td>
			</tr>
			<tr>
			<tr>			
				<td>Choose Detail Image2</td>
				<td>:</td>
				<td>
					<input type="file" name="txtImage2" required="" />
				</td>
			</tr>
			<tr>			
				<td>Choose Detail Image3</td>
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
<legend>Package Listing :</legend>

<table id="tableid" class="display" border="1">
<thead align='center'>
<tr>
	<th>Package ID</th>
	<th>Image</th>
	<th>Name</th>
	<th>Type</th>
	<th>Duration</th>
	<th>Price</th>
	<th>Route</th>
	<th>Uploader</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$P_select="SELECT * FROM Packages";
	$P_ret=mysqli_query($connect,$P_select);
	$P_count=mysqli_num_rows($P_ret);

	for($i=0;$i<$P_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($P_ret);
		$PackageID=$rows['Package_ID'];
		$P_Image=$rows['Image'];

		echo "<tr>";
			echo "<td align='center'>$PackageID</td>";
			echo "<td align='center'><img src='$P_Image' width='120px' height='100px'/></td>";
			echo "<td align='center'>" . $rows['Name'] . "</td>";
			echo "<td align='center'>" . $rows['Type'] . "</td>";
			echo "<td align='center'>" . $rows['Duration'] . "(Days)</td>";
			echo "<td align='center'>" . $rows['Price'] . "(USD)</td>";
			echo "<td align='center'>" . $rows['Route_ID'] . "</td>";
			echo "<td align='center'>" . $rows['Staff_ID'] . "</td>";
			echo "<td align='center'>
				  <a href='Package_Update.php?Package_ID=$PackageID'>Edit</a> |
				  <a href='Package_Delete.php?Package_ID=$PackageID'>Delete</a>
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