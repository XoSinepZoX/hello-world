<?php
	include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
    $mode="";
    if (isset($_GET['mode']) && strlen($_GET['mode']) > 0 )
    {
        $mode=$_GET['mode'];
        //echo($mode);
    }
	$compcount = 0;
	$sellingcount = 0;
	$buyingcount = 0;
	$tradingcount = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="styles.css">
</head>
<body class="centera bgc-base-color" style = "margin-left:4em">
	<div class = "flex-item">
		<!-- ITEM LOOP BEGIN -->
			<!-- QUARY PART START HERE -->
				<?php
				$q = 'SELECT listings.ItemID,Topic,Pic,Mode,Style,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3,Username FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Active" ORDER BY DateAdded DESC';
				if ($mode=='Selling') {
					$q = 'SELECT listings.ItemID,Topic,Pic,Mode,Style,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3,Username FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Active" AND Mode="Selling" ORDER BY DateAdded DESC';
				}
				else if ($mode=='Buying') {
					$q = 'SELECT listings.ItemID,Topic,Pic,Mode,Style,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3,Username FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Active" AND Mode="Buying" ORDER BY DateAdded DESC';
				}
				else if ($mode=='Trading') {
					$q = 'SELECT listings.ItemID,Topic,Pic,Mode,Style,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3,Username FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Active" AND Mode="Trading" ORDER BY DateAdded DESC';
				}
				$count=0;
				if ($res = $conn->query($q))
				{
					while($row = $res->fetch_array())
					{
						//var_dump($row);
				?>
			<!-- END QUARY PART HERE -->
				<div class ="itemstyle">
					<table width="200" border=0>
					<!-- BANNER BTT START HERE -->
						<tr>
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>">
								<?php
									if ($row['Mode']=='Selling') {
										echo '<img src="img/button/selling.png" onmouseover="this.src=\'img/button/selling2.png\';" onmouseout="this.src=\'img/button/selling.png\';" width="100%" class = "shadowbox-hover" id = "selling-btt'.$sellingcount.'">';
									}
									else if ($row['Mode']=='Buying') {
										echo '<img src="img/button/buying.png" onmouseover="this.src=\'img/button/buying2.png\';" onmouseout="this.src=\'img/button/buying.png\';" width="100%" class = "shadowbox-hover" id = "buying-btt'.$buyingcount.'">';
									}
									else{
										echo '<img src="img/button/trading.png" onmouseover="this.src=\'img/button/trading2.png\';" onmouseout="this.src=\'img/button/trading.png\';" width="100%" class = "shadowbox-hover" id = "trading-btt'.$tradingcount.'">';
									}
								?>
								 </a>
							</td>
						</tr>
					
					<!-- BANNER BTT START HERE -->
					<!-- PIC PART START HERE -->
						<tr>
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>">
								<?php  
									if ($row['Style']!='Complete') {
										if ($row['Mode']=='Selling') { ?>
											<img src="img/member/<?php echo $row['Pic'];?>" width="100%" class ="shadowbox-hover" onmouseover="getElementById('selling-btt<?php echo $sellingcount ;?>').src='img/button/selling2.png';" onmouseout="getElementById('selling-btt<?php echo $sellingcount ?>').src='img/button/selling.png';">
										<?php }
										else if ($row['Mode']=='Buying') { ?>
											<img src="img/member/<?php echo $row['Pic'];?>" width="100%" class ="shadowbox-hover" onmouseover="getElementById('buying-btt<?php echo $buyingcount ;?>').src='img/button/buying2.png';" onmouseout="getElementById('buying-btt<?php echo $buyingcount ?>').src='img/button/buying.png';">

										<?php }
										else{ ?>
											<img src="img/member/<?php echo $row['Pic'];?>" width="100%" class ="shadowbox-hover" onmouseover="getElementById('trading-btt<?php echo $tradingcount ;?>').src='img/button/trading2.png';" onmouseout="getElementById('trading-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
										<?php }
									}
									else{
										if ($row['Mode']=='Selling') { ?>
											<img src="img/member/<?php echo $row['Pic'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('selling-btt<?php echo $sellingcount ;?>').src='img/button/selling2.png';" onmouseout="getElementById('selling-btt<?php echo $sellingcount ?>').src='img/button/selling.png';">
											<img src="img/member/<?php echo $row['PIC2'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('selling-btt<?php echo $sellingcount ;?>').src='img/button/selling2.png';" onmouseout="getElementById('selling-btt<?php echo $sellingcount ?>').src='img/button/selling.png';">
											<img src="img/member/<?php echo $row['PIC3'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('selling-btt<?php echo $sellingcount ;?>').src='img/button/selling2.png';" onmouseout="getElementById('selling-btt<?php echo $sellingcount ?>').src='img/button/selling.png';">
										<?php }
										else if ($row['Mode']=='Buying') { ?>
											<img src="img/member/<?php echo $row['Pic'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('buying-btt<?php echo $buyingcount ;?>').src='img/button/buying2.png';" onmouseout="getElementById('buying-btt<?php echo $buyingcount ?>').src='img/button/buying.png';">
											<img src="img/member/<?php echo $row['PIC2'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('buying-btt<?php echo $tradingcount ;?>').src='img/button/buying2.png';" onmouseout="getElementById('buying-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
											<img src="img/member/<?php echo $row['PIC3'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('buying-btt<?php echo $buyingcount ;?>').src='img/button/buying2.png';" onmouseout="getElementById('buying-btt<?php echo $buyingcount ?>').src='img/button/buying.png';">
										<?php }
										else{ ?>
											<img src="img/member/<?php echo $row['Pic'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('trading-btt<?php echo $tradingcount ;?>').src='img/button/trading2.png';" onmouseout="getElementById('trading-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
											<img src="img/member/<?php echo $row['PIC2'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('trading-btt<?php echo $tradingcount ;?>').src='img/button/trading2.png';" onmouseout="getElementById('trading-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
											<img src="img/member/<?php echo $row['PIC3'];?>" width="100%" class ="itemstyle-slides centera shadowbox-hover itemstyle-slides<?php echo $compcount?>" onmouseover="getElementById('trading-btt<?php echo $tradingcount ;?>').src='img/button/trading2.png';" onmouseout="getElementById('trading-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
										<?php } ?>
								</a>
							</td>
						</tr>
						<!-- END PIC PART HERE -->
						<!-- BADGE PART START HERE -->
						<tr>
							<td>
										<div class="itemstyle-change-btt centera shadowbox">
											<div class="itemstyle-left-btt" <?php echo 'onclick="plusDivs'.$compcount.'(-1)"'?>>&#10094;</div>
											<span class="itemstyle-badge itemstyle-badge<?php echo $compcount?>" <?php echo 'onclick="currentDiv'.$compcount.'(1)"'?>>(1)</span>
											<span class="itemstyle-badge itemstyle-badge<?php echo $compcount?>" <?php echo 'onclick="currentDiv'.$compcount.'(2)"'?>>(2)</span>
											<span class="itemstyle-badge itemstyle-badge<?php echo $compcount?>" <?php echo 'onclick="currentDiv'.$compcount.'(3)"'?>>(3)</span>
											<div class="itemstyle-right-btt" <?php echo 'onclick="plusDivs'.$compcount.'(1)"'?>>&#10095;</div>
										</div>
								<?php
									$compcount = $compcount +1;
									}
								?>
							</td>
						</tr>
						<!-- END BADGE PART HERE -->
						<tr>
							<td>Added By: <?php echo $row['Username']; ?> </td>
						</tr>
						<!-- TOPIC PART START HERE -->
						<?php 
							if ($row['Mode']=='Selling') { ?>
						<tr  onmouseover="getElementById('selling-btt<?php echo $sellingcount ;?>').src='img/button/selling2.png';" onmouseout="getElementById('selling-btt<?php echo $sellingcount ?>').src='img/button/selling.png';">
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>"><b><?php echo $row['Topic']; ?></b></a>
							</td>
						</tr>
							<?php }
							else if ($row['Mode']=='Buying') { ?>
						<tr onmouseover="getElementById('buying-btt<?php echo $buyingcount ;?>').src='img/button/buying2.png';" onmouseout="getElementById('buying-btt<?php echo $buyingcount ?>').src='img/button/buying.png';">
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>"><b><?php echo $row['Topic']; ?></b></a>
							</td>
						</tr>
							<?php }
							else{ ?>
						<tr onmouseover="getElementById('trading-btt<?php echo $tradingcount ;?>').src='img/button/trading2.png';" onmouseout="getElementById('trading-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>"><b><?php echo $row['Topic']; ?></b></a>
							</td>
						</tr>
							<?php } ?>
						<!-- END TOPIC PART HERE -->
						<!-- PRICE PART START HERE -->
							<?php 
							if ($row['Mode']=='Selling') { ?>
						<tr  onmouseover="getElementById('selling-btt<?php echo $sellingcount ;?>').src='img/button/selling2.png';" onmouseout="getElementById('selling-btt<?php echo $sellingcount ?>').src='img/button/selling.png';">
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>"><b>Price</b><?php echo ':'.$row['Price'].' THB'; ?></a>
							</td>
						</tr>
							<?php }
							else if ($row['Mode']=='Buying') { ?>
						<tr onmouseover="getElementById('buying-btt<?php echo $buyingcount ;?>').src='img/button/buying2.png';" onmouseout="getElementById('buying-btt<?php echo $buyingcount ?>').src='img/button/buying.png';">
							<td>
								<a  href="item.php?itemid=<?php echo($row['ItemID']) ?>"><b>Price</b><?php echo ':'.$row['Price'].' THB'; ?></a>
							</td>
						</tr>
							<?php }
							else{ ?>
						<tr onmouseover="getElementById('trading-btt<?php echo $tradingcount ;?>').src='img/button/trading2.png';" onmouseout="getElementById('trading-btt<?php echo $tradingcount ?>').src='img/button/trading.png';">
							<td>
							</td>
						</tr>
							<?php } ?>
						<!-- END PRICE PART HERE -->
						<!-- ADD TO CART BTT STRRT HERE -->
						<tr>
							<td>
								<?php
									if ($_SESSION['username']=="admin") {
										if ($row['Mode']=='Selling') {
											$sellingcount = $sellingcount + 1;
										}
										else if ($row['Mode']=='Buying') {
											$buyingcount = $buyingcount + 1;
										}
										else{
											$tradingcount = $tradingcount + 1;
										}
									}
									else if($_SESSION['username']==""){
											echo '<img src="img/button/pleaselogin.png" width="100%" class = "itemstyle-addtocart-btt">';
											if ($row['Mode']=='Selling') {
											$sellingcount = $sellingcount + 1;
											}
											else if ($row['Mode']=='Buying') {
												$buyingcount = $buyingcount + 1;
											}
											else{
												$tradingcount = $tradingcount + 1;
											}
									}
									else if($row['Username']!=$_SESSION['username'])
									{
										if ($row['Mode']=='Selling') {
											echo '<a href="atc.php?itemid='.$row['ItemID'].'" onclick = "alert_atc()"><img src="img/button/atc.png" width="100%" class = "itemstyle-addtocart-btt"></a>';
											$sellingcount = $sellingcount + 1;
										}
										else if ($row['Mode']=='Buying') {
											echo '<a href="sreq.php?itemid='.$row['ItemID'].'" width="100%" class = "itemstyle-addtocart-btt"><img src="img/button/sreq.png" width="100%" class = "itemstyle-addtocart-btt"></a>';
											$buyingcount = $buyingcount + 1;
										}
										else{
											echo '<a href="treq.php?itemid='.$row['ItemID'].'"><img src="img/button/treq.png" width="100%" class = "itemstyle-addtocart-btt"></a>';
											$tradingcount = $tradingcount + 1;
										}		
									}
									else{
										echo '<img src="img/button/youritem.png" width="100%" class = "itemstyle-addtocart-btt">';
										if ($row['Mode']=='Selling') {
											$sellingcount = $sellingcount + 1;
											}
										else if ($row['Mode']=='Buying') {
											$buyingcount = $buyingcount + 1;
										}
										else{
											$tradingcount = $tradingcount + 1;
										}
									}
								?>
							</td>
						</tr>
						<!-- END ADD TO CART BTT HERE -->
					</table>
				</div>
				
                                                
				<?php
					$count++;
				}
				}
				if ($count%3==2) {
					echo '<table width=200 class ="itemstyle"></table>';
				}
			?>  
		<!-- ITEM LOOP END -->
	</div>

