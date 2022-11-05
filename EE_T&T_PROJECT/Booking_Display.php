<?php 
session_start();
include ('Connect.php');
include ('Header.php');

if (!isset($_SESSION['Customer_ID'])) 
  {
    echo "<script>alert('Please Login Account.');</script>";
    echo "<script>window.location='Customer_Login.php';</script>";
  }
$CustomerID=$_SESSION['Customer_ID'];

$Packages="
SELECT pa.*,sc.*,bo.*
FROM Packages pa, Schedules sc , Bookings bo , Customers cu
Where cu.Customer_ID='$CustomerID'
And cu.Customer_ID=bo.Customer_ID 
And bo.Schedule_ID=sc.Schedule_ID
And sc.Package_ID=pa.Package_ID
";

$run=mysqli_query($connect,$Packages);
$count=mysqli_num_rows($run);

?>
 
<html>
<head>
	<title>Display</title>

	 	 	<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
 	<style type="text/css">
 		#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 18px; /* Increase font-size */
}

#myTable th, #myTable td {
  text-align: left; /* Left-align text */
  padding: 12px; /* Add padding */
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}

 	</style>
</head>
<body>
<form action="" method="POST">
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search By Package Name..">
<fieldset>
<legend>Booked Packages Display</legend>
  <table id="myTable" border="1">
    <tr class="header">

	<?php 

	for ($i=0; $i <$count ; $i++)
	{ 
		$data=mysqli_fetch_array($run);
		echo "<tr>";
    echo "<td><img src='".$data['Image']."' width='100px' height='50px'></td>";
    echo "<td>Package Name: ".$data['Package_Name']."</td>";
		echo "<td>Booked Quantity: ".$data['Quantity']."</td>";
    echo "<td>Booking Date: ".$data['Booking_Date']."</td>";
    echo "<td>Status: ".$data['Status']."</td>";
		echo "<td><a href='Payment.php?BID=".$data['Booking_ID']."&Status=".$data['Status']."'>Payment</a></td>";
		echo "</tr>";
	}
  if($count < 1) 
{
  echo "<p>No Booking Record Found...</p>";
}
	 ?>
	</tr>
	 </table>
</fieldset>
</form>
</body>
</html>
<?php include "Footer.php" ?>