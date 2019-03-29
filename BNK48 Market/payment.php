<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    if (isset($_GET['price'])) {
    	$price=$_GET['price'];
    	//echo($price."HERE");
    }
    if (isset($_GET['cartid'])) {
        $cartid=$_GET['cartid'];
        //echo($price."HERE");
    }
    if(isset($_POST['checkout'])){
        $method=$_POST['card'];
        $cardno=mysqli_real_escape_string($conn,$_POST['cardno']);
        $price=$_POST['price'];
        $cartid=$_POST['cartid'];
        $name=mysqli_real_escape_string($conn,$_POST['Name']);
        $tel=$_POST['Tel'];
        $addr=$_POST['Addr'];
        $Address=$name." / ".$addr." / ".$tel;
        $q='INSERT INTO Payment(Method,CardNo,TotalPrice,OwnerID) VALUES ("'.$method.'","'.$cardno.'",'.$price.','.$uid.')';
        if ($res = $conn->query($q))
        {
            $qgp='SELECT PaymentID FROM Payment WHERE OwnerID='.$uid.' ORDER BY TimeStamp DESC';
            $resqgp = $conn->query($qgp);
            if(!$resqgp){
                echo "failed. Error resqgp: ".$conn->error ;
            }
            $rowqgp = $resqgp->fetch_array();
            $paymentid = $rowqgp['PaymentID'];
            $qp="UPDATE CartNo SET " .
                "Status = 'PAID' ," .
                "PaymentID =" . $paymentid.
                " WHERE CartID =".$cartid." ";
            $resqp = $conn->query($qp);
            //echo ($qp);
            if(!$resqp){
                echo "failed. Error resqp: ".$conn->error ;
            }
            $qs='SELECT ItemID From Cart WHERE CartID='.$cartid;
            $resqs = $conn->query($qs);
            if(!$resqs){
                echo "failed. Error resqs: ".$conn->error ;
            }
            while ($row=$resqs->fetch_array()) {
                # Update Addr in shipment table and change status to inactive

                $qid='SELECT UID FROM Listings WHERE ItemID='.$row['ItemID'];
                $resqid = $conn->query($qid);
                if(!$resqid){
                    echo "failed. Error resqid: ".$conn->error ;
                 }
                $rowqid = $resqid->fetch_array();
                $uidTo = $rowqid['UID'];

                $qship='INSERT INTO Shipment(ItemID,Address,Status,uidTo,uidFrom) VALUES('.$row['ItemID'].',"'.$Address.'","Waiting",'.$uid.','.$uidTo.')';
                $resship=$conn->query($qship);
                if(!$resship){
                    echo "failed. Error resship: ".$conn->error ;
                }
                $qu="UPDATE Listings SET " .
                "Status = 'Inactive'" .
                " WHERE ItemID =".$row['ItemID']." ";
                $resqu = $conn->query($qu);
                if(!$resqu){
                    echo "failed. Error resqu: ".$conn->error ;
                }
            }
            header("Location: myaccount.php");
        }
        else{
            echo "failed. Error: ".$conn->error ;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    $q = 'SELECT * FROM Users WHERE UID='.$uid.';';
    if ($res = $conn->query($q))
    {
        $row=$res->fetch_array();
    }
    //echo($q);
?>
<h1>Payment</h1>
<h2>Total Price : <?php echo $price; ?> THB</h1>
<form method="POST" action="payment.php">
    <input type="hidden" name="price" value="<?php echo($price) ?>">
    <input type="hidden" name="cartid" value="<?php echo($cartid) ?>">
    <h2>Payment methods</h2>
    <table class = "payment-table">
        <tr class = "payment-row">
            <td>
                <div class = "bold ">Card : </div>
            </td>
            <td>
                <select name="card" class = "payment-card">
                    <option value="visa">VISA</option>
                    <option value="mastercard">MasterCard</option>
                    <option value="unionpay">Union Pay</option>
                </select>
            </td>
        </tr>
        <tr class = "payment-row">
            <td>
                <div class = "bold">Credit card no. : </div>
            </td>
            <td>
                <input type="text" name="cardno" placeholder = "4412-1112-4444-1244">
            </td>
        </tr>
        <tr class = "payment-row">
            <td>
                <div class = "bold">Expire : </div>
            </td>
            <td>
                <div><input type="month" name="exp" class = "shadowbox payment-exp">
            </td>
        </tr>
        <tr class = "payment-row">
            <td>
                <div class = "bold">CVV : </div>
            </td>
            <td>
                <div><input type="number" name="cvv" class = "shadowbox payment-cvv" placeholder = "112">
            </td>
        </tr>
    </table>
    <hr>
    <h2 class = "payment-addr-header">Shipping Address</h2>
    <table class = "payment-table">
        <tr class = "payment-row">
            <td>
                <div class = "bold ">Name : </div>
            </td>
            <td>
                <input type="text" name="Name" value="<?php echo($row['Title'].$row['Firstname']." ".$row['Lastname']);  ?>">
            </td>
        </tr>
        <tr class = "payment-row">
            <td>
                <div class = "bold">Address : </div>
            </td>
            <td>
                <textarea name="Addr" class = "payment-textarea"><?php echo($row['Address']);  ?></textarea>
            </td>
        </tr>
        <tr class = "payment-row">
            <td>
                <div class = "bold">Tel. : </div>
            </td>
            <td>
                <div><input type="text" name="Tel" value="<?php echo($row['Tel']);  ?>">
            </td>
        </tr>
    </table>
    <hr>
    <input type="submit" name="checkout" value="Checkout" class = "payment-checkout-btt" onclick = "alert_success()">
</form>
    
</body>
<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
    <script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
    </script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
    <script>
		function alert_success() {
			alert("Payment completed")
		}
	</script>
</html>