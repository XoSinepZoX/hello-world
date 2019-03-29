<?php
	include('dbconn.php');
	if ($conn->connect_errno) {
		echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
	}
	if(isset($_POST['addMem'])) {
		$memName = $_POST["addmemname"];
		$memGen = $_POST["addmemgen"];
		
		$q="INSERT INTO Members (MemName,Gen,Status) 
		VALUES ('$memName','$memGen','Active')";
		$result=$conn->query($q);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
		}
	}
	if(isset($_POST['addSet'])) {
		$setName = $_POST["addsetname"];
		$setGen = $_POST["addsetgen"];
		
		$q="INSERT INTO Sets (SetName,Gen) 
		VALUES ('$setName','$setGen')";
		$result=$conn->query($q);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
		}
	}
	if(isset($_POST['change'])) {
		$mem = $_POST["members"];
		$Status = $_POST["Status"];
		$Genc = $_POST["Genc"];
		
		$q="UPDATE Members SET " .
		"Status = '".$Status."' " .
		" WHERE MemName = '".$mem."' AND Gen= '".$Genc."'";
		$result=$conn->query($q);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
		}
	}
	session_start();
	$uid=$_SESSION['uid'];
	$username=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style2.css">
<link rel="stylesheet" href="styles.css">
<body class = "bgc-base-color">

<div class="managewebsiteoriginal-bar managewebsite-bar managewebsite-mainbar">
	<button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0 managewebsiteoriginal-red2  managewebsite-bar-button" onclick="openMain(event,'ListingListing')" style ="padding:16px 50px;">Listings</button>
	<button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'MembersandSets')" style ="padding:16px 50px;">Members and Sets</button>
	<button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'AddandChange')" style ="padding:16px 50px;">Add & Change status</button>
	<button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'User')" style ="padding:16px 50px;">Users</button>
	<button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'Usertran')" style ="padding:16px 50px;" style ="padding:16px 50px;">Money transfer</button>
</div>

