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
            $pricere=$row['Price'];
        }
    }
    $q="SET @p0=".$resid.""; 
    $q1="SET @p1='".$itemidmain."'";
    $q2="SET @p2='".$uid."'";
    $q3="SET @p3='".$itemidre."'";
    $q4="SET @p4='".$uidre."'";
    $q5="SET @p5='".$pricere."'";
    $q6="CALL accsreq(@p0, @p1,@p2, @p3,@p4,@p5,@p6,@p7)";
    $q7="SELECT @p6 AS pri, @p7 AS car";
    $conn->query($q);
    $conn->query($q1);
    $conn->query($q2);
    $conn->query($q3);
    $conn->query($q4);
    $conn->query($q5);
    $conn->query($q6);
    $res2=$conn->query($q7);
    // echo($q);
    // echo($q1);
    // echo($q2);
    // echo($q3);
    // echo($q4);
    // echo($q5);
    // echo($q6);
    // echo($q7);
    $row2=$res2->fetch_array();
    $pri=$row2['pri'];
    $cartid=$row2['car'];
    // echo($pri);
    // echo($cartid);
    header("Location: payment.php?price=".$pri."&cartid=".$cartid);
?>