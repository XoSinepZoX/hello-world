<?php
	include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
    if (isset($_GET['itemid'])) {
    	$itemid=$_GET['itemid'];
    	$q='UPDATE Shipment SET Status="Completed" WHERE ItemID='.$itemid;
    	$res=$conn->query($q);
    	if ($res) {
    		header("Location: managewebsite.php");
    	}
    	else{
    		echo($q);
    	}
    }
?>