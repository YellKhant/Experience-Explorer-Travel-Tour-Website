<?php 
session_start();
include('Connect.php');
include('Header.php');
include('AutoID_Function.php');

if ($_GET['Status'] <> 'Confirmed')
	{
	echo "<script>alert('Payment Process can be carried out only when the status is Confirmed.');</script>";
	echo "<script>window.location='Booking_Display.php';</script>";
	}


if (isset($_POST['btnSave']))
{
	$txtPaymentID=$_POST['txtPaymentID'];
	$txtPaymentDate=$_POST['txtPaymentDate'];
	$rdoPayment=$_POST['rdoPayment'];
	$txtCardNo=$_POST['txtCardNo'];

	$txtBookingID=$_POST['txtBookingID'];
	$txtCustomerID=$_POST['txtCustomerID'];
	$TotalCost=$_POST['TotalCost'];

	$txtStatus="Paid";

	$update_data="UPDATE Bookings
				  SET 
				  Status='$txtStatus'
				  WHERE Booking_ID='$txtBookingID'
				  ";
	$result_Update=mysqli_query($connect,$update_data);


	// $check_booking="SELECT * FROM Payments WHERE Booking_ID='$txtBookingID'";
	// $result=mysqli_query($connect,$check_booking);
	// $count=mysqli_num_rows($result);

	// if ($count > 0) 
	// {
	// 	echo "<script>window.alert('Payment Process Already Finished!!! ')</script>";
	// 	echo "<script>window.location='Booking_Display.php'</script>";
	// 	exit();
	// }


	$insert="INSERT INTO Payments
	(Payment_ID,Payment_Date,Payment_Type,CardNO,Booking_ID,Customer_ID,Total_Cost) VALUES 
	('$txtPaymentID','$txtPaymentDate','$rdoPayment','$txtCardNo','$txtBookingID','$txtCustomerID','$TotalCost')";

	$result=mysqli_query($connect,$insert);

	if ($result) //True 
	{
		echo "<script>window.alert('Payment Successfully Finish :-D')</script>";
		echo "<script>window.location='Booking_Display.php'</script>";
	}
	else 
	{
		echo "<p>Something went wrong in Processing Payment :-(".mysqli_error($connect)."</p>";
	}
}

 ?>
<html>
<head>
	<title></title>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

	<script type="text/javascript">
function COD()
{
	document.getElementById('KBZPay').style.display="none";
	document.getElementById('VISA').style.display="none";
}
function KBZPay()
{
	document.getElementById('KBZPay').style.display="block";
	document.getElementById('VISA').style.display="none";
}
function VISA()
{
	document.getElementById('KBZPay').style.display="none";
	document.getElementById('VISA').style.display="block";
}
	</script>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">

<fieldset>
<legend>Cost Review:</legend>

<table id="tableid" class="display" border="1">
<thead  align='center'>
<tr>
	<th>Package Name</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Sub Total</th>
	<th>Tax</th>
	<th>Total Cost</th>
</tr>	
</thead>
<tbody>
<?php  
	
	$txtBookingID=$_GET['BID'];

	$query="SELECT * FROM Bookings WHERE Booking_ID='$txtBookingID'";
	$ret=mysqli_query($connect,$query);
	$route_count=mysqli_num_rows($ret);

	for($i=0;$i<$route_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($ret);

		echo "<tr>";
			echo "<td align='center'>" . $rows['Package_Name'] . "</td>";
			echo "<td align='center'>" . $rows['Price'] . "</td>";
			echo "<td align='center'>" . $rows['Quantity'] . "</td>";
			echo "<td align='center'>" . $rows['SubTotal'] . "</td>";
			echo "<td align='center'>" . $rows['Tax'] . "</td>";
			echo "<td align='center'>" . $rows['Total_Cost'] . "</td>";
		echo "</tr>";
	}

?>
</tbody>
</table>

</fieldset>

	<fieldset>
		<legend>Checkout Detail:</legend>
		<table>
<tr>
	<td>Payment ID</td>
	<td>:</td>
	<td>
		<input type="text" name="txtPaymentID" value="<?php echo AutoID('Payments','Payment_ID','Pm-',6) ?>" readonly />
	</td>
</tr>
<tr>
	<td>Payment Date</td>
	<td>:</td>
	<td>
		<input type="text" name="txtPaymentDate" value="<?php echo date('d-m-Y') ?>" readonly />
		<input type="hidden" name="txtBookingID" value="<?php echo $rows['Booking_ID'] ?>" readonly />
		<input type="hidden" name="txtCustomerID" value="<?php echo $rows['Customer_ID'] ?>" readonly />
		<input type="hidden" name="TotalCost" value="<?php echo $rows['Total_Cost'] ?>" readonly />
	</td>
</tr>
<tr>
	<td colspan="3">
		<hr/>
	</td>
</tr>
<tr>
	<td>Choose Payment Type</td>
	<td>:</td>
	<td>
	<input type="radio" name="rdoPayment" value="Cash" onClick="COD()" checked />
	<img src="images/Cash.png" width="35px" height="35px" />

	<input type="radio" name="rdoPayment" value="KBZPay" onClick="KBZPay()" />
	<img src="images/KBZPAY.png" width="35px" height="35px" />

	<input type="radio" name="rdoPayment" value="VISA" onClick="VISA()" />
	<img src="images/VISA.png" width="35px" height="35px" />
	<hr/>

	<div id="KBZPay" style="display: none;">
		<p><b>Scan Here to Checkout with KBZ Pay :</b></p>
		<img src="images/QR.png" width="100px" height="100px" />
		<hr/>
	</div>

	<div id="VISA" style="display: none;">
		<p>Enter Card Number :</p>
		<input type="text" name="txtCardNo" placeholder="---- ---- ---- ----" />
		<p>Security Code :</p>
		<input type="text" name="txtSecurityCode" placeholder="----" />
		<hr/>
	</div>

	</td>
</tr>
			<tr>
				<td></td>			
				<td></td>			
				<td>
					<input type="submit" value="Save" name="btnSave" required=""/>
				</td>
			</tr>
<?php 
		$BookingID=$_GET['BID'];

		echo "<tr>";
			echo "<td>
				  Click <a href='Booking_Delete.php?BookingID=$BookingID'>Here</a> To Cancel This
				  </td>";
			echo "<td></td>";
			echo "<td>Booking.</td>";
		echo "</tr>";

 ?>

		</table>
	</fieldset>
</form>

</body>
</html>

<?php include "Footer.php" ?>