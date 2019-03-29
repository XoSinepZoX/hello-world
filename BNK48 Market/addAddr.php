<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    if (isset($_GET['shipid'])) {
    	$shipid=$_GET['shipid'];
    	//echo($shipid);
    }
    if (isset($_POST['add'])) {
    	$name=$_POST['Name'];
    	$tel=$_POST['Tel'];
    	$addr=$_POST['Addr'];
    	$shipid=$_POST['shipid'];
    	$Address=$name." / ".$addr." / ".$tel;
    	//echo($Address);
    	$q="UPDATE Shipment SET " .
        "Address = '".$Address."' ,Status='Waiting' " .
        " WHERE ShipmentID =".$shipid."";
        echo($q);
	    $result=$conn->query($q);
	    //echo($q);
	    if(!$result){
	        echo "INSERT failed. Error : ".$conn->error ;
	    }
	    header("Location: myaccount.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add Address</h2>
<?php
    $q = 'SELECT * FROM Users WHERE UID='.$uid.';';
    if ($res = $conn->query($q))
    {
        $row=$res->fetch_array();
    }
    //echo($q);
?>
<form method="POST" action="addAddr.php">
	<input type="hidden" name="shipid" value="<?php echo $shipid ?>">
    <table class = "addaddr-table">
        <tr class = "addaddr-row">
            <td>
                <div class = "bold ">Name : </div>
            </td>
            <td>
                <input type="text" name="Name" value="<?php echo($row['Title'].$row['Firstname']." ".$row['Lastname']);  ?>">
            </td>
        </tr>
        <tr class = "addaddr-row">
            <td>
                <div class = "bold">Address : </div>
            </td>
            <td>
                <textarea name="Addr" class = "addaddr-textarea"><?php echo($row['Address']);  ?></textarea>
            </td>
        </tr>
        <tr class = "addaddr-row">
            <td>
                <div class = "bold">Tel. : </div>
            </td>
            <td>
                <div><input type="text" name="Tel" value="<?php echo($row['Tel']);  ?>">
            </td>
        </tr>
        <tr class = "addaddr-row">
            <td colspan = "2" class = "addaddr-add-btt">
                <input type="submit" name="add" value="ADD" >
            </td>
        </tr>
    </table>
</form>
    
</body>
<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
</html>