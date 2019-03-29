<!DOCTYPE html>
<html>
<?php
	include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
?>
<head>
	<title>Welcome to BNK 48 Market</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"></head>
<body class = "bgc-bob-color">
	<table class ="tablestyle main-table" width="85%">
		<tr>
			<td colspan="4">
				<div class = "shadowbox">
					<a href="contentmain.php" target="contentblock">
						<img class="banner" src="img/banner1.gif" width="100%">
						<img class="banner" src="img/banner2.png" width="100%">
						<img class="banner" src="img/banner3.png" width="100%">
					</a>
				</div>
			</td>	
		</tr>
		<tr >
			<td></td>
			<td colspan="2" height="25"  >
			<div class ="flex-searchbar">
				
			    <div>
			    <form method="POST" action="search.php" target="contentblock" autocomplete="off">
				<table class = "searchstyle"  >
					<tr  >
						<!-- SEARCH BAR -->					
							<?php  
								$style=array("---All---","Complete","Close-up","Full","Half","SSR");
								$mode=array("---All---","Buying","Selling","Trading");
							?>
								<td>BNK 48 Member: 
									<div class="autocomplete" style="width:150px;">
									    <input id="myMember" type="text" name="members" placeholder="Member name">
									</div>
								</td>
								<td>Set: 
									<div class="autocomplete" style="width:150px;">
									    <input id="mySet" type="text" name="sets" placeholder="Set name">
									</div>
								</td>
							<td>Style: 
							
								<select name="style" class = "searchbar-style">
							<?php
								for ($k=0; $k <sizeof($style) ; $k++) { 
									echo '<option value='.$style[$k].'>'.$style[$k].'</option>';
								}
							?>
								</select>
							</td>
							<td>Mode: 
							
								<select name="mode" id = "mode" class = "searchbar-mode">
									<?php
									for ($l=0; $l <sizeof($mode) ; $l++) { 
										echo '<option value='.$mode[$l].'>'.$mode[$l].'</option>';
									}
									?>
								</select>
							</td>
							<td>
								<input type="submit" name="search" value="GO!">
							</td>
					</tr>	
					<!-- TRADING SEARCHBAR START HERE-->
					<tr id = "searchbar-trading">
						<td>
							Trade for:
							<div class = "autocomplete">
								<input id="myMember2" type="text" name="trademembers" placeholder="Member name" class ="searchbar-trading-input-tradefor" style="width:150px;">
							</div>
						</td>
						<td>
							Set:
							<div class = "autocomplete">
								<input id='mySet2' type='text' name='settrade' placeholder='Set name' class = "searchbar-trading-input-set" style="width:150px;">
							</div>
						</td>
						<td>
							<div>
								Style:
									<select id = "styletrade" name="styletrade" class = "searchbar-trading-input-style">';
										<?php
										for ($k=0; $k <sizeof($style) ; $k++) { 
											
											echo '<option value='.$style[$k].'>'.$style[$k].'</option>';
											
										}
										?>
										</select>
							</div>
						</td>
					</tr>	
					<!-- END TRADING SEARCHBAR HERE-->	
				</table>
				</form>	
				</div>
				<!-- END SEARCH BAR	 -->
				<!-- ADD AND CART -->
				<?php 
					if ($_SESSION['username']!="admin") {
				?>
					<td>
					<table>
						<tr>
							<td width="106.7">
								<a href="add.php" target="contentblock"> <img src='img/button/add1.png' onmouseover="this.src='img/button/add2.png';" onmouseout="this.src='img/button/add1.png';" width="100%" class = "main-add-btt"/> </a>
							</td>
							<td width="40" height="40">
								<a href="cart.php" target="contentblock"> <img src='img/button/carta.png' onmouseover="this.src='img/button/cartb.png';" onmouseout="this.src='img/button/carta.png';" width="100%" /> </a>
							</td>
						</tr>
					</table>
					</td>
				<?php
				}

					else {
				?>
					<td>
						<table>
							<tr>

							</tr>
						</table>
					</td>
				<?php
				}
				?>						
			</div>
			</td>

			<!--END ADD AND CART HERE-->	
		</tr>
		<tr>
			<td width="200" height="75">
				<!-- LOGIN PART -->
                <table border="0" class = " centera login-box" >
                        <tr> 
                            <td colspan="2">Welcome back, </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo $username; ?>
                                    
                                </b>
                            </td>
                        </tr>
                        <?php  
                        	if ($username!="admin") {
									echo '<tr>
                            <td><a href="editaccount.php" target="contentblock"><img src=\'img/button/edit1.png\' onmouseover="this.src=\'img/button/edit2.png\';" onmouseout="this.src=\'img/button/edit1.png\';" width="100%" class = "shadowbox-hover-small"/></a></td>
                            <td><a href="myaccount.php?uid=\''.$uid.'\'" target="contentblock"><img src=\'img/button/myac1.png\' onmouseover="this.src=\'img/button/myac2.png\';" onmouseout="this.src=\'img/button/myac1.png\';" width="100%" class = "shadowbox-hover-small"/></a></td>
                        </tr >';
							}
							else{
								echo '<tr>
                            <td colspan="2"><a href="managewebsite.php" target="contentblock"><img src=\'img/button/manageweb1.png\' onmouseover="this.src=\'img/button/manageweb2.png\';" onmouseout="this.src=\'img/button/manageweb1.png\';" width="80%" class = "login-any-btt shadowbox-hover-small"/></a></td><tr>';

							}

                        ?>
                        
                        <tr>
                            <td colspan="2">
                                <table border="0" width="100%">
                                <tr>
                                    <td class = "login-logout-row centera">
                                        <input type="button" name="logout" value="Logout" onclick="window.location.href='logout.php'" width="100%" class = "login-logout-btt">
                                    </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                </table>
				<!-- END LOGIN PART -->
			</td>
			<td colspan="4" rowspan="5">   
			<!-- CONTENT BLOCK -->
			<iframe name="contentblock" src="contentmain.php" class="contentblock" frameborder = "0"></iframe>
			<!-- END CONTENT BLOCK -->	
			</td>
		</tr>
		<tr>
			<td width="200" height="75">
				<a href="contentmain.php?mode=Buying" target="contentblock"><img src='img/button/buy1.png' onmouseover="this.src='img/button/buy2.png';" onmouseout="this.src='img/button/buy1.png';" width="100%" class ="buyselltradebttstyle"/></a>		
				<a href="contentmain.php?&mode=Selling" target="contentblock"> <img src='img/button/sell1.png' onmouseover="this.src='img/button/sell2.png';" onmouseout="this.src='img/button/sell1.png';" width="100%" class ="buyselltradebttstyle"/> </a>	
				<a href="contentmain.php?uid=&mode=Trading" target="contentblock"> <img src='img/button/trade1.png' onmouseover="this.src='img/button/trade2.png';" onmouseout="this.src='img/button/trade1.png';" width="100%" class ="buyselltradebttstyle"/> </a>
			</td>
		</tr>
		<tr>
			<td>	
			</td>
		</tr>
	</table>
