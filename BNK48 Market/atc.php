<?php
include('dbconn.php');
if ($conn->connect_errno) {
    echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
}
session_start();
$uid=$_SESSION['uid'];
$username=$_SESSION['username'];
if(isset($_GET['itemid'])){
	$itemid=$_GET['itemid'];
	$q="SET @p0='".$uid."'"; 
	$q2="SET @p1='".$itemid."'";
	$q3="CALL addtocart(@p0, @p1)";
	$conn->query($q);
	$conn->query($q2);
	$res=$conn->query($q3);
	echo($q);
	echo($q2);
	echo($q3);
	if ($res) {
		header("Location: cart.php");
	}
	else{
		echo("Error");
	}
}
?>