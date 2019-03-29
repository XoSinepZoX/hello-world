<?php
    include('dbconn.php');
    if ($conn->connect_errno) {
        echo $sqlconn->connect_errno ." : ". $sqlconn->connect_error;
    }
    session_start();
    $uid=$_SESSION['uid'];
    $username=$_SESSION['username'];
    if (isset($_POST['updates'])) {
        $trackingno=mysqli_real_escape_string($conn,$_POST['trackingno']);
        $via=$_POST['via'];
        $shipid=$_POST['shipid'];
        $q="UPDATE Shipment SET " .
        "TrackingNO = '".$trackingno."',via='".$via."' ,Status='Shipping' " .
        " WHERE ShipmentID =".$shipid."";
        //echo($q);
        $result=$conn->query($q);
        //echo($q);
        if(!$result){
            echo "INSERT failed. Error : ".$conn->error ;
        }
    }
    if (isset($_POST['updatepp'])){
        $promptpayno=mysqli_real_escape_string($conn,$_POST['promptpayno']);
        $promptpaytype=$_POST['promptpaytype'];
        $q='UPDATE users SET promptpayno="'.$promptpayno.'" ,promptpaytype="'.$promptpaytype.'" WHERE UID='.$uid;
        $res=$conn->query($q);
        //echo($q);
        if(!$res){
            echo "INSERT failed. Error : ".$conn->error ;
        }
    }
?>
<!DOCTYPE html>
<html>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style2.css">
<link rel="stylesheet" href="styles.css">
<body class = "bgc-base-color">
<?php
    $q = 'SELECT * FROM Users WHERE UID='.$uid.';';
    if ($res = $conn->query($q))
    {
        $row=$res->fetch_array();
    }
    //echo($q);
