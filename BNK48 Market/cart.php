<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    $q0 = 'SELECT CartID FROM CartNo WHERE Status IS NULL AND OwnerID='.$uid.' ORDER BY DateCreated DESC LIMIT 1';
                //echo($q0);
    $res0 = $conn->query($q0);
    $row0 = $res0->fetch_array();
    $cartid=$row0['CartID'];
    $qc='SELECT COUNT(ItemID) AS cnt FROM Cart WHERE CartID='.$cartid;
    $resqc = $conn->query($qc);
    $cnt=0;
    if($resqc){
        $rowqc = $resqc->fetch_array();
        $cnt=$rowqc['cnt'];
    }
    
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="style2.css">
</head>
<body class = "centera bgc-base-color">
<div class="managewebsiteoriginal-container managewebsiteoriginal-border">
    <?php
        if ($cnt>0) {
    ?>
        <h2>Cart</h2>
        <table border="0" width = "100%">
            <tr class = "managewebsite-colomn">
                <td>
                    <div class = "bold">DateAdded</div>
                </td>
                <td>
                    <div class = "bold">ItemID</div>
                </td>
                <td>
                    <div class = "bold">PIC</div>
                </td>
                <td>
                    <div class = "bold">PIC</div>
                </td>
                <td>
                    <div class = "bold">PIC</div>
                </td>
                <td>
                    <div class = "bold">Detail</div>
                </td>
                <td>
                    <div class = "bold">CartID</div>
                </td>
                <td>
                    <div class = "bold">Price</div>
                </td>
                <td>
                    <div class = "bold">Delete</div>
                </td>
            </tr>
            <?php
                $q = 'SELECT Cart.DateAdded,Cart.ItemID,PIC,PIC2,PIC3,Cart.CartID,Price,CartNo.Status,PaymentID,Style,CartItemID,Listings.Status AS State FROM Cart LEFT JOIN LISTINGS ON Cart.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN buysell ON listings.ItemID=buysell.ItemID LEFT JOIN CartNo ON Cart.CartID=CartNo.CartID WHERE CartNo.Status IS NULL AND OwnerID='.$uid.' ORDER BY DateAdded DESC';
                //echo($q);
                $total=0;
                if ($res = $conn->query($q))
                {
                    while($row = $res->fetch_array())
                    {
                        //$cartid=$row['CartID'];
                        if ($row['Status']!="PAID" && ($row['State']!="Active" && $row['State']!="Hidden")) {
                                $qd='DELETE FROM Cart WHERE CartItemID='.$row['CartItemID'];
                                $resultd=$conn->query($qd);
                            }
                            else{

                ?>
                    <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
                    <td><?php echo $row['ItemID']; ?> </td>
                    <td><img src="img/member/<?php echo $row['PIC']; ?>" width='40px'></td>
                    <?php
                        if($row['Style'] != 'Complete'){
                            echo '<td></td><td></td>';

                        }
                        else{
                            echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                            echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                        }
                    ?>
                    <td><a href="myitem.php?itemid=' <?php echo $row['ItemID']; ?>'"><img src='img/button/moredetail.png' width="25px"></a></td>
                    <td><?php echo $row['CartID']; ?> </td>
                    <td><?php echo $row['Price']; $total+=$row['Price']; ?> </td>
                    <td><a href="delcartc.php?delciid=' <?php echo $row['CartItemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                </tr>                               
                <?php
                }
                }
            }
            ?>  
        </table>
        <h2>TOTAL : <?php echo($total) ?> THB</h2>
        <a href="payment.php?price= <?php echo $total ?> &cartid=<?php echo $cartid ?>"><button type="button" class ="cart-gtp-btt">GO TO PAYMENT</button></a>
    <?php
        }
        else{
            echo('<h2> You don\'t have any item in your cart </h2>');
        }
    ?>
  </div>
</body>
<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
</html>