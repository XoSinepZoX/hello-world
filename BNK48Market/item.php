<?php
	include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
    if(isset($_GET['itemid'])) {
		$itemid=$_GET['itemid'];
	}
	$q = 'SELECT DateAdded,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE listings.itemID='.$itemid.' ORDER BY DateAdded DESC';
	$res = $conn->query($q);
	$row = $res->fetch_array();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="bgc-base-color citem-column">
		<div>
			<?php
				if ($row['Mode']=='Selling') {
					echo '<img src="img/button/selling.png" width="300" class = "shadowbox"><br>';
				}
				else if ($row['Mode']=='Buying'){
					echo '<img src="img/button/Buying.png" width="300" class = "shadowbox"><br>';
				}
				else if ($row['Mode']=='Trading'){
					echo '<img src="img/button/Trading.png" width="300" class = "shadowbox"><br>';
				}
				if ($row['Style']!='Complete') {
			?>	
					<img src="img/member/<?php echo $row['Pic'] ?>" width="300" class = "shadowbox"><br><br>
			<?php
				}
				else{
			?>
					<img class = "add2-slides centera shadowbox-hover" src="img/member/<?php echo $row['Pic'] ?>" width="300">
					<img class = "add2-slides centera shadowbox-hover" src="img/member/<?php echo $row['PIC2'] ?>" width="300">
					<img class = "add2-slides centera shadowbox-hover" src="img/member/<?php echo $row['PIC3'] ?>" width="300">
					<div class="citem-change-btt centera shadowbox">
						<div class="add2-left-btt" onclick="plusDivs(-1)">&#10094;</div>
						<span class="add2-badge add2-color-tomato" onclick="currentDiv(1)">(1)</span>
						<span class="add2-badge add2-color-tomato" onclick="currentDiv(2)">(2)</span>
						<span class="add2-badge add2-color-tomato" onclick="currentDiv(3)">(3)</span>
						<div class="add2-left-btt" onclick="plusDivs(1)">&#10095;</div>
					</div>
					<br>
			<?php
				}
			?>
		</div>
		<div class = "citem-info">
			<div class = "flexwrap citem-row"><div class = "bold">Date Added:</div><div> <?php echo $row['DateAdded'] ?></div></div><br>
			<div class = "flexwrap citem-row"><div class = "bold">Added by:</div><div><?php echo $row['Username'] ?></div></div><br>
			<div class = "flexwrap citem-row"><div class = "bold">Topic: </div><div> <?php echo $row['Topic'] ?></div></div><br>
			<div class = "flexwrap citem-row"><div class = "bold">Description: </div><div><?php echo $row['Description'] ?></div></div><br>
			<div class = "flexwrap citem-row"><div class = "bold">Member name: </div><div><?php echo $row['MemName'] ?></div></div><br>
			<div class = "flexwrap citem-row"><div class = "bold">Set: </div><div><?php echo $row['SetName'] ?></div></div><br>
			<div class = "flexwrap citem-row"><div class = "bold">Style: </div><div><?php echo $row['Style'] ?></div></div><br>
			<?php
				if($row['Mode']=='Trading'){
			?>
				<div class = "flexwrap citem-row"><div class = "bold">Trade for:</div><div><?php echo $row['TradeMemName'] ?></div></div><br>
				<div class = "flexwrap citem-row"><div class = "bold">Set:</div><div><?php echo $row['TradeSetName'] ?></div></div><br>
				<div class = "flexwrap citem-row"><div class = "bold">Style:</div><div><?php echo $row['TradeStyle'] ?></div></div><br>
			<?php
			}
			else{
			?>
				<div class = "flexwrap citem-row"><div class = "citem-price"><?php echo $row['Price'] ?> THB</div></div><br>
			<?php 
				}
				if($uid==""){
			?>
					<div class = "flexwrap citem-row"><img src="img/button/pleaselogin.png" height="60" class = "shadowbox-hover"></div>
			<?php
				}
				elseif ($username=="admin") {
					# code...
				}
				else if($username==$row['Username']){
			?>
				<div class = "flexwrap citem-row"><img src="img/button/youritem.png" height="60px" class = "shadowbox-hover"></div>
			<?php
				}
				else{
					if ($row['Mode']=="Trading") {
					?>
						<div class = "flexwrap citem-row"><a href="treq.php?itemid='<?php echo($itemid) ?>'"><img src="img/button/treq.png" width="300" class = "shadowbox-hover"></a></div>
					<?php
					}
					else if ($row['Mode']=="Buying") {
					?>
						<div class = "flexwrap citem-row"><a href="sreq.php?itemid='<?php echo($itemid) ?>'"><img src="img/button/sreq.png" width="300" class = "shadowbox-hover"></a></div>
					<?php
					}
					else{
					?>
						<div class = "flexwrap citem-row"><a href="atc.php?itemid=<?php echo($itemid) ?>" onclick = "alert_atc()"><img src="img/button/atc.png" width="300" class = "shadowbox-hover"></a></div>
					<?php
					}
				}
			?>
		</div>
	</div>
</body>
<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
		showDivs(slideIndex += n);
		}

		function currentDiv(n) {
		showDivs(slideIndex = n);
		}
		function showDivs(n) {
		    var i;
		    var x = document.getElementsByClassName("add2-slides");
		    var dots = document.getElementsByClassName("add2-badge");
		    if (n > x.length) {slideIndex = 1}    
		    if (n < 1) {slideIndex = x.length}
		    for (i = 0; i < x.length; i++) {
		     x[i].style.display = "none";  
		    }
		    for (i = 0; i < dots.length; i++) {
		       dots[i].className = dots[i].className.replace(" add2-color-tomato", " add2-color-blue");
		    }
		    x[slideIndex-1].style.display = "block";  
		    dots[slideIndex-1].className += " add2-color-tomato";
		}
	</script>
	<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
	<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
	<script>
		function alert_atc() {
			alert("Item added to cart")
		}
	</script>
</html>
