<?php 
session_start();
include('connect.php');

if (!isset($_SESSION['Customer_ID']))
	{
	echo "<script>alert('Please Login Or Register Account...');</script>";
	echo "<script>window.location='Home.php';</script>";
	}

session_destroy();

echo "<script>alert('Account logout Successful')</script>";
echo "<script>window.location = 'Home.php'</script>";
?>