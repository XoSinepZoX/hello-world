<?php
	include('dbconn.php');
	if ($conn->connect_errno) {
		echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
	}
	if(isset($_POST['next'])) {
		$username = mysqli_real_escape_string($conn,$_POST["uname"]);
		$email = $_POST["E-mail"];
		//echo $username;
		//echo $password;
		$q = 'SELECT UID,Username,Password,Email FROM users WHERE Username="'.$username.'"';
			if ($res = $conn->query($q))
			{
				$row = $res->fetch_array();
				//echo $username;
				//echo $row['Password'];
				if($email==$row['Email']){
					$uid=$row['UID'];
				}
				else{
					header("Location: forget.php");
				}
			}
			else{
				echo 'Query error: '.$conn->error;
			}
	}
	if(isset($_POST['change'])) {
		$password = md5($_POST["password"]);
		$uid = $_POST["uid"];
		
		$q="UPDATE users SET " .
		"Password = '".$password."' " .
		" WHERE UID = '".$uid."'";
		$result=$conn->query($q);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
		}
		header("Location: contentmain.php");
	}


?>
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
			<input type="hidden" name="uid" value="<?php echo $uid; ?>">
			<tr class = "reg-row">
    			<td>
    				<b>New Password:</b>
    			</td>
    			<td>
    				<input type="password" name="password" placeholder="Password" minlength="8" required>
    			</td>
	    	</tr>
	    	<tr class = "reg-row">
	    		<td colspan="2">
	    			<input type="submit" name="change" value="Change Password">
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