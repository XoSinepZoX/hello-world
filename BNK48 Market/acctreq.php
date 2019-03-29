<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    if(isset($_GET['resid'])){
        $resid=$_GET['resid'];
        $q = 'SELECT * FROM Response WHERE ResponseID='.$resid.';';
        if ($res = $conn->query($q))
        {
            $row=$res->fetch_array();
            $itemidmain=$row['ItemIDMain'];
            $itemidre=$row['ItemIDRe'];
            $uidre=$row['UIDRe'];
        }
    }
    $q="SET @p0=".$resid.""; 
    $q1="SET @p1='".$itemidmain."'";
    $q2="SET @p2='".$uid."'";
    $q3="SET @p3='".$itemidre."'";
    $q4="SET @p4='".$uidre."'";
    $q5="CALL acctreq(@p0, @p1,@p2, @p3,@p4)";
    $conn->query($q);
    $conn->query($q1);
    $conn->query($q2);
    $conn->query($q3);
    $conn->query($q4);
    $conn->query($q5);
    // echo($q);
    // echo($q1);
    // echo($q2);
    // echo($q3);
    // echo($q4);
    // echo($q5);
    header("Location: myaccount.php");
?>