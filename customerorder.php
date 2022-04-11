<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products list page</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>
<?php
    if(isset($_POST['markasdone'])) { //remove product from the incart table
        
        $orderid= $_POST['orderid'];
        $q="DELETE FROM `customerorder` WHERE OrderID = $orderid;";
        $result=$conn->query($q);
            if(!$result){
                echo "INSERT failed. Error: ".$conn->error ;
                return false;
            }
    }
?>
<body>
<div id="wrapper">
    <div id="header">
        <form action="product.php" method="post">
            <a class="logo"href="staffmainpage.php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="staffmainpage.php">Stonk Gunpla</a>
            <a class="logout"href="logout.php">Log out<img src="Images/logout.png" alt="logouticon" width="20"></a>
            <a class="order"href="customerorder.php">Order<img src="Images/order.png" alt="logouticon" width="20"></a>
            <a class="profile"href="staffprofile.php">Profile<img src="Images/profile.png" alt="profileicon" width="20"></a>
            <a class="prod"href="staffproductlist.php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <div class="prodlist">
            <table style="border-spacing: 60px;">
                <col width="1%">
                <col width="1%">
                <col width="1%">
                <col width="4%">
                <col width="30%">
                <col width="65%">
                <col width="4%">
                <col width="1%">

                <tr>
                    <th>ID</th>
                    <th>Name</th> 
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Product name</th>
                    <th>Date</th>
                    <th>Price (Baht)</th>
                    <th></th>
                </tr>
 		<?php 
				$q="select * from customerorder";
				$result=$conn->query($q);
				if(!$result){
					echo "Select failed. Error: ".$conn->error ;
					return false;
				}
                    
				while($row=$result->fetch_array()){
                    $orderID = $row['OrderID'];
                    $userid1=$row['CustomerID'];
                    $q1="select * from Customer where CustomerID='$userid1'";
                    $result1=$conn->query($q1);
                    if(!$result1){
                        echo "Select failed. Error: ".$conn->error ;
                        return false;
                    }
                    $row1=$result1->fetch_array();

                    // $q2="SELECT ProductName from product where ProductID IN(select ProductID from inorder where CustomerID='$userid1')";
                    // $result2=$conn->query($q2);
                    // if(!$result2){
                    //     echo "Select failed. Error: ".$conn->error ;
                    //     return false;
                    // }
                    $q2="SELECT ProductName from product where ProductID IN(select productID from inorder where OrderID='$orderID')";
                    $result2=$conn->query($q2);
                    if(!$result2){
                        echo "Select failed. Error: ".$conn->error ;
                        return false;
                    }
                    // $row2=$result2->fetch_array()
                    
                    ?>
                    <tr class = "productlist">
                        <td><?=$row['OrderID']?></td>
                        <td><?=$row1['Name']?></td>
                        <td><?=$row1['Address']?></td>
                        <td><?=$row1['PhoneNumber']?></td>
                        <td>
                            <?php while($row2=$result2->fetch_array()){ ?>
                                <?=$row2['ProductName']?><br>
                            <?php }?>
                        </td>
                        <td><?=$row['PurchaseDate']?></td>
                        <td><?=$row['TotalAmount']?></td>
                        <form method="POST">
                            <td><button class="btn" type="submit" name="markasdone">Mark as done</button></td>
                            <input type="hidden" name="orderid" value = "<?php echo $row['OrderID']?>">
                        </form>
                        <!-- <br> -->
                    </tr>
				<?php } ?>

            </table>
    </div>
    
</div>
</body>
</html>