<div>
<div id = "ListingListing" class="managewebsiteoriginal-container allitem">
		<h2>Listings</h2>
		<div class="managewebsiteoriginal-bar managewebsite-bar">
			<button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink managewebsiteoriginal-red  managewebsite-bar-button" onclick="openListing(event,'All')">ALL</button>
			<button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink" onclick="openListing(event,'Active')">Active</button>
			<button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink" onclick="openListing(event,'Inactive')">Inactive</button>
		</div>
	
		<div id="All" class="managewebsiteoriginal-container managewebsiteoriginal-border listing">
			<table border="0">
				<tr class = "managewebsite-colomn">
					<td>
						<b>DateAdded</b>
					</td>
					<td>
						<b>ItemID</b>
					</td>
					<td>
						<b>Owner</b>
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
					<td>
						<b>Mode</b>
					</td>
					<td>
						<b>Price</b>
					</td>
					<td>
						<b>Trade Member Name</b>
					</td>
					<td>
						<b>Trade Set Name</b>
					</td>
					<td>
						<b>Trade Style</b>
					</td>
					<td>
						<b>Status</b>
					</td>
					<td>
						<b>Delete</b>
					</td>
				</tr>
				<?php
					$q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID ORDER BY DateAdded DESC';
					if ($res = $conn->query($q))
					{
						while($row = $res->fetch_array())
						{
							//var_dump($row);
					?>
					<tr class = "managewebsite-row">
						<td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
						<td><?php echo $row['ItemID']; ?> </td>
						<td><?php echo $row['Username']; ?> </td>
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
						<td><?php echo $row['Mode']; ?> </td>
						<td><?php echo $row['Price']; ?> </td>
						<td><?php echo $row['TradeMemName']; ?> </td>
						<td><?php echo $row['TradeSetName']; ?> </td>
						<td><?php echo $row['TradeStyle']; ?> </td>
						<td><?php echo $row['Status']; ?> </td>
						<td><a href="delete.php?itemid=' <?php echo $row['ItemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
					</tr>                               
					<?php
					}
					}
				?>  
			</table>
		</div>


		<div id="Active" class="managewebsiteoriginal-container managewebsiteoriginal-border listing" style="display:none">
			<table border="0">
				<tr class = "managewebsite-colomn">
					<td>
						<b>DateAdded</b>
					</td>
					<td>
						<b>ItemID</b>
					</td>
					<td>
						<b>Owner</b>
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
					<td>
						<b>Mode</b>
					</td>
					<td>
						<b>Price</b>
					</td>
					<td>
						<b>Trade Member Name</b>
					</td>
					<td>
						<b>Trade Set Name</b>
					</td>
					<td>
						<b>Trade Style</b>
					</td>
					<td>
						<b>Status</b>
					</td>
					<td>
						<b>Delete</b>
					</td>
				</tr>
				<?php
					$q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Active" ORDER BY DateAdded DESC';
					if ($res = $conn->query($q))
					{
						while($row = $res->fetch_array())
						{
							//var_dump($row);
					?>
					<tr class = "managewebsite-row">
						<td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
						<td><?php echo $row['ItemID']; ?> </td>
						<td><?php echo $row['Username']; ?> </td>
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
						<td><?php echo $row['Mode']; ?> </td>
						<td><?php echo $row['Price']; ?> </td>
						<td><?php echo $row['TradeMemName']; ?> </td>
						<td><?php echo $row['TradeSetName']; ?> </td>
						<td><?php echo $row['TradeStyle']; ?> </td>
						<td><?php echo $row['Status']; ?> </td>
						<td><a href="delete.php?itemid=' <?php echo $row['ItemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
					</tr>                               
					<?php
						}
					}
				?>  
			</table>
	</div>

	<div id="Inactive" class="managewebsiteoriginal-container managewebsiteoriginal-border listing" style="display:none">
			<table border="0">
				<tr class = "managewebsite-colomn">
					<td>
						<b>DateAdded</b>
					</td>
					<td>
						<b>ItemID</b>
					</td>
					<td>
						<b>Owner</b>
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
					<td>
						<b>Mode</b>
					</td>
					<td>
						<b>Price</b>
					</td>
					<td>
						<b>Trade Member Name</b>
					</td>
					<td>
						<b>Trade Set Name</b>
					</td>
					<td>
						<b>Trade Style</b>
					</td>
					<td>
						<b>Status</b>
					</td>
					<td>
						<b>Delete</b>
					</td>
				</tr>
				<?php
					$q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Inactive" ORDER BY DateAdded DESC';
					if ($res = $conn->query($q))
					{
						while($row = $res->fetch_array())
						{
							//var_dump($row);
					?>
					<tr class = "managewebsite-row">
						<td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
						<td><?php echo $row['ItemID']; ?> </td>
						<td><?php echo $row['Username']; ?> </td>
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
							<td><?php echo $row['Mode']; ?> </td>
							<td><?php echo $row['Price']; ?> </td>
							<td><?php echo $row['TradeMemName']; ?> </td>
							<td><?php echo $row['TradeSetName']; ?> </td>
							<td><?php echo $row['TradeStyle']; ?> </td>
							<td><?php echo $row['Status']; ?> </td>
							<td><a href="delete.php?itemid=' <?php echo $row['ItemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
					</tr>                               
					<?php
						}
					}
				?>  
			</table>
		</div>
	</div>
  <div id = "MembersandSets" class="managewebsiteoriginal-containe allitem" style = "display:none">
  <h2>Members and Sets</h2>
  <div class="managewebsiteoriginal-bar managewebsite-bar">
    <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink2 managewebsiteoriginal-red" onclick="openMS(event,'Members')">Members</button>
    <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink2" onclick="openMS(event,'Sets')">Sets</button>
  </div>
	<div id="Members" class="managewebsiteoriginal-container managewebsiteoriginal-border MS">
		<table border="0">
			<tr  class = "managewebsite-colomn">
				<td class = "managewebsite-memberandset-table-column">
					<b>Member ID</b>
				</td>
				<td>
					<b>Member Name</b>
				</td>
				<td>
					<b>Generation</b>
				</td>
				<td>
					<b>Status</b>
				</td>
				<td>
					<b>Delete</b>
				</td>
			</tr>
			<?php
				$q = 'SELECT * FROM Members;';
				if ($res = $conn->query($q))
				{
					while($row = $res->fetch_array())
					{
						//var_dump($row);
				?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row"><?php echo $row['MemID']; ?></td> 
                    <td><?php echo $row['MemName']; ?> </td>
                    <td><?php echo $row['Gen']; ?> </td>
                    <td><?php echo $row['Status']; ?> </td>
                    <td><a href="delete.php?memid=' <?php echo $row['MemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                </tr>                               
				<?php
				}
				}
			?>   
		</table>
	</div>


  <div id="Sets" class="managewebsiteoriginal-container managewebsiteoriginal-border MS" style="display:none">
    <table border="0">
			<tr  class = "managewebsite-colomn">
				<td class = "managewebsite-memberandset-table-column">
					<b>Set ID</b>
				</td>
				<td>
					<b>Set Name</b>
				</td>
				<td>
					<b>Generation</b>
				</td>
				<td>
					<b>Delete</b>
				</td>
			</tr>
			<?php
				$q = 'SELECT * FROM Sets;';
				if ($res = $conn->query($q))
				{
					while($row = $res->fetch_array())
					{
						//var_dump($row);
				?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row"><?php echo $row['SetID']; ?> </td>
                    <td><?php echo $row['SetName']; ?> </td>
                    <td><?php echo $row['Gen']; ?> </td>
                    <td><a href="delete.php?setid=' <?php echo $row['SetID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                </tr>                               
				<?php
				}
				}
			?>  
		</table>
  </div>
