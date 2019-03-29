<?php
	include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
	session_start();
	$_SESSION['uid'] = "";
	$_SESSION['username'] = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to BNK 48 Market</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"></head>
<body class = "bgc-bob-color">
	<table class ="tablestyle main-table" width="85%" border = "0">
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
			<td colspan="4" height="25"  >
			<div class ="flex-searchbar">
				<div width="146.7" height="40" >
				
				</div>
				
			    <div>
			    <form method="POST" action="search.php" target="contentblock" autocomplete="off">
				<table class = "searchstyle" border ="0">
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
							
								<select name="mode" class = "searchbar-mode" id="mode" >
									<?php
									for ($l=0; $l <sizeof($mode) ; $l++) { 
										echo '<option value='.$mode[$l].'>'.$mode[$l].'</option>';
									}
									?>
								</select>
							</td>
							<td>
								<input type="submit" name="search" value="GO!" class = "searchbar-go-btt">
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
									<select id='styletrade' name="styletrade" class = "searchbar-trading-input-style">';
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
				<div width="146.7" height="40" >
				
				</div>
				<!-- END SEARCH BAR	 -->
		</tr>
		<tr>
			<td width="200" height="75">
				<!-- LOGIN PART -->
				<table class = "login-box">
					<form action="checklogin.php" method="POST">
						<tr> 
							<td>Username: </td>
							<td><input type="text" name="username" placeholder="Username" class = "login-usn" required></td>
						</tr>
						<tr> 
							<td>Password: </td>
							<td><input type="password" name="password" placeholder="Password" class = "login-psw" required></td>
						</tr >
						<tr>
							<td colspan="2">
								<table border="0" width="100%">
								<tr>
									<td colspan="2">
										<input type="submit" name="login" value="Login" class = "login-login-btt">
									</td>
								</tr>
								<tr>
									<td>
										<a href="register.php" target="contentblock"><img src='img/button/register1.png' onmouseover="this.src='img/button/register2.png';" onmouseout="this.src='img/button/register1.png';" width="80" class = "login-reg-btt">
									</td>
									<td>
										<a href="forget.php" target="contentblock"><img src='img/button/forget1.png' onmouseover="this.src='img/button/forget2.png';" onmouseout="this.src='img/button/forget1.png';" width="80" class = "login-reg-btt">
									</td>
								</tr>
							</table>
							</td>
						</tr>
					</form>
				</table>
				<!-- END LOGIN PART -->
			</td>
			<td colspan="4" rowspan="5"> 
			    
			<!-- CONTENT BLOCK -->
			<iframe name="contentblock" src="contentmain.php" class="contentblock" frameBorder="0"></iframe>
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