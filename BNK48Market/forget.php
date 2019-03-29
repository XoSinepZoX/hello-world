<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="styles.css">
</head>
<body class="centera bgc-base-color">
	<h2>Forget Password</h2>
	<table class="tablestyle" width="400" border="0">
		<form method="POST" action="forget2.php">
			<tr class = "reg-row">
    			<td>
    				<b>Username:</b>
    			</td>
    			<td>
    				<input type="text" name="uname" placeholder="Username" required>
    			</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>E-mail:</b>
	    		</td>
	    		<td>
	    			<input type="email" name="E-mail" placeholder="Email" size ="31" required>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td colspan="2">
	    			<input type="submit" name="next" value="Next">
	    		</td>
	    	</tr>
		</form>
	</table>
</body>
<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
</html>