</div>
<div id = "AddandChange" class="managewebsiteoriginal-container allitem" style = "display:none">
	<h2>Add & Change status</h2>
	<div class="managewebsiteoriginal-bar managewebsite-bar">
		<button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink3 managewebsiteoriginal-red" onclick="openAS(event,'AMembers')">Add Members</button>
		<button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink3" onclick="openAS(event,'ASets')">Add Sets</button>
		<button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink3" onclick="openAS(event,'Cmem')">Change Member status</button>
	</div>

	<div id="AMembers" class="managewebsiteoriginal-container managewebsiteoriginal-border AS">
		<form name="addMember" method="POST" action="managewebsite.php">
			<table border="0">
				<tr>
					<td class = "bold">
						Member name:
					</td>
					<td>
						<input type="text" name="addmemname" placeholder="Member name" class = "managewebsite-addandchangestatus-item">
					</td>
				</tr>
				<tr>
					<td class = "bold">
						Generation: 
					</td>
					<td>
						<input type="text" name="addmemgen" placeholder="Generation" class = "managewebsite-addandchangestatus-item">
					</td>
				</tr>
				<tr>
					<td colspan="2" class = "managewebsite-table-center" style = "text-align:center;">
						<input type="submit" name="addMem" value="Add" class = "managewebsite-addandchangestatus-button">
					</td>
				</tr>
			</table>
		</form>
	</div>

	<div id="ASets" class="managewebsiteoriginal-container managewebsiteoriginal-border AS" style="display:none">
		<form name="addSet" method="POST" action="managewebsite.php">
			<table>
				<tr>
					<td class = "bold">
						Set name:
					</td>
					<td>
						<input type="text" name="addsetname" placeholder="Member name" class = "managewebsite-addandchangestatus-item">
					</td>
				</tr>
				<tr>
					<td class = "bold">
						Generation:
					</td>
					<td>
						<input type="text" name="addsetgen" placeholder="Generation" class = "managewebsite-addandchangestatus-item">
					</td>
				</tr>
				<tr>
					<td colspan="2" class = "managewebsite-table-center" style = "text-align:center;">
						<input type="submit" name="addSet" value="Add" class ="managewebsite-addandchangestatus-button">
					</td>
				</tr>
			</table>
		</form>
	</div>

	<div id="Cmem" class="managewebsiteoriginal-container managewebsiteoriginal-border AS" style="display:none">
		<form name="memStatus" method="POST" action="managewebsite.php" autocomplete="off">
			<table>
				<tr>
					<td class = "bold">
						BNK 48 Member:
					</td>
					<td>
						<div class="autocomplete" style = "display:inline">
							<input id="myMember" type="text" name="members" placeholder="Member name" class = "managewebsite-addandchangestatus-item"> </div>
					</td>
				</tr>
				<tr>
					<td class = "bold">
						Generation:
					</td>
					<td>
						<input type="text" name="Genc" placeholder="Generation" class = "managewebsite-addandchangestatus-item">
					</td>
				</tr>
				<tr>
					<td class = "bold">
						Status:
					</td>
					<td colspan="2">
						<select name="Status" class = "managewebsite-addandchangestatus-item-status">
							<option value="Active">Active</option>
							<option value="Inactive">Inactive</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" class = "managewebsite-table-center" style = "text-align:center;">
						<input type="submit" name="change" value="Change" class = "managewebsite-addandchangestatus-button">
					</td>
				</tr>
			</table> 
		</form>
	</div>
</div>
  <div id = "User" class="managewebsiteoriginal-container allitem" style = "display:none">
  <!-- USER INFO -->
  <h2>Users</h2>
	<div class="managewebsiteoriginal-container managewebsiteoriginal-border">
		<table border="0">
			<tr  class = "managewebsite-colomn">
				<td class = "managewebsite-memberandset-table-column">
					<b>User ID</b>
				</td>
				<td>
					<b>Username</b>
				</td>
				<td>
					<b>E-mail</b>
				</td>
				<td>
					<b>Title</b>
				</td>
				<td>
					<b>Firstname</b>
				</td>
				<td>
					<b>Lastname</b>
				</td>
				<td>
					<b>Birthday</b>
				</td>
				<td>
					<b>Tel</b>
				</td>
				<td>
					<b>Address</b>
				</td>
				<td>
					<b>Status</b>
				</td>
				<td>
					<b>Delete</b>
				</td>
			</tr>
			<?php
				$q = 'SELECT * FROM Users;';
				if ($res = $conn->query($q))
				{
					while($row = $res->fetch_array())
					{
						//var_dump($row);
				?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row"><?php echo $row['UID']; ?></td> 
                    <td><?php echo $row['Username']; ?> </td>
                    <td><?php echo $row['Email']; ?> </td>
                    <td><?php echo $row['Title']; ?> </td>
                    <td><?php echo $row['Firstname']; ?> </td>
                    <td><?php echo $row['Lastname']; ?> </td>
                    <td><?php echo $row['Birthday']; ?> </td>
                    <td><?php echo $row['Tel']; ?> </td>
                    <td><?php echo $row['Address']; ?> </td>
                    <td><?php echo $row['User_Status']; ?> </td>
                    <td><a href="delete.php?uid=' <?php echo $row['UID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                </tr>                               
				<?php
				}
				}
			?>   
		</table>
	</div>
	</div>
	<!-- END USER INFO -->
