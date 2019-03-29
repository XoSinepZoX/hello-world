<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    if(isset($_GET['itemid'])){
    	$itemid=$_GET['itemid'];
    	//echo($itemid);
    }
?>
<!DOCTYPE html>
<html>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style2.css">
<link rel="stylesheet" href="styles.css">
<body class = "bgc-base-color">
<div class="managewebsiteoriginal-container">
  <h2>Send Sales Request</h2>
  	<?php
    $q = 'SELECT * FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID WHERE Listings.ItemID='.$itemid.';';
    if ($res = $conn->query($q))
    {
        $row=$res->fetch_array();
    }
?>
    <div class = "myaccount-account-info">
        <div class = "myaccount-account-info-row"><div class = "bold ">Topic :</div> <div><?php echo($row['Topic']);  ?></div></div><br>
        <div class = "myaccount-account-info-row"><div class = "bold">Description :</div> <div><?php echo($row['Description']);  ?></div></div><br>
        <div class = "myaccount-account-info-row"><div class = "bold">Given Price :</div> <div><?php echo($row['Price']);  ?> THB</div></div><br>
        <u>NOTE</u> : the price of your listing will change to buyer's price as soon as he/she accepts the request
    </div>
    <?php 
        $q='SELECT COUNT(*) AS cnt FROM listings WHERE Mode="Selling" AND Status="Active" AND UID='.$uid;
        //echo($q);
        $res=$conn->query($q);
        $row=$res->fetch_array();
        $cnt=$row['cnt'];
    if ($cnt>'0') {
    ?>
    <form method="POST" action="requestQ.php">
    	<input type="hidden" name="itemmain" value="<?php echo $itemid; ?>">
    	<br>
    	<div class="managewebsiteoriginal-container managewebsiteoriginal-border listing">
    	<table border="0">
            <tr class = "managewebsite-colomn">
            	<td>

            	</td>
                <td>
                    <b>DateAdded</b>
                </td>
                <td>
                    <b>ItemID</b>
                </td>
                <td>
                    <b>Topic</b>
                </td>
                <td>
                    <b>Description</b>
                </td>
                <td>
                    <b>PIC</b>
                </td>
                <td>
                    <b>PIC</b>
                </td>
                <td>
                    <b>PIC</b>
                </td>
                <td>
                    <b>Member Name</b>
                </td>
                <td>
                    <b>Set Name</b>
                </td>
                <td>
                    <b>Style</b>
                </td>
            </tr>
            <?php
                $q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE listings.UID='.$uid.' AND Status = "Active" AND Mode="Selling" ORDER BY DateAdded DESC';
                //echo($q);
                if ($res = $conn->query($q))
                {
                    while($row = $res->fetch_array())
                    {
                        //var_dump($row);
                ?>
                 <tr class = "managewebsite-row">
                 	<td class = "managewebsite-memberandset-table-row">
                 		<input type="radio" name="item" value="<?php echo $row['ItemID']; ?>" required>
                 	</td>
                    <td><?php echo $row['DateAdded']; ?></td> 
                    <td><?php echo $row['ItemID']; ?> </td>
                    <td><?php echo $row['Topic']; ?> </td>
                    <td><?php echo $row['Description']; ?> </td>
                    <td><img src="img/member/<?php echo $row['Pic']; ?>" width='40px'></td>
                    <?php
                        if($row['Style'] != 'Complete'){
                            echo '<td></td><td></td>';

                        }
                        else{
                            echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                            echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                        }
                    ?>
                    <td><?php echo $row['MemName']; ?> </td>
                    <td><?php echo $row['SetName']; ?> </td>
                    <td><?php echo $row['Style']; ?> </td>
                </tr>                               
                <?php
                }
                }
            ?>  
        </table>
    	</div>
    	<div class="centera">
    		<br>
    		<input type="submit" name="sends" value="SEND SALES REQUEST" onclick = "alert_sreq()">
    		<br>
    		<br>
    		Cannot find your listing? <a href="add.php" class = "treq-addlist">Add listing here</a>
    	</div>
    	
    </form>
    <?php
     }
     else{
        echo '<br><br>Before sending request <a href="add.php" class = "treq-addlist">Please add listing here</a>';
     }   
    ?>   
   
</body>
<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
    <!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
    <script>
		function alert_sreq() {
			alert("Sales request sent")
		}
	</script>
</html>

