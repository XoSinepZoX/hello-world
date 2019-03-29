<?php
include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
if (isset($_GET['accshipid'])) {
	$shipid=$_GET['accshipid'];
	$q="UPDATE Shipment SET " .
        "Status='Accepted' " .
        " WHERE ShipmentID =".$shipid."";
        //echo($q);
        $result=$conn->query($q);
        //echo($q);
        if(!$result){
            echo "INSERT failed. Error : ".$conn->error ;
        }
    header("Location: myaccount.php");
}
?>