?>
    <div class="managewebsiteoriginal-bar managewebsite-bar managewebsite-mainbar shadowbox">
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0 managewebsiteoriginal-red2  managewebsite-bar-button" onclick="openMain(event,'Myaccountinfo')">My account info</button>
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'ListingListing')">Listings</button>
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'MyResponseandMyRequest')">My Response and My Request</button>
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'Cart')">Cart</button>
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'Payments')">Payments</button>
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'Shipments')">Shipments</button>
        <button class="managewebsiteoriginal-bar-main managewebsiteoriginal-main-button bold tablink0" onclick="openMain(event,'UpdateOutgoingShipments')">Update Outgoing Shipments</button>
    </div>

    <div id = "Myaccountinfo" class = "allitem">
        <div class = "myaccount-account-info">
            <h2>My Account</h2>
            <div class = "myaccount-account-info-row centera"><div class = "bold ">Name : </div> <div><?php echo($row['Title'].$row['Firstname']." ".$row['Lastname']);  ?></div></div><br>
            <div class = "myaccount-account-info-row"><div class = "bold">E-mail : </div> <div><?php echo($row['Email']);  ?></div></div><br>
            <div class = "myaccount-account-info-row"><div class = "bold">Birthday : </div> <div><?php echo($row['Birthday']);  ?></div></div><br>
            <div class = "myaccount-account-info-row"><div class = "bold">Tel. : </div> <div><?php echo($row['Tel']);  ?></div></div><br>
            <div class = "myaccount-account-info-row"><div class = "bold">Address : </div> <div><?php echo($row['Address']);  ?></div></div><br>
            <div class = "myaccount-account-info-row"><div class = "bold">Promptpay No. : </div> <div><?php echo($row['promptpayno']);  ?></div></div><br>
            <div class = "myaccount-account-info-row"><div class = "bold">Promptpay Type : </div> <div><?php echo($row['promptpaytype']);  ?></div></div>
        </div>
        <br>
        <hr>
        <div class = "myaccount-updateppinfo">
            <h3>Update Promtpay No.</h3>
            <form action="myaccount.php" method="POST">
                <div class = "myaccount-account-info-row">
                    <div class = "bold centerv"> Promptpay No. : </div><div><input type="text" name="promptpayno" value="<?php echo $row['promptpayno'] ?>"></div>
                </div>
                <br>
                <div class = "myaccount-account-info-row">
                    <div class = "bold centerv">Promptpay Type : </div>
                    <div>
                        <select name="promptpaytype" class = "myaccount-pptype">
                            <?php if ($row['promptpaytype']!="Citizen ID") {
                            ?>
                                <option value="Phone Number" SELECTED>Phone Number</option>
                                <option value="Citizen ID">Citizen ID</option>
                            <?php
                            }
                                else{
                            ?>
                                <option value="Phone Number">Phone Number</option>
                                <option value="Citizen ID" SELECTED>Citizen ID</option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <input type="submit" name="updatepp" value="UPDATE" class ="myaccount-update-btt">
            </form>
        </div>
    </div>

    <div id="ListingListing" class = "allitem" style = "display:none">    
        <div class="managewebsiteoriginal-container">
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
                        <div class = "bold">DateAdded</div>
                    </td>
                    <td>
                        <div class = "bold">ItemID</div>
                    </td>
                    <td>
                        <div class = "bold">Owner</div>
                    </td>
                    <td>
                        <div class = "bold">Topic</div>
                    </td>
                    <td>
                        <div class = "bold">Description</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">Member Name</div>
                    </td>
                    <td>
                        <div class = "bold">Set Name</div>
                    </td>
                    <td>
                        <div class = "bold">Style</div>
                    </td>
                    <td>
                        <div class = "bold">Mode</div>
                    </td>
                    <td>
                        <div class = "bold">Price</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Member Name</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Set Name</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Style</div>
                    </td>
                    <td>
                        <div class = "bold">Status</div>
                    </td>
                    <td>
                        <div class = "bold">Delete</div>
                    </td>
                </tr>
                <?php
                    $q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE listings.UID='.$uid.' ORDER BY DateAdded DESC';
                    //echo($q);
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
                        <div class = "bold">DateAdded</div>
                    </td>
                    <td>
                        <div class = "bold">ItemID</div>
                    </td>
                    <td>
                        <div class = "bold">Owner</div>
                    </td>
                    <td>
                        <div class = "bold">Topic</div>
                    </td>
                    <td>
                        <div class = "bold">Description</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">Member Name</div>
                    </td>
                    <td>
                        <div class = "bold">Set Name</div>
                    </td>
                    <td>
                        <div class = "bold">Style</div>
                    </td>
                    <td>
                        <div class = "bold">Mode</div>
                    </td>
                    <td>
                        <div class = "bold">Price</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Member Name</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Set Name</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Style</div>
                    </td>
                    <td>
                        <div class = "bold">Status</div>
                    </td>
                    <td>
                        <div class = "bold">Delete</div>
                    </td>
                </tr>
                <?php
                    $q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Active" and listings.UID='.$uid.' ORDER BY DateAdded DESC';
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
                        <div class = "bold">DateAdded</div>
                    </td>
                    <td>
                        <div class = "bold">ItemID</div>
                    </td>
                    <td>
                        <div class = "bold">Owner</div>
                    </td>
                    <td>
                        <div class = "bold">Topic</div>
                    </td>
                    <td>
                        <div class = "bold">Description</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">Member Name</div>
                    </td>
                    <td>
                        <div class = "bold">Set Name</div>
                    </td>
                    <td>
                        <div class = "bold">Style</div>
                    </td>
                    <td>
                        <div class = "bold">Mode</div>
                    </td>
                    <td>
                        <div class = "bold">Price</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Member Name</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Set Name</div>
                    </td>
                    <td>
                        <div class = "bold">Trade Style</div>
                    </td>
                    <td>
                        <div class = "bold">Status</div>
                    </td>
                    <td>
                        <div class = "bold">Delete</div>
                    </td>
                </tr>
                <?php
                    $q = 'SELECT DateAdded,listings.ItemID,Username,Topic,Description,Pic,MemName,SetName,Style,Mode,Status,Price,TradeMemName,TradeSetName,TradeStyle,PIC2,PIC3 FROM Listings LEFT JOIN buysell ON Listings.ItemID=buysell.ItemID LEFT JOIN trade ON listings.ItemID=trade.ItemID LEFT JOIN users ON listings.UID=users.UID LEFT JOIN PicComp on Listings.ItemID=PicComp.ItemID WHERE Status="Inactive" and listings.UID='.$uid.' ORDER BY DateAdded DESC';
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
    </div>

    <div id = "MyResponseandMyRequest" class="managewebsiteoriginal-container allitem" style = "display:none">
        <h2>My Response and My Request</h2>
        <div class="managewebsiteoriginal-bar managewebsite-bar">
            <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink2 managewebsiteoriginal-red" onclick="openMS(event,'Members')">My Response</button>
            <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink2" onclick="openMS(event,'Sets')">My Request</button>
        </div>
            <div id="Members" class="managewebsiteoriginal-container managewebsiteoriginal-border MS">
                <table border="0">
                    <tr  class = "managewebsite-colomn">
                        <td class = "managewebsite-memberandset-table-column myaccount-myrespond-columns">
                            <div class = "bold">Time Stamp</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">ItemID</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Topic</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Mode</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Price</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Detail</div>
                        </td>
                        <td>
                            <div class = "bold">ItemID</div>
                        </td>
                        <td>
                            <div class = "bold">Owner</div>
                        </td>
                        <td>
                            <div class = "bold">Pic</div>
                        </td>
                        <td>
                            <div class = "bold">Pic2</div>
                        </td>
                        <td>
                            <div class = "bold">Pic3</div>
                        </td>
                        <td>
                            <div class = "bold">Status</div>
                        </td>
                        <td>
                            <div class = "bold">Detail</div>
                        </td>
                        <td>
                            <div class = "bold">Confirm</div>
                        </td>
                        <td>
                            <div class = "bold">Delete</div>
                        </td>
                    </tr>
                    <?php
                        $q = 'SELECT ResponseID,DateRequested,ItemIDMain,lm.Topic,lm.Mode,Username,ItemIDRe,lr.Pic,PIC2,PIC3,Response.Price,lr.Style,Response.Status,lr.UID FROM Response LEFT JOIN listings lm ON ItemIDMain=lm.ItemID LEFT JOIN listings lr ON ItemIDRe=lr.ItemID LEFT JOIN PicComp ON ItemIDRe=PicComp.ItemID LEFT JOIN buysell on ItemIDMain=buysell.ItemID LEFT JOIN users ON lr.UID=users.UID WHERE UIDMain='.$uid.' ORDER BY DateRequested DESC;';
                        //echo($q);
                        if ($res = $conn->query($q))
                        {
                            while($row = $res->fetch_array())
                            {
                                //var_dump($row);
                        ?>
                        <tr class = "managewebsite-row">
                            <td class = "managewebsite-memberandset-table-row myaccount-myrespond-rows"><?php echo $row['DateRequested']; ?>
                            </td> 
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['ItemIDMain']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['Topic']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['Mode']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['Price']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemIDMain']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a>
                            </td>
                            <td>
                                <?php echo $row['ItemIDRe']; ?>
                            </td>
                            <td>
                                <?php echo $row['Username']; ?>
                            </td>
                            <td>
                                <img src="img/member/<?php echo $row['Pic']; ?>" width="40px">
                            </td>
                            <?php
                                if($row['Style'] != 'Complete'){
                                    echo '<td></td><td></td>';

                                }
                                else{
                                    echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                                    echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                                }
                            ?>
                            
                            <td>
                                <?php echo $row['Status']; ?>
                            </td>
                            <td><a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemIDRe']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a></td>
                            <?php
                                if ($row['Status']=='Pending') {
                            ?>
                                <td><a href="accswitch.php?resid=' <?php echo $row['ResponseID']; ?>'&mode=<?php echo $row['Mode']; ?>"><img src='img/button/check.png' width="25px"></a></td>
                                <td><a href="delswitch.php?delresid=' <?php echo $row['ResponseID']; ?>'&mode=<?php echo $row['Mode']; ?>"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                            <?php
                                }
                                else{
                                    echo'<td></td><td></td>';
                                }
                            ?>
                            
                            
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
                        <td class = "managewebsite-memberandset-table-column myaccount-myrespond-columns">
                            <div class = "bold">Time Stamp</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">My ItemID</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Topic</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Mode</div>
                        </td>
                        <td class = "myaccount-myrespond-columns">
                            <div class = "bold">Detail</div>
                        </td>
                        <td>
                            <div class = "bold">Item ID</div>
                        </td>
                        <td>
                            <div class = "bold">Owner</div>
                        </td>
                        <td>
                            <div class = "bold">Pic</div>
                        </td>
                        <td>
                            <div class = "bold">Pic2</div>
                        </td>
                        <td>
                            <div class = "bold">Pic3</div>
                        </td>
                        <td>
                            <div class = "bold">Price</div>
                        </td>
                        <td>
                            <div class = "bold">Detail</div>
                        </td>
                        <td>
                            <div class = "bold">Status</div>
                        </td>
                    </tr>
                    <?php
                        $q = 'SELECT DateRequested,ItemIDMain,lr.Topic,lr.Mode,Username,ItemIDRe,lm.Pic,PIC2,PIC3,Response.Price,lm.Style,Response.Status FROM Response LEFT JOIN listings lm ON ItemIDMain=lm.ItemID LEFT JOIN listings lr ON ItemIDRe=lr.ItemID LEFT JOIN PicComp ON ItemIDMain=PicComp.ItemID LEFT JOIN buysell on ItemIDRe=buysell.ItemID LEFT JOIN users ON lm.UID=users.UID WHERE UIDRe='.$uid.' ORDER BY DateRequested DESC;';
                        //echo($q);
                        if ($res = $conn->query($q))
                        {
                            while($row = $res->fetch_array())
                            {
                                //var_dump($row);
                        ?>
                        <tr class = "managewebsite-row">
                            <td class = "managewebsite-memberandset-table-row myaccount-myrespond-rows"><?php echo $row['DateRequested']; ?>
                            </td> 
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['ItemIDRe']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['Topic']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <?php echo $row['Mode']; ?>
                            </td>
                            <td class = "myaccount-myrespond-rows">
                                <a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemIDMain']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a>
                            </td>
                            <td>
                                <?php echo $row['ItemIDMain']; ?>
                            </td>
                            <td>
                                <?php echo $row['Username']; ?>
                            </td>
                            <td>
                                <img src="img/member/<?php echo $row['Pic']; ?>" width="40px">
                            </td>
                            <?php
                                if($row['Style'] != 'Complete'){
                                    echo '<td></td><td></td>';

                                }
                                else{
                                    echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                                    echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                                }
                            ?>
                            <td>
                                <?php echo $row['Price']; ?>
                            </td>
                            <td><a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemIDRe']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a></td>
                            <td>
                                <?php echo $row['Status']; ?>
                            </td>
                        </tr>                               
                        <?php
                        }
                        }
                    ?>   
                </table>
            </div>
    </div>


    <div id ="Cart" class="managewebsiteoriginal-container allitem" style = "display:none">
            <h2>Cart</h2>
            <div class="managewebsiteoriginal-bar managewebsite-bar">
            <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink4 managewebsiteoriginal-red  managewebsite-bar-button" onclick="openCart(event,'Allc')">ALL</button>
            <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink4" onclick="openCart(event,'Notp')">Not PAID</button>
            <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink4" onclick="openCart(event,'Paid')">PAID</button>
        </div>

        <div id="Allc" class="managewebsiteoriginal-container managewebsiteoriginal-border cart">
            <table border="0">
                <tr class = "managewebsite-colomn">
                    <td>
                        <div class = "bold">DateAdded</div>
                    </td>
                    <td>
                        <div class = "bold">ItemID</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">Detail</div>
                    </td>
                    <td>
                        <div class = "bold">CartID</div>
                    </td>
                    <td>
                        <div class = "bold">Price</div>
                    </td>
                    <td>
                        <div class = "bold">Status</div>
                    </td>
                    <td>
                        <div class = "bold">PaymentID</div>
                    </td>
                    <td>
                        <div class = "bold">Delete</div>
                    </td>
                </tr>
                <?php
                    $q = 'SELECT Cart.DateAdded,Cart.ItemID,PIC,PIC2,PIC3,Cart.CartID,Price,CartNo.Status,PaymentID,Style,CartItemID,Listings.Status AS State FROM Cart LEFT JOIN LISTINGS ON Cart.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN buysell ON listings.ItemID=buysell.ItemID LEFT JOIN CartNo ON Cart.CartID=CartNo.CartID WHERE OwnerID='.$uid.' ORDER BY DateAdded DESC';
                    //echo($q);
                    if ($res = $conn->query($q))
                    {
                        while($row = $res->fetch_array())
                        {
                            //var_dump($row);
                            if ($row['Status']!="PAID" && ($row['State']!="Active" && $row['State']!="Hidden")) {
                                $qd='DELETE FROM Cart WHERE CartItemID='.$row['CartItemID'];
                                $resultd=$conn->query($qd);
                            }
                            else{
                    ?>
                        <tr class = "managewebsite-row">
                        <td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
                        <td><?php echo $row['ItemID']; ?> </td>
                        <td><img src="img/member/<?php echo $row['PIC']; ?>" width='40px'></td>
                        <?php
                            if($row['Style'] != 'Complete'){
                                echo '<td></td><td></td>';

                            }
                            else{
                                echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                                echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                            }
                        ?>
                        <td><a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemID']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a></td>
                        <td><?php echo $row['CartID']; ?> </td>
                        <td><?php echo $row['Price']; ?> </td>
                        <td><?php echo $row['Status']; ?> </td>
                        <td><?php echo $row['PaymentID']; ?> </td>
                        <?php if ($row['Status']!="PAID") { 
                        ?>
                            <td><a href="delcart.php?delciid=' <?php echo $row['CartItemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                        <?php
                        }
                        else{
                            echo("<td></td>");
                        }
                        ?>
                    </tr>                               
                    <?php
                    }
                    }
                }
                ?>  
            </table>
    </div>


    <div id="Notp" class="managewebsiteoriginal-container managewebsiteoriginal-border cart" style="display:none">
        <table border="0">
            <tr class = "managewebsite-colomn">
                <td>
                    <div class = "bold">DateAdded</div>
                </td>
                <td>
                    <div class = "bold">ItemID</div>
                </td>
                <td>
                    <div class = "bold">PIC</div>
                </td>
                <td>
                    <div class = "bold">PIC</div>
                </td>
                <td>
                    <div class = "bold">PIC</div>
                </td>
                <td>
                    <div class = "bold">Detail</div>
                </td>
                <td>
                    <div class = "bold">CartID</div>
                </td>
                <td>
                    <div class = "bold">Price</div>
                </td>
                <td>
                    <div class = "bold">Status</div>
                </td>
                <td>
                    <div class = "bold">PaymentID</div>
                </td>
                <td>
                    <div class = "bold">Delete</div>
                </td>
            </tr>
            <?php
                $q = 'SELECT Cart.DateAdded,Cart.ItemID,PIC,PIC2,PIC3,Cart.CartID,Price,CartNo.Status,PaymentID,Style,CartItemID,Listings.Status AS State FROM Cart LEFT JOIN LISTINGS ON Cart.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN buysell ON listings.ItemID=buysell.ItemID LEFT JOIN CartNo ON Cart.CartID=CartNo.CartID WHERE CartNo.Status IS NULL AND OwnerID='.$uid.' ORDER BY DateAdded DESC';
                //echo($q);
                if ($res = $conn->query($q))
                {
                    while($row = $res->fetch_array())
                    {
                        //var_dump($row);
                ?>
                    <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
                    <td><?php echo $row['ItemID']; ?> </td>
                    <td><img src="img/member/<?php echo $row['PIC']; ?>" width='40px'></td>
                    <?php
                        if($row['Style'] != 'Complete'){
                            echo '<td></td><td></td>';

                        }
                        else{
                            echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                            echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                        }
                    ?>
                    <td><a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemID']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a></td>
                    <td><?php echo $row['CartID']; ?> </td>
                    <td><?php echo $row['Price']; ?> </td>
                    <td><?php echo $row['Status']; ?> </td>
                    <td><?php echo $row['PaymentID']; ?> </td>
                    <td><a href="delcart.php?delciid=' <?php echo $row['CartItemID']; ?>'"><img src='img/button/Trash1.png' onmouseover="this.src='img/button/Trash2.png';" onmouseout="this.src='img/button/Trash1.png';" width="25px"></a></td>
                </tr>                               
                <?php
                }
                }
            ?>  
        </table>
  </div>

    <div id="Paid" class="managewebsiteoriginal-container managewebsiteoriginal-border cart" style="display:none">
            <table border="0">
                <tr class = "managewebsite-colomn">
                    <td>
                        <div class = "bold">DateAdded</div>
                    </td>
                    <td>
                        <div class = "bold">ItemID</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">PIC</div>
                    </td>
                    <td>
                        <div class = "bold">Detail</div>
                    </td>
                    <td>
                        <div class = "bold">CartID</div>
                    </td>
                    <td>
                        <div class = "bold">Price</div>
                    </td>
                    <td>
                        <div class = "bold">Status</div>
                    </td>
                    <td>
                        <div class = "bold">PaymentID</div>
                    </td>
                    <td>
                        <div class = "bold">Delete</div>
                    </td>
                </tr>
                <?php
                    $q = 'SELECT Cart.DateAdded,Cart.ItemID,PIC,PIC2,PIC3,Cart.CartID,Price,CartNo.Status,PaymentID,Style,CartItemID,Listings.Status AS State FROM Cart LEFT JOIN LISTINGS ON Cart.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN buysell ON listings.ItemID=buysell.ItemID LEFT JOIN CartNo ON Cart.CartID=CartNo.CartID WHERE CartNo.Status="PAID" AND OwnerID='.$uid.' ORDER BY DateAdded DESC';
                    //echo($q);
                    if ($res = $conn->query($q))
                    {
                        while($row = $res->fetch_array())
                        {
                            //var_dump($row);
                    ?>
                        <tr class = "managewebsite-row">
                        <td class = "managewebsite-memberandset-table-row"><?php echo $row['DateAdded']; ?></td> 
                        <td><?php echo $row['ItemID']; ?> </td>
                        <td><img src="img/member/<?php echo $row['PIC']; ?>" width='40px'></td>
                        <?php
                            if($row['Style'] != 'Complete'){
                                echo '<td></td><td></td>';

                            }
                            else{
                                echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                                echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                            }
                        ?>
                        <td><a href="javascript: void(0)" onclick="window.open('myitem.php?itemid= <?php echo $row['ItemID']; ?>','_blank','width=900,height=600');"><img src='img/button/moredetail.png' width="25px"></a></td>
                        <td><?php echo $row['CartID']; ?> </td>
                        <td><?php echo $row['Price']; ?> </td>
                        <td><?php echo $row['Status']; ?> </td>
                        <td><?php echo $row['PaymentID']; ?> </td>
                        <td></td>
                    </tr>                               
                    <?php
                    }
                }
                ?>  
            </table>
        </div>
    </div>

<div id = "Payments" class="managewebsiteoriginal-container allitem" style = "display:none">
    <h2>Payments</h2>
    <div class="managewebsiteoriginal-container managewebsiteoriginal-border">
        <table border="0">
            <tr  class = "managewebsite-colomn">
                <td class = "managewebsite-memberandset-table-column">
                    <div class = "bold">Time Stamp</div>
                </td>
                <td>
                    <div class = "bold">PaymentID</div>
                </td>
                <td>
                    <div class = "bold">Card No.</div>
                </td>
                <td>
                    <div class = "bold">Method</div>
                </td>
                <td>
                    <div class = "bold">Total Price</div>
                </td>
            </tr>
            <?php
                $q = 'SELECT * FROM Payment WHERE OwnerID='.$uid;
                //echo($q);
                if ($res = $conn->query($q))
                {
                    while($row = $res->fetch_array())
                    {
                        //var_dump($row);
                ?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row">
                        <?php echo $row['TimeStamp']; ?>
                    </td>
                    <td>
                        <?php echo $row['PaymentID']; ?>
                    </td>
                    <td>
                        <?php echo $row['CardNo']; ?>
                    </td>
                    <td>
                        <?php echo $row['Method']; ?>
                    </td>
                    <td>
                        <?php echo $row['TotalPrice']; ?>
                    </td>
                </tr>                               
                <?php
                }
                }
            ?>   
        </table>   
    </div>
</div>

<div id = "Shipments" class="managewebsiteoriginal-container allitem" style = "display:none">
    <h2>Shipments</h2>
    <div class="managewebsiteoriginal-bar managewebsite-bar">
        <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink3 managewebsiteoriginal-red" onclick="openSHIP(event,'Incoming')">Incoming</button>
        <button class="managewebsiteoriginal-bar-item managewebsiteoriginal-button tablink3" onclick="openSHIP(event,'Outgoing')">Outgoing</button>
    </div>

    <div id="Incoming" class="managewebsiteoriginal-container managewebsiteoriginal-border SHIP">
        <table border="0">
            <tr  class = "managewebsite-colomn">
                <td class = "managewebsite-memberandset-table-column">
                    <div class = "bold">Time Stamp</div>
                </td>
                <td>
                    <div class = "bold">ItemID</div>
                </td>
                <td>
                    <div class = "bold">Topic</div>
                </td>
                <td>
                    <div class = "bold">Sender</div>
                </td>
                <td>
                    <div class = "bold">Pic</div>
                </td>
                <td>
                    <div class = "bold">Pic2</div>
                </td>
                <td>
                    <div class = "bold">Pic3</div>
                </td>
                <td>
                    <div class = "bold">Address</div>
                </td>
                <td>
                    <div class = "bold">Status</div>
                </td>
                <td>
                    <div class = "bold">Tracking No.</div>
                </td>
                <td>
                    <div class = "bold">via</div>
                </td>
                <td>
                    <div class = "bold">Accept</div>
                </td>
                <td>
                    <div class = "bold">Report</div>
                </td>
            </tr>
            <?php
                $q = 'SELECT Shipment.DateAdded,Shipment.ItemID,Topic,Username,Pic,PIC2,PIC3,Shipment.Address,Shipment.Status,TrackingNO,via,uidTo,uidFrom,listings.Style,ShipmentID FROM Shipment LEFT JOIN listings ON Shipment.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN users ON listings.UID=users.UID WHERE uidTo='.$uid;
                //echo($q);
                if ($res = $conn->query($q))
                {
                    while($row = $res->fetch_array())
                    {
                        //var_dump($row);
                ?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row">
                        <?php echo $row['DateAdded']; ?>
                    </td>
                    <td>
                        <?php echo $row['ItemID']; ?>
                    </td>
                    <td>
                        <?php echo $row['Topic']; ?>
                    </td>
                    <td>
                        <?php echo $row['Username']; ?>
                    </td>
                    <td>
                        <img src="img/member/<?php echo $row['Pic']; ?>" width="40px">
                    </td>
                    <?php
                        if($row['Style'] != 'Complete'){
                            echo '<td></td><td></td>';

                        }
                        else{
                            echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                            echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                        }
                    ?>
                    <td>
                        <?php
                            if ($row['Address']=="") {
                        ?>
                            <a href="addAddr.php?shipid=<?php echo($row['ShipmentID']) ?>"><button type="button">ADD</button></a>
                        <?php
                            }
                            else{
                        ?>
                            <?php echo $row['Address']; ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php echo $row['Status']; ?>
                    </td>
                    <td>
                        <?php echo $row['TrackingNO']; ?>
                    </td>
                    <td>
                        <?php echo $row['via']; ?>
                    </td>
                    <?php if ($row['Status']== 'Shipping') {
                    ?>
                        <td><a href="accship.php?accshipid=' <?php echo $row['ShipmentID']; ?>'"><img src='img/button/check.png' width="25px"></a></td>
                    <?php
                    }
                    else{
                        echo('<td></td>');
                    }
                    ?>
                    <?php if ($row['Status']!= 'Accepted') {
                    ?>
                    <td>
                        <a href="#?itemid=' <?php echo $row['ItemIDRe']; ?>'"><img src='img/button/report.png' width="25px"></a>
                    </td>
                    <?php
                    }
                    else{
                        echo('<td></td>');
                    }
                    ?>
                   
                </tr>                               
                <?php
                }
                }
            ?>   
        </table>   
    </div>

    <div id="Outgoing" class="managewebsiteoriginal-container managewebsiteoriginal-border SHIP" style="display:none">
        <table border="0">
            <tr  class = "managewebsite-colomn">
                <td class = "managewebsite-memberandset-table-column">
                    <div class = "bold">Time Stamp</div>
                </td>
                <td>
                    <div class = "bold">ItemID</div>
                </td>
                <td>
                    <div class = "bold">Topic</div>
                </td>
                <td>
                    <div class = "bold">Receiver</div>
                </td>
                <td>
                    <div class = "bold">Pic</div>
                </td>
                <td>
                    <div class = "bold">Pic2</div>
                </td>
                <td>
                    <div class = "bold">Pic3</div>
                </td>
                <td>
                    <div class = "bold">Address</div>
                </td>
                <td>
                    <div class = "bold">Status</div>
                </td>
                <td>
                    <div class = "bold">Tracking No.</div>
                </td>
                <td>
                    <div class = "bold">via</div>
                </td>
            </tr>
            <?php
                $q = 'SELECT Shipment.DateAdded,Shipment.ItemID,Topic,Username,Pic,PIC2,PIC3,Shipment.Address,Shipment.Status,TrackingNO,via,uidTo,uidFrom,listings.Style FROM Shipment LEFT JOIN listings ON Shipment.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN users ON uidTo=users.UID WHERE uidFrom='.$uid;
                //echo($q);
                if ($res = $conn->query($q))
                {
                    while($row = $res->fetch_array())
                    {
                        //var_dump($row);
                ?>
                 <tr class = "managewebsite-row">
                    <td class = "managewebsite-memberandset-table-row">
                        <?php echo $row['DateAdded']; ?>
                    </td>
                    <td>
                        <?php echo $row['ItemID']; ?>
                    </td>
                    <td>
                        <?php echo $row['Topic']; ?>
                    </td>
                    <td>
                        <?php echo $row['Username']; ?>
                    </td>
                    <td>
                        <img src="img/member/<?php echo $row['Pic']; ?>" width="40px">
                    </td>
                    <?php
                        if($row['Style'] != 'Complete'){
                            echo '<td></td><td></td>';

                        }
                        else{
                            echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                            echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                        }
                    ?>
                    <td>
                        <?php echo $row['Address']; ?>
                    </td>
                    <td>
                        <?php echo $row['Status']; ?>
                    </td>
                    <td>
                        <?php echo $row['TrackingNO']; ?>
                    </td>
                    <td>
                        <?php echo $row['via']; ?>
                    </td>
                </tr>                               
                <?php
                }
                }
            ?>   
        </table> 
    </div>
</div>

<div id = "UpdateOutgoingShipments" class="managewebsiteoriginal-container allitem" style = "display:none">
    <h2>Update Outgoing Shipments</h2>
    <div class="managewebsiteoriginal-container managewebsiteoriginal-border">
        <form method="POST" action="myaccount.php">
            <input type="hidden" name="shipid" value="<?php echo($row['ShipmentID']) ?>">
            <table border="0" class = "myaccount-tracking-table">
                <tr  class = "managewebsite-colomn">
                    <td class = "managewebsite-memberandset-table-column">
                        <div class = "bold"></div>
                    </td>
                    <td>
                        <div class = "bold">ItemID</div>
                    </td>
                    <td>
                        <div class = "bold">Topic</div>
                    </td>
                    <td>
                        <div class = "bold">Receiver</div>
                    </td>
                    <td>
                        <div class = "bold">Pic</div>
                    </td>
                    <td>
                        <div class = "bold">Pic2</div>
                    </td>
                    <td>
                        <div class = "bold">Pic3</div>
                    </td>
                    <td>
                        <div class = "bold">Address</div>
                    </td>
                    <td>
                        <div class = "bold">Status</div>
                    </td>
                </tr>
                <?php
                    $q = 'SELECT Shipment.DateAdded,Shipment.ItemID,Topic,Username,Pic,PIC2,PIC3,Shipment.Address,Shipment.Status,TrackingNO,via,uidTo,uidFrom,listings.Style,ShipmentID FROM Shipment LEFT JOIN listings ON Shipment.ItemID=listings.ItemID LEFT JOIN PicComp ON listings.ItemID=PicComp.ItemID LEFT JOIN users ON uidFrom=users.UID WHERE Shipment.Status="Waiting" AND uidFrom='.$uid;
                    //echo($q);
                    if ($res = $conn->query($q))
                    {
                        while($row = $res->fetch_array())
                        {
                            //var_dump($row);
                    ?>
                     <tr class = "managewebsite-row">
                        <td class = "managewebsite-memberandset-table-row">
                            <input type="radio" name="shipid" value="<?php echo($row['ShipmentID']) ?>">
                        </td>
                        <td>
                            <?php echo $row['ItemID']; ?>
                        </td>
                        <td>
                            <?php echo $row['Topic']; ?>
                        </td>
                        <td>
                            <?php echo $row['Username']; ?>
                        </td>
                        <td>
                            <img src="img/member/<?php echo $row['Pic']; ?>" width="40px">
                        </td>
                        <?php
                            if($row['Style'] != 'Complete'){
                                echo '<td></td><td></td>';

                            }
                            else{
                                echo '<td><img src="img/member/'.$row["PIC2"].'" width="40px"></td>';
                                echo '<td><img src="img/member/'.$row["PIC3"].'" width="40px"></td>';
                            }
                        ?>
                        <td>
                            <?php echo $row['Address']; ?>
                        </td>
                        <td>
                            <?php echo $row['Status']; ?>
                        </td>
                    </tr>                               
                    <?php
                    }
                    }
                ?>   
            </table>
            <br>
            <div class = "flexwrap myaccount-tracking-trackingno"><div class = "bold myaccount-tracking-trackingno-head">Tracking NO. : </div><div><input type="text" name="trackingno"></div></div>
            <br>
            <div class ="myaccount-tracking-last  flexwrap">
                <div class = "bold myaccount-tracking-trackingno-head">Via : </div>
                <select name="via" class = "myaccount-select-traking">
                    <option value="EMS">EMS</option>
                    <option value="Kerry">Kerry</option>
                    <option value="DHL">DHL</option>
                    <option value="At All">AT All</option>
                </select>
            </div>
            <br>
            <input type="submit" name="updates" value="UPDATE" class = "myaccount-update-btt-pp">
    </div>
</div>
<br>
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
function openCart(evt, mode) {
  var i4, x4, tablinks4;
  x4 = document.getElementsByClassName("cart");
  for (i4 = 0; i4 < x4.length; i4++) {
      x4[i4].style.display = "none";
  }
  tablinks4 = document.getElementsByClassName("tablink4");
  for (i4 = 0; i4 < x4.length; i4++) {
      tablinks4[i4].className = tablinks4[i4].className.replace(" managewebsiteoriginal-red", "");
  }
  document.getElementById(mode).style.display = "block";
  evt.currentTarget.className += " managewebsiteoriginal-red";
}
function openSHIP(evt, mode) {
  var i3, x3, tablinks3;
  x3 = document.getElementsByClassName("SHIP");
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

