<?php
if(isset($_GET['delresid'])){
        $delresid=$_GET['delresid'];
}
if(isset($_GET['mode'])){
    if ($_GET['mode']=="Trading" || $_GET['mode']=="Buying") {
    	//echo($delresid);
    	header("Location: deltreq.php?delresid=".$delresid);
    }
}

?>