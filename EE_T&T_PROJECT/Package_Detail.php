<?php 
session_start();
include('Connect.php');
include('Header1.php');
	
// if (!isset($_SESSION['userid']))
// 	{
// 	echo "<script>alert('Please Login Account');</script>";
// 	echo "<script>window.location='userlogin.php';</script>";
// 	}

	if(isset($_REQUEST['CID']))
	{
		$PackageID=$_REQUEST['CID'];
		$Package="SELECT pa.*, sc.*
		FROM Packages pa, Schedules sc
		WHERE pa.Package_ID='$PackageID'
		AND pa.Package_ID=sc.Package_ID";
		$result=mysqli_query($connect,$Package);
		$arr=mysqli_fetch_array($result);
	}
	    $Nights=$arr['Duration']-1;

 ?>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action="" method="POST">
 	<legend>Package-Schedule Detail</legend>
 	<table>

 		<tr>
 			<td><img src="<?php echo $arr['Image']; ?>" width="240" height="200"></td>
 			<td><img src="<?php echo $arr['Image1']; ?>" width="240" height="200"></td>
 			<td><img src="<?php echo $arr['Image2']; ?>" width="240" height="200"></td>
 			<td><img src="<?php echo $arr['Image3']; ?>" width="240" height="200"></td>
 		</tr>
 				<table>
 					<tr>
 						<td width="140pt">Package Name</td>
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Name']; ?></td>
 					</tr>
					<tr>
 						<td width="90pt">Package Type</td>
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Type']; ?></td>
					</tr>	
					<tr>
 						<td width="90pt">Duration</td>
 						<td width="50pt">:</td>
 						<td><?php echo $Nights.' Nights / '.$arr['Duration'].' Days'."</td>"; ?></td>
					</tr>
					<tr>
 						<td width="90pt">Start-End</td>
 						<td width="50pt">:</td>
 						<td>
 							<?php echo 'From > '.$arr['Start_Date'].' | To > '.$arr['End_Date']."</td>"; ?>
 						</td>
					</tr>
					<tr>
 						<td width="90pt">Coverage</td>
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Coverage']; ?></td>
					</tr>
					<tr>
 						<td width="90pt">Price</td>
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Price']; ?>USD</td>
					</tr>			
<?php  
	
	$P_select="SELECT pa.* 
				FROM Packages pa
				WHERE pa.Package_ID='$PackageID'";
	$P_ret=mysqli_query($connect,$P_select);
	$P_count=mysqli_num_rows($P_ret);

	for($i=0;$i<$P_count;$i++) 
	{ 
		$rows=mysqli_fetch_array($P_ret);
		$PID=$rows['Package_ID'];

		echo "<tr>";
			echo "<td>Book Now
				  <a href='Booking.php?PkID=$PID'>Here</a>
				  </td>";
		echo "</tr>";
	}

?>
	<td colspan="3">
		<hr/>
	</td>
					<tr>
 						<td width="90pt">Day1</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description1']; ?></td>
					</tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr>
 						<td width="90pt">Day2</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description2']; ?></td>
					</tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr>
 						<td width="90pt">Day3</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description3']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day4</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description4']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day5</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description5']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day6</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description6']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day7</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description7']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day8</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description8']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day9</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description9']; ?></td>
					</tr>
					<tr></tr>	
					<tr></tr>
					<tr></tr>	
					<tr>
 						<td width="90pt">Day10</td> 						
 						<td width="50pt">:</td>
 						<td><?php echo $arr['Description10']; ?></td>
					</tr>
 				</table>				

 	</table>
 	</form>	
 </body>
 </html>
<?php include "Footer.php" ?>