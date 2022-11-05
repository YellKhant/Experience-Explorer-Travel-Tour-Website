<?php 
session_start();
include ('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if (isset($_POST['btnSave']))
{
	$txtScheduleID=$_POST['txtScheduleID'];
	$cboPackage=$_POST['cboPackage'];
	$txtCoverage=$_POST['txtCoverage'];
	$dos=$_POST['dos'];
	$doe=$_POST['doe'];
	$cboVehicle=$_POST['cboVehicle'];
	$cboHotel=$_POST['cboHotel'];
	$txtDescription1=$_POST['txtDescription1'];
	$txtDescription2=$_POST['txtDescription2'];
	$txtDescription3=$_POST['txtDescription3'];
	$txtDescription4=$_POST['txtDescription4'];
	$txtDescription5=$_POST['txtDescription5'];
	$txtDescription6=$_POST['txtDescription6'];
	$txtDescription7=$_POST['txtDescription7'];
	$txtDescription8=$_POST['txtDescription8'];
	$txtDescription9=$_POST['txtDescription9'];
	$txtDescription10=$_POST['txtDescription10'];
	
	$check_name="SELECT * FROM Schedules WHERE Package_ID='$cboPackage'";
	$result=mysqli_query($connect,$check_name);
	$count=mysqli_num_rows($result);

	if ($count > 0) 
	{
		echo "<script>window.alert('Schedule for selected Package is already exist :-(')</script>";
		echo "<script>window.location='Schedule.php'</script>";
		exit();
	}

	$insert="INSERT INTO Schedules 
	(Schedule_ID,Package_ID,Coverage,Start_Date,End_Date,Vehicle_ID,Hotel_ID,Description1,Description2,Description3,Description4,Description5,Description6,Description7,Description8,Description9,Description10) VALUES 
	('$txtScheduleID','$cboPackage','$txtCoverage','$dos','$doe','$cboVehicle','$cboHotel','$txtDescription1','$txtDescription2','$txtDescription3','$txtDescription4','$txtDescription5','$txtDescription6','$txtDescription7','$txtDescription8','$txtDescription9','$txtDescription10')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Schedule Successfully Registered :-D')</script>";
		echo "<script>window.location='Schedule.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Schedule Registeration :-(".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Schedule Register</title>	

<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css" />	

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

<form action="Schedule.php" method="POST">
	
Go back to Staff Home From >><a href="Staff_Home.php">Here</a><<

	<fieldset>
		<legend>Schedule Register Form: </legend>	
		<table>
			<tr>			
				<td>Schedule ID</td>
				<td>:</td>
				<td>
					<input type="text" name="txtScheduleID" value="<?php echo AutoID('Schedules','Schedule_ID','Sc-',6) ?>" required readonly />
				</td>
			</tr>
						<tr>
    <td>Choose Package</td>
    <td>:</td>
    <td>
    <select name="cboPackage" class="form-control">
        <?php
        $query="SELECT * FROM Packages";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $Package_ID=$row['Package_ID'];
            $Package_Name=$row['Name'];

 

            echo "<option value='$Package_ID'> $Package_Name </option>";
        }

 

         ?>
    </select>
    </td>
			</tr>
			<tr>			
				<td>Coverage</td>
				<td>:</td>
				<td>
				<textarea name="txtCoverage" required=""></textarea>
				</td>
			</tr>
			<tr>			
				<td>Start Date</td>
				<td>:</td>
				<td>
					<input type="date" name="dos" placeholder="Choose Date" onClick="showCalender(calender,this)" required />
				</td>
			</tr>

			<tr>			
				<td>End Date</td>
				<td>:</td>
				<td>
					<input type="date" name="doe" placeholder="Choose Date" onClick="showCalender(calender,this)" required />
				</td>
			</tr>
    <td>Choose Vehicle</td>
    <td>:</td>
    <td>
    <select name="cboVehicle" class="form-control">
        <?php 
        $query="SELECT * FROM Vehicles";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

 

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $Vehicle_ID=$row['Vehicle_ID'];
            $Vehicle_Name=$row['VehicleName'];

 

            echo "<option value='$Vehicle_ID'> $Vehicle_Name </option>";
        }

 

         ?>
    </select>
    </td>
			</tr>
			<tr>
    <td>Choose Hotel</td>
    <td>:</td>
    <td>
    <select name="cboHotel" class="form-control">
        <?php 
        $query="SELECT * FROM Hotels";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

 

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $Hotel_ID=$row['Hotel_ID'];
            $Hotel_Name=$row['Name'];

 

            echo "<option value='$Hotel_ID'> $Hotel_Name </option>";
        }

 

         ?>
    </select>
    </td>
			</tr>
			<td colspan="4">
				<hr/>
			</td>
			<tr>			
				<td>Fill Description</td>
				<td>For </td>
				<td>Each Day On Tour</td>
			</tr>
			<tr>			
				<td></td>
				<td>Day1:</td>
				<td>
				<textarea name="txtDescription1" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day2</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription2" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day3</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription3" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day4</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription4" required=""></textarea>
				</td>
			</tr>
			<tr>			
				<td></td>
				<td>Day5:</td>
				<td>
				<textarea name="txtDescription5" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day6</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription6" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day7</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription7" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day8</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription8" required=""></textarea>
				</td>
			</tr>
			<tr>			
				<td></td>
				<td>Day9:</td>
				<td>
				<textarea name="txtDescription9" required=""></textarea>
				</td>
				<td> | </td>
				<td>Day10</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription10" required=""></textarea>
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
<legend>Schedule Listing :</legend>

<table id="tableid" class="display" border="1">
<thead align='center'>
<tr>
	<th>Schedule ID</th>
	<th>Package ID</th>
	<th>Coverage</th>
	<th>Start Date</th>
	<th>End Date</th>
	<th>Vehicle ID</th>
	<th>Hotel ID</th>
	<th>Action</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$S_select="SELECT * FROM Schedules";
	$S_ret=mysqli_query($connect,$S_select);
	$S_count=mysqli_num_rows($S_ret);

	for($i=0;$i<$S_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($S_ret);
		$ScheduleID=$rows['Schedule_ID'];
		$PackageID=$rows['Package_ID'];
		$VehicleID=$rows['Vehicle_ID'];
		$HotelID=$rows['Hotel_ID'];

		echo "<tr>";
			echo "<td align='center'>$ScheduleID</td>";
			echo "<td align='center'>$PackageID</td>";
			echo "<td align='center'>" . $rows['Coverage'] . "</td>";
			echo "<td align='center'>" . $rows['Start_Date'] . "</td>";
			echo "<td align='center'>" . $rows['End_Date'] . "</td>";
			echo "<td align='center'>$VehicleID</td>";
			echo "<td align='center'>$HotelID</td>";
			echo "<td align='center'>
				  <a href='Schedule_Update.php?Schedule_ID=$ScheduleID'>Edit</a> |
				  <a href='Schedule_Delete.php?Schedule_ID=$ScheduleID'>Delete</a>
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