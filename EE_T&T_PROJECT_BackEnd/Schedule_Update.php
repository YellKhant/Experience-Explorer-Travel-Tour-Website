<?php  
session_start();
include('Connect.php');
include ('Header1.php');

if(isset($_POST['btnUpdate'])) 
{
	$txtScheduleID=$_POST['txtScheduleID'];
	$txtCoverage=$_POST['txtCoverage'];
	$dos=$_POST['dos'];
	$doe=$_POST['doe'];
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
	
	$update_data="UPDATE Schedules
				  SET 
				  Coverage='$txtCoverage',
				  Start_Date='$dos',
				  End_Date='$doe',
				  Description1='$txtDescription1',
				  Description2='$txtDescription2',
				  Description3='$txtDescription3',
				  Description4='$txtDescription4',
				  Description5='$txtDescription5',
				  Description6='$txtDescription6',
				  Description7='$txtDescription7',
				  Description8='$txtDescription8',
				  Description9='$txtDescription9',
				  Description10='$txtDescription10'
				  WHERE Schedule_ID='$txtScheduleID'
				  ";
	$result=mysqli_query($connect,$update_data);

	if($result) //True
	{
		echo "<script>window.alert('Schedule Successfully Updated!')</script>";
		echo "<script>window.location='Schedule.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Schedule Update" . mysqli_error($connect) . "</p>";
	}
}

if(isset($_GET['Schedule_ID'])) 
{
	$txtScheduleID=$_GET['Schedule_ID'];

	$query="SELECT * FROM Schedules WHERE Schedule_ID='$txtScheduleID'";
	$ret=mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$txtScheduleID="";
	echo "<script>window.alert('Somthing went wrong | Schedule_ID not found')</script>";
	echo "<script>window.location='Schedule.php'</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Schedule Update</title>

<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css" />	

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="" method="post">

<fieldset>
<legend>Schedule Information Update Form:</legend>

<table>
			</tr>
			<tr>			
				<td>Coverage</td>
				<td>:</td>
				<td>
				<textarea name="txtCoverage" required=""><?php echo $rows['Coverage'] ?></textarea>
				</td>
			</tr>
			<tr>			
				<td>Start Date</td>
				<td>:</td>
				<td>
					<input type="date" name="dos" value="<?php echo $rows['Start_Date'] ?>" onClick="showCalender(calender,this)" required />
				</td>
			</tr>

			<tr>			
				<td>End Date</td>
				<td>:</td>
				<td>
					<input type="date" name="doe" value="<?php echo $rows['End_Date'] ?>" onClick="showCalender(calender,this)" required />
				</td>
			</tr>
			<td colspan="4">
				<hr/>
			</td>
			<tr>			
				<td>Description </td>
				<td> For </td>
				<td>Each Day On Tour</td>
			</tr>
			<tr>			
				<td></td>
				<td>Day1:</td>
				<td>
				<textarea name="txtDescription1" required=""><?php echo $rows['Description1'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day2</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription2" required=""><?php echo $rows['Description2'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day3</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription3" required=""><?php echo $rows['Description3'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day4</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription4" required=""><?php echo $rows['Description4'] ?></textarea>
				</td>
			</tr>
			<tr>			
				<td></td>
				<td>Day5:</td>
				<td>
				<textarea name="txtDescription5" required=""><?php echo $rows['Description5'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day6</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription6" required=""><?php echo $rows['Description6'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day7</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription7" required=""><?php echo $rows['Description7'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day8</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription8" required=""><?php echo $rows['Description8'] ?></textarea>
				</td>
			</tr>
			<tr>			
				<td></td>
				<td>Day9:</td>
				<td>
				<textarea name="txtDescription9" required=""><?php echo $rows['Description9'] ?></textarea>
				</td>
				<td> | </td>
				<td>Day10</td>
				<td>:</td>
				<td>
				<textarea name="txtDescription10" required=""><?php echo $rows['Description10'] ?></textarea>
				</td>
			</tr>
<tr>
	<td></td>
	<td></td>
	<td>
		<input type="hidden" name="txtScheduleID" value="<?php echo $rows['Schedule_ID'] ?>" />
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