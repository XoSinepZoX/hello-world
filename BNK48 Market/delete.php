<?php
include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
if (isset($_GET['uid']) && strlen($_GET['uid']) > 0 )
{
	//$q = "DELETE FROM users WHERE UID=" . $_GET['uid'];
	$q="UPDATE users SET User_Status='Removed' WHERE UID=". $_GET['uid'];

	if (!$conn->query($q))
	{
		echo "ERROR DELETE FAIL!!!";
	}	
	//echo($q);
	header("Location: managewebsite.php");
}
else if (isset($_GET['setid']) && strlen($_GET['setid']) > 0 )
{
	$q = "DELETE FROM sets WHERE SetID=" . $_GET['setid'];
	if (!$conn->query($q))
	{
		echo "ERROR DELETE FAIL!!!";
	}	
	//echo "XX";
	header("Location: managewebsite.php");
}
else if (isset($_GET['memid']) && strlen($_GET['memid']) > 0 )
{
	$q = "DELETE FROM members WHERE MemID=" . $_GET['memid'];
	if (!$conn->query($q))
	{
		echo "ERROR DELETE FAIL!!!";
	}	
	//echo "XX";
	header("Location: managewebsite.php");
}
else if (isset($_GET['itemid']) && strlen($_GET['itemid']) > 0 )
{
	$itemid=$_GET['itemid'];
	$q="UPDATE Listings SET " .
		"Status = 'Deleted' " .
		" WHERE ItemID =".$itemid."";
	$result=$conn->query($q);
	echo($q);
	if(!$result){
		echo "INSERT failed. Error: ".$conn->error ;
	}
	if ($uid==1) {
		header("Location: managewebsite.php");
	}
	else{
		header("Location: myaccount.php");
	}
}
?>