</body>
<footer>
	<div class="footer">
		<p>BNK48 Market</p>
		<p>All rights reseverved</p>
  		<p>Contact us: bnk48market@gmail.com</p>	
	</div>
</footer>
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="app.js"></script>
<script src="app2.js"></script>
<script>
	var slideIndex = 0;
	carousel();

	function carousel() {
	    var i;
	    var x = document.getElementsByClassName("banner");
	    for (i = 0; i < x.length; i++) {
	      x[i].style.display = "none"; 
	    }
	    slideIndex++;
	    if (slideIndex > x.length) {slideIndex = 1} 
	    x[slideIndex-1].style.display = "block"; 
	    setTimeout(carousel, 2000); // Change image every 2 seconds
	}
</script>
<!-- TRADING SEARCHBAR SCRIPT START HERE-->
<script>
		var el = document.getElementById("mode");
		el.addEventListener("change", function() {
		var elems = document.querySelectorAll('#searchbar-trading')
			for (var i = 0; i < elems.length; i++) {
				elems[i].style.display = 'none'
			}
			if (this.selectedIndex === 0) {
				document.querySelector('#searchbar-trading').style.display = 'none';
			} 
			else if (this.selectedIndex === 1) {
				document.querySelector('#searchbar-trading').style.display = 'none';
			}
			else if (this.selectedIndex === 2) {
				document.querySelector('#searchbar-trading').style.display = 'none';
			}
			else if (this.selectedIndex === 3) {
				document.querySelector('#searchbar-trading').style.display = 'table-row';
			}
			
		}	, false);
	</script>
	<!--END TRADING SEARCHBAR SCRIPT HERE-->
	<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
	<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
	<script>
		$("#mode").change(function(){
			if (document.getElementById("mode").value!="Trading") {
				$("#myMember2").val("");
				$("#mySet2").val("");
				$("#styletrade").val("---All---");
			}
		});
	</script>
</html>