<?php  
session_start(); //Session Declare
include('Connect.php');
include ('Header1.php');
include ('AutoID_Function.php');

if(isset($_POST['btnSearch']))
{
	$SearchType=$_POST['rdoSearchType'];

	if ($SearchType == 1) 
	{
		$cboBookingID=$_POST['cboBookingID'];

		$query="SELECT cu.*, bo.*
			FROM Customers cu, Bookings bo
			WHERE bo.Booking_ID='$cboBookingID'
			AND cu.Customer_ID=bo.Customer_ID
			";

		$result=mysqli_query($connect,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 2) 
	{
		$From=date('d-m-Y',strtotime($_POST['txtFrom']));
		$To=date('d-m-Y',strtotime($_POST['txtTo']));

		$query="SELECT cu.*,bo.*  
			FROM  Customers cu, Bookings bo
			WHERE bo.Booking_Date BETWEEN '$From' AND '$To'
			AND cu.Customer_ID=bo.Customer_ID
			";
		$result=mysqli_query($connect,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 3) 
	{
		$cboStatus=$_POST['cboStatus'];

		$query="SELECT cu.*,bo.*  
			FROM Customers cu, Bookings bo
			WHERE bo.Status='$cboStatus'
			AND cu.Customer_ID=bo.Customer_ID
			";
		$result=mysqli_query($connect,$query);
		$size=mysqli_num_rows($result);
	}
}
elseif (isset($_POST['btnShowall'])) 
{
		$query="SELECT cu.*, bo.*
			FROM Customers cu, Bookings bo
			Where cu.Customer_ID=bo.Customer_ID
			";

	$result=mysqli_query($connect,$query);
	$size=mysqli_num_rows($result);
}
else
{
	$today=date('d-m-Y');

		$query="SELECT cu.*, bo.*
			FROM Customers cu, Bookings bo
			WHERE bo.Booking_Date='$today'
			AND cu.Customer_ID=bo.Customer_ID
			";

	$result=mysqli_query($connect,$query);
	$size=mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Search & Report</title>

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

<form action="" method="post">

Go to Staff Home From >><a href="Staff_Home.php">Here</a><<

<fieldset>
<legend>Search Options:</legend>
<table width="100%">
	<tr>
		<td>
		<input type="radio" name="rdoSearchType" value="1" checked />Search by BookingID <br/>
		<select name="cboBookingID">
			<option>-Choose Booking ID-</option>
        <?php 
        $query="SELECT * FROM Bookings";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

 

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $Booking_ID=$row['Booking_ID'];

            echo "<option value='$Booking_ID'> $Booking_ID </option>";
        }
         ?>
		</select>
		</td>

		<td>
		<input type="radio" name="rdoSearchType" value="2" />Search by Date ( From<br/>
		<input type="text" name="txtFrom" value="<?php echo date('d-m-Y') ?>" onClick="showCalender(calender,this)" />
		</td>
		<td>
		To )
		<input type="text" name="txtTo" value="<?php echo date('d-m-Y') ?>" onClick="showCalender(calender,this)" />
		</td>

		<td>
		<input type="radio" name="rdoSearchType" value="3" />Search by Status <br/>
		<select name="cboStatus">
			<option>Choose Status</option>
			<option>Pending</option>
			<option>Confirmed</option>
			<option>Denied</option>
			<option>Paid</option>
			<option>Expired</option>
		</select>
		</td>

		<td>
			<br/>
			<input type="submit" name="btnSearch" value="Search Now" />
			<input type="submit" name="btnShowall" value="Show All" />
		</td>
	</tr>
</table>

<hr/>

<?php  

if($size < 1) 
{
	echo "<p>No Booking Record Found...</p>";
}
else
{
?>
	
	<table id="tableid" class="display" border="1">
	<thead  align='center'>
	<tr>
		<th>#</th>
		<th>Booking ID</th>
		<th>Booking Date</th>
		<th>Package Name</th>
		<th>Customer Name</th>
		<th>Quantity</th>
		<th>Status</th>
		<th>Action</th>
	</tr>	
	</thead>
	<tbody>
	<?php
	for($i=0;$i<$size;$i++) 
	{ 
		$rows=mysqli_fetch_array($result);
		$BookingID=$rows['Booking_ID'];

		echo "<tr>";
			echo "<td align='center'>" . ($i + 1) . "</td>";
			echo "<td align='center'>" . $rows['Booking_ID'] . "</td>";
			echo "<td align='center'>" . $rows['Booking_Date'] . "</td>";
			echo "<td align='center'>" . $rows['Package_Name'] . "</td>";
			echo "<td align='center'>" . $rows['FirstName'] . " " . $rows['LastName'] . "</td>";
			echo "<td align='center'>" . $rows['Quantity'] . "</td>";
			echo "<td align='center'>" . $rows['Status'] . "</td>";
			echo "<td  align='center'>
				  <a href='Booking_Manage.php?Booking_ID=$BookingID'>Manage</a> 
				  </td>";
		echo "</tr>";
	}
	?>
</tbody>
</table>	
<?php
}
?>

</fieldset>

</form>
</body>
</html>

<?php include "Footer1.php" ?>