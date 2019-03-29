<?php
if(isset($_GET['resid'])){
        $resid=$_GET['resid'];
}
if(isset($_GET['mode'])){
    if ($_GET['mode']=="Trading") {
    	echo("Here");
    	header("Location: acctreq.php?resid=".$resid);
    }
    if ($_GET['mode']=="Buying") {
    	echo("Here");
    	header("Location: accsreq.php?resid=".$resid);
    }
}

?>