<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    if(isset($_GET['delresid'])){
        $resid=$_GET['delresid'];
        $qd="UPDATE Response SET " .
        "Status = 'Rejected' " .
        " WHERE ResponseID =".$resid."";
        $resultd=$conn->query($qd);
        //echo($qd);
        if(!$resultd){
            echo "INSERT failed. Error d: ".$conn->error ;
        }
        else{
            header("Location: myaccount.php");
        }
    }
?>