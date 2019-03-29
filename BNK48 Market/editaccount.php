<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    $q = 'SELECT * FROM Users WHERE UID='.$uid.';';
    if ($res = $conn->query($q))
    {
        $row=$res->fetch_array();
    }
    if(isset($_POST['Update'])) {
        $email = $_POST["email"];
        $title = $_POST["title"];
        $fname = mysqli_real_escape_string($conn,$_POST["firstname"]);
        $lname = mysqli_real_escape_string($conn,$_POST["lastname"]);
        $bday = $_POST["birthday"];
        $tel = $_POST["phonenumber"];
        $addr = $_POST["address"];
        
        $q="UPDATE Users SET " .
        "Email = '".$email."' " .
        ",Title = '".$title."' " .
        ",Firstname = '".$fname."' " .
        ",Lastname = '".$lname."' " .
        ",Birthday = '".$bday."' " .
        ",Tel = '".$tel."' " .
        ",Address = '".$addr."' " .
        " WHERE UID = '".$uid."'";
        $result=$conn->query($q);
        if(!$result){
            echo "INSERT failed. Error: ".$conn->error ;
        }
        else{
            header("Location: myaccount.php");
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
    <h2>Edit account</h2>
	<table class = "tablestyle" width = "400">
        <form action="editaccount.php" method="POST">
            <!-- EDIT EMAIL-->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                E-mail:
                            </div>
                        </td>
                        <td>
                            <input type="email" name="email" value="<?php echo $row['Email'] ?>" size = "31" class = "editaccount-email">
                        </td>
                    </tr>
                    <!-- END EDIT EMAIL -->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                Title:
                            </div>
                        </td>
                        <td>
                            <select name="title" class = "reg-title">
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </td>
                    </tr>
                    <!-- EDIT FIRSTNAME -->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                Firstname:
                            </div>
                        </td>
                        <td>
                            <input type="text" name="firstname" value="<?php echo $row['Firstname'] ?>">
                        </td>
                    </tr>
                    <!-- END EDIT FIRSTNAME -->

                    <!-- EDIT LASTNAME -->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                Lastname:
                            </div>
                        </td>
                        <td>
                            <input type="text" name="lastname" value="<?php echo $row['Lastname'] ?>">
                        </td>
                    </tr>
                    <!-- END EDIT LASTNAME -->
                    
                    <!-- EDIT BIRTHDAY -->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                Birthday:
                            </div>
                        </td>
                        <td>
                            <input type="date" name="birthday" value="<?php echo $row['Birthday'] ?>" class = "editaccount-date">
                        </td>
                    </tr>
                    <!-- END EDIT BIRTHDAY -->

                    <!-- EDIT PHONENUMBER -->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                Phone number:
                            </div>
                        </td>
                        <td>
                            <input type="text" size = "31" name="phonenumber" value="<?php echo $row['Tel'] ?>">
                        </td>
                    </tr>
                    <!-- END EDIT PHONENUMBER -->

                    <!-- EDIT ADDRESS -->
                    <tr class = "editaccount-row">
                        <td>
                            <div class = "bold">
                                Address:
                            </div>
                        </td>
                        <td>
                            <textarea name="address" placeholder="  Address" id="reg-address" border = "0"><?php echo $row['Address'] ?></textarea>
                        </td>
                    </tr>
                    <!-- END EDIT ADDRESS -->
                    <tr class="editaccount-summit-button">
                        <td><input type="reset" name="reset" value="RESET" class = "shadowbox-" width="100%"></td>
                        <td><input type="submit" name="Update" value="UPDATE"  width="100%"></td>
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