<div id = "Usertran" class="managewebsiteoriginal-container allitem">
  <!-- USER INFO -->
  <h2>Money tranfer</h2>
	<div class="managewebsiteoriginal-container managewebsiteoriginal-border">
		<table border="0">
			<tr  class = "managewebsite-colomn">
				<td class = "managewebsite-memberandset-table-column">
					<b>ItemID</b>
				</td>
				<td>
					<b>Price</b>
				</td>
				<td>
					<b>Seller</b>
				</td>
				<td>
					<b>Status</b>
				</td>
				<td>
					<b>Transfer</b>
				</td>
			</tr>
			<?php
				$q = 'SELECT Shipment.ItemID,Shipment.Status,Username,buysell.Price FROM Shipment LEFT JOIN Listings ON Shipment.ItemID=Listings.ItemID LEFT JOIN Users ON listings.UID=users.UID LEFT JOIN buysell on listings.ItemID=buysell.ItemID WHERE Shipment.Status="Accepted" AND (Mode="Buying" OR Mode="Selling");';
				//echo($q);
				if ($res = $conn->query($q))
				{
					while($row = $res->fetch_array())
					{
						//var_dump($row);
				?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row"><?php echo $row['ItemID']; ?> </td>
                    <td><?php echo $row['Price']; ?> </td>
                    <td><?php echo $row['Username']; ?> </td>
                    <td><?php echo $row['Status']; ?> </td>
                    <td><a href="transfer.php?itemid=<?php echo($row['ItemID'])?>"><img src='img/button/transfer.png' width="25px"></a></td>
                </tr>                               
				<?php
				}
				}
			?>   
		</table>
	</div>
</div>
</div>
<hr>
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="app.js"></script>
<script>

function openMain(evt, mode) {
  var i0, x0, tablinks0;
  x0 = document.getElementsByClassName("allitem");
  for (i0 = 0; i0 < x0.length; i0++) {
      x0[i0].style.display = "none";
  }
  tablinks0 = document.getElementsByClassName("tablink0");
  for (i0 = 0; i0 < x0.length; i0++) {
      tablinks0[i0].className = tablinks0[i0].className.replace(" managewebsiteoriginal-red2", "");
  }
  document.getElementById(mode).style.display = "block";
  evt.currentTarget.className += " managewebsiteoriginal-red2";
}

function openListing(evt, mode) {
  var i, x, tablinks;
  x = document.getElementsByClassName("listing");
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" managewebsiteoriginal-red", "");
  }
  document.getElementById(mode).style.display = "block";
  evt.currentTarget.className += " managewebsiteoriginal-red";
}

function openMS(evt, mode) {
  var i2, x2, tablinks2;
  x2 = document.getElementsByClassName("MS");
  for (i2 = 0; i2 < x2.length; i2++) {
      x2[i2].style.display = "none";
  }
  tablinks2 = document.getElementsByClassName("tablink2");
  for (i2 = 0; i2 < x2.length; i2++) {
      tablinks2[i2].className = tablinks2[i2].className.replace(" managewebsiteoriginal-red", "");
  }
  document.getElementById(mode).style.display = "block";
  evt.currentTarget.className += " managewebsiteoriginal-red";
}

function openAS(evt, mode) {
  var i3, x3, tablinks3;
  x3 = document.getElementsByClassName("AS");
  for (i3 = 0; i3 < x3.length; i3++) {
      x3[i3].style.display = "none";
  }
  tablinks3 = document.getElementsByClassName("tablink3");
  for (i3 = 0; i3 < x3.length; i3++) {
      tablinks3[i3].className = tablinks3[i3].className.replace(" managewebsiteoriginal-red", "");
  }
  document.getElementById(mode).style.display = "block";
  evt.currentTarget.className += " managewebsiteoriginal-red";
}

</script>
<!-- DISABLE RIGHT CLICK SCRIPT START HERE -->
<script>
		window.addEventListener("contextmenu", e => {
 		 e.preventDefault();
		});
	</script>
	<!-- END DISABLE RIGHT CLICK SCRIPT HERE -->
</body>
</html>

