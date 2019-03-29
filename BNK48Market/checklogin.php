<?php
	session_start();
	include('dbconn.php');
	if ($conn->connect_errno) {
		echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
	}
	if(isset($_POST['login'])) {
		$username = trim($_POST['username']);
		$password = md5(trim($_POST['password']));
		
		if ($username != "" && $password != "")
		{
			$q = "SELECT * FROM users " .
			" WHERE (User_Status='Normal' OR User_Status='Admin') AND Username='".$username."' AND Password= '".$password."' ";
			if ($res = $conn->query($q))
			{
				if (mysqli_num_rows($res) == 1)
				{
					$row = $res->fetch_array();
					//var_dump($row);
					//echo($row['UID']);
					$_SESSION['uid'] = $row['UID'];
					$_SESSION['username'] = $row['Username'];
					//echo($_SESSION['uid']);
					header("Location: loggedin.php");

				}
				else{
					header("Location: index.1.php");
				}
			}
			else{
				echo 'Query error: '.$conn->error;
			}
		}
	}
?>