</body>
	<script>
		var compcount = "<?php echo $compcount ?>";
		<?php
			for ($i=0; $i < $compcount; $i++) { 
				echo 'var slideIndex'.$i.' = 1;
				var SIV'.$i.' = document.getElementById("itemstyle-badge'.$i.'");
				showDivs'.$i.'(slideIndex'.$i.');

				function plusDivs'.$i.'(n'.$i.') {
				showDivs'.$i.'(slideIndex'.$i.' += n'.$i.');
				}

				function currentDiv'.$i.'(n'.$i.') {
				showDivs'.$i.'(slideIndex'.$i.' = n'.$i.');
				}
				function showDivs'.$i.'(n'.$i.') {
					var i'.$i.';
					var x'.$i.' = document.getElementsByClassName("itemstyle-slides'.$i.'");
					var dots'.$i.' = document.getElementsByClassName("itemstyle-badge'.$i.'");
					if (n'.$i.' > x'.$i.'.length) {slideIndex'.$i.' = 1}    
					if (n'.$i.' < 1) {slideIndex'.$i.' = x'.$i.'.length}
					for (i = 0; i < x'.$i.'.length; i++) {
						x'.$i.'[i].style.display = "none";  
					}
					for (i = 0; i < dots'.$i.'.length; i++) {
						dots'.$i.'[i].style.color = "dodgerblue"; 
					}
					x'.$i.'[slideIndex'.$i.'-1].style.display = "block";  
					dots'.$i.'[slideIndex'.$i.' -1].style.color = "#ea709a";
				}
				'
				;
			}
			for ($i=0; $i <$sellingcount ; $i++) { 
				
			}
		?>
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