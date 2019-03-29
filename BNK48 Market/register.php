<?php
	include('dbconn.php');
	if ($conn->connect_errno) {
		echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
	}
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
	if(isset($_POST['register'])) {
		$username = mysqli_real_escape_string($conn, $_POST["uname"]);
		$pw = md5($_POST["pw"]);
		$email = mysqli_real_escape_string($conn, $_POST["E-mail"]);
		$fname = mysqli_real_escape_string($conn, $_POST["fname"]);
		$lname = mysqli_real_escape_string($conn, $_POST["lname"]);
		$bday = $_POST["bday"];
		$phonenum = mysqli_real_escape_string($conn, $_POST["phonenum"]);
		$address = $_POST["address"];
		$title = mysqli_real_escape_string($conn, $_POST["title"]);
		$ppn = mysqli_real_escape_string($conn, $_POST["promptpayno"]);
		$ppt = $_POST["promptpaytype"];
		$q="INSERT INTO Users (Username,Password,Email,Title,Firstname,Lastname,Birthday,Tel,Address,promptpayno,promptpaytype) 
		VALUES ('$username','$pw','$email','$title','$fname','$lname','$bday','$phonenum','$address','$ppn','$ppt')";
		//$result=$conn->query($q);
		if ($result=$conn->query($q)) {
		header("Location: contentmain.php");
	}
		if(!$result){
			// echo "INSERT failed. Error: ".$conn->error ;
			echo "<script>alert('Username or Email has already been used')</script>";
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="styles.css">
</head>
<body class="centera bgc-base-color">
	<h2>Register</h2>
	<table class="tablestyle" width="400">
		<form method="POST" action="register.php">
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
					<b>Password:</b>
	    		</td>
	    		<td>
	    			<input type="password" name="pw" placeholder="Password" size ="31" minlength="8" required style = "width:100%">
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>E-mail:</b>
	    		</td>
	    		<td>
	    			<input type="email" name="E-mail" placeholder="Email" size ="31" required style = "width:100%">
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>Title:</b>
	    		</td>
	    		<td>
	    			<select name="title" class = "reg-title">
		    			<option value="Mr.">Mr.</option>
		    			<option value="Mrs.">Mrs.</option>
		    			<option value="Ms.">Ms.</option>
	    			</select>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>Firstname:</b>
	    		</td>
	    		<td>
	    			<input type="text" name="fname" placeholder="Firstname" required>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>Lastname:</b>
	    		</td>
	    		<td>
	    			<input type="text" name="lname" placeholder="Lastname" required>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>Birthday:</b>
	    		</td>
	    		<td>
	    			<input type="date" name="bday" placeholder="Date" class ="reg-date" required style = "width:100%">
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>Phone number:</b>
	    		</td>
	    		<td>
	    			<input type="text" name="phonenum" placeholder="Phone number" required>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td>
	    			<b>Address:</b>
	    		</td>
	    		<td>
	    			<textarea name="address" placeholder= "  Address" id="reg-address" border = "0" required></textarea>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
				<td class = "bold centerv">
	    			Promptpay No. :
	    		</td>
	    		<td>
	    			<input type="text" name="promptpayno" placeholder="Promptpay Number">
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
				<td class = "bold centerv">
	    			Promptpay Type :
	    		</td>
	    		<td>
	    			<select name="promptpaytype" class = "reg-ppphonenumber">
	    				<option value="Phone Number">Phone Number</option>
                		<option value="Citizen ID">Citizen ID</option>
	    			</select>
	    		</td>
	    	</tr>
	    	<tr class = "reg-row">
				<td>
	    			<input type="reset" name="reset" value="RESET" class = "shadowbox-hover-small">
	    		</td>
	    		<td>
	    			<input type="submit" name="register" value="Register!">
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