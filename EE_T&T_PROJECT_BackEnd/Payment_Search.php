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
		$cboPaymentID=$_POST['cboPaymentID'];

		$query="SELECT cu.*, pm.*
			FROM Customers cu, Payments pm
			WHERE pm.Payment_ID='$cboPaymentID'
			AND cu.Customer_ID=pm.Customer_ID
			";

		$result=mysqli_query($connect,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 2) 
	{
		$From=date('d-m-Y',strtotime($_POST['txtFrom']));
		$To=date('d-m-Y',strtotime($_POST['txtTo']));

		$query="SELECT cu.*,pm.*  
			FROM  Customers cu, Payments pm
			WHERE pm.Payment_Date BETWEEN '$From' AND '$To'
			AND cu.Customer_ID=pm.Customer_ID
			";
		$result=mysqli_query($connect,$query);
		$size=mysqli_num_rows($result);
	}
	elseif ($SearchType == 3) 
	{
		$cboPaymentType=$_POST['cboPaymentType'];

		$query="SELECT cu.*,pm.*  
			FROM Customers cu, Payments pm
			WHERE pm.Payment_Type='$cboPaymentType'
			AND cu.Customer_ID=pm.Customer_ID
			";
		$result=mysqli_query($connect,$query);
		$size=mysqli_num_rows($result);
	}
}
elseif (isset($_POST['btnShowall'])) 
{
		$query="SELECT cu.*, pm.*
			FROM Customers cu, Payments pm
			Where cu.Customer_ID=pm.Customer_ID
			";

	$result=mysqli_query($connect,$query);
	$size=mysqli_num_rows($result);
}
else
{
	$today=date('d-m-Y');

		$query="SELECT cu.*, pm.*
			FROM Customers cu, Payments pm
			WHERE pm.Payment_Date='$today'
			AND cu.Customer_ID=pm.Customer_ID
			";

	$result=mysqli_query($connect,$query);
	$size=mysqli_num_rows($result);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Search & Report</title>

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
		<input type="radio" name="rdoSearchType" value="1" checked />Search by PaymentID <br/>
		<select name="cboPaymentID">
			<option>-Choose PaymentID-</option>
        <?php 
        $query="SELECT * FROM Payments";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

 

        for ($i=0; $i <$count ; $i++) 
        { 
            $row=mysqli_fetch_array($ret);
            $Payment_ID=$row['Payment_ID'];

            echo "<option value='$Payment_ID'> $Payment_ID </option>";
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
		<input type="radio" name="rdoSearchType" value="3" />Search by Payment Type<br/>
		<select name="cboPaymentType">
			<option>Choose PaymentType</option>
			<option>VISA</option>
			<option>Cash</option>
			<option>KBZPay</option>
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
	echo "<p>No Payment Record Found...</p>";
}
else
{
?>
	
	<table id="tableid" class="display" border="1">
	<thead  align='center'>
	<tr>
		<th>#</th>
		<th>Payment ID</th>
		<th>Payment Date</th>
		<th>Payment Type</th>
		<th>Customer Name</th>
		<th>Booking ID</th>
		<th>Total Cost</th>
		<th>Card No.</th>
	</tr>	
	</thead>
	<tbody>
	<?php
	for($i=0;$i<$size;$i++) 
	{ 
		$rows=mysqli_fetch_array($result);
		$PaymentID=$rows['Payment_ID'];

		echo "<tr>";
			echo "<td align='center'>" . ($i + 1) . "</td>";
			echo "<td align='center'>" . $rows['Payment_ID'] . "</td>";
			echo "<td align='center'>" . $rows['Payment_Date'] . "</td>";
			echo "<td align='center'>" . $rows['Payment_Type'] . "</td>";
			echo "<td align='center'>" . $rows['FirstName'] . " " . $rows['LastName'] . "</td>";
			echo "<td align='center'>" . $rows['Booking_ID'] . "</td>";
			echo "<td align='center'>" . $rows['Total_Cost'] . "</td>";
			echo "<td align='center'>" . $rows['CardNO'] . "</td>";
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