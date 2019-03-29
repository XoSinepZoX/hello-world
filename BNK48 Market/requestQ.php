<?php
	include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
	if (isset($_POST['sendt'])) {
		$itemre=$_POST['item'];
		$itemmain=$_POST['itemmain'];
		$q = 'SELECT UID FROM Listings WHERE ItemID='.$itemmain.';';
		echo($q);
	    if ($res = $conn->query($q))
	    {
	        $row=$res->fetch_array();
	        $uidmain=$row['UID'];
	    }
	    $q2 = "INSERT INTO Response (ItemIDMain,UIDMain,ItemIDRe,UIDRe,Status)
			VALUES ($itemmain,'$uidmain','$itemre','$uid','Pending')";
		$result=$conn->query($q2);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
		}
		echo($q2);
		header("Location: myaccount.php");
	}
	if (isset($_POST['sends'])) {
		$itemre=$_POST['item'];
		$itemmain=$_POST['itemmain'];
		$q = 'SELECT UID,Price FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID WHERE Listings.ItemID='.$itemmain.';';
		echo($q);
	    if ($res = $conn->query($q))
	    {
	        $row=$res->fetch_array();
	        $uidmain=$row['UID'];
	        $price=$row['Price'];
	    }

	    $q2 = "INSERT INTO Response (ItemIDMain,UIDMain,Price,ItemIDRe,UIDRe,Status)
			VALUES ($itemmain,'$uidmain','$price','$itemre','$uid','Pending')";
		$result=$conn->query($q2);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
		}
		echo($q2);
		header("Location: myaccount.php");
	}

?>