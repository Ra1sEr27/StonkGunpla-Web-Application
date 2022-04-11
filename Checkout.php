<?php require_once('config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout page</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>
<?php
    if(isset($_POST['checkout'])){
        $username = $_SESSION['username'];
        $q="SELECT CustomerID FROM customer WHERE Name = '$username' ";
		$result=$conn->query($q);
		if(!$result){
			echo "Select failed. Error: ".$conn->error ;
			return false;
		}
        $row1=$result->fetch_array();
        $userid= $row1['CustomerID'];

        // $productname = $_POST['productname'];
        // $q1="SELECT CartID from shoppingcart where CartID = '$userid' ";
		// $result=$conn->query($q1);
		// if(!$result){
		// 	echo "Select failed. Error: ".$conn->error ;
		// 	return false;
		// }
            
        // $row2=$result->fetch_array();
        // $cartid = $row2['CartID'];
        $cartid = $userid;
        $q="ALTER TABLE customerorder AUTO_INCREMENT=1";
        $result=$conn->query($q);
        if(!$result){
            echo "Update failed. Error: ".$conn->error;
            return false;
        }

        $totalamount = $_POST['total'];
		$q2="INSERT INTO `customerorder`(`OrderID`, `CustomerID`, `PurchaseDate`, `TotalAmount`) VALUES (NULL,'$userid',NULL,'$totalamount')";
		$result=$conn->query($q2);
		if(!$result){
			echo "INSERT failed. Error: ".$conn->error ;
			return false;
		}

        $q3="SELECT * FROM incart WHERE CustomerID = $userid";
        $result3=$conn->query($q3);
        if(!$result3){
			echo "SELECT failed. Error: ".$conn->error ;
			return false;
        }
        while($row3=$result3->fetch_array()){
            $pid = $row3['ProductID'];
            $q4="INSERT INTO `inorder` (`inOrderID`, `orderID`, `productID`) VALUES (NULL, (SELECT MAX(OrderID) AS OrderID FROM customerorder), $pid)";
		    $result=$conn->query($q4);
		    if(!$result){
                echo "INSERT failed. Error: ".$conn->error ;
                return false;
		    }
        }
		
    }
?>
<body id="mainbackground">
    <div id="header">
		<form action="product.php" method="post">
            <a class="logo"href="mainpage(logined).php"><img src="Images/logo.png" alt="logoicon" width="70"></a>
            <a class="storename"href="mainpage(logined).php">Stonk Gunpla</a>
            <a class="logout"href="logout.php">Log out<img src="Images/logout.png" alt="logouticon" width="20"></a>
            <a class="profile"href="profile.php">Profile<img src="Images/profile.png" alt="profileicon" width="20"></a>
            <a class="cart"href="cart.php">My Cart<img src="Images/cart.png" alt="carticon" width="20"></a>
            <a class="wish"href="wishlist.php">Wishlist<img src="Images/wishlist.png" alt="wishicon" width="20"></a>
            <a class="prod"href="productlist(logined).php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <div id="summarybody">
            <h1>Order Completed!</h1>
        <div id= "subbody">
            <form action="mainpage(logined).php" method = "POST">
                <div class="summarytext">
                    <?php
                    $username = $_SESSION['username'];
                    $q="select CustomerID from customer where Name = '$username' ";
                    $result=$conn->query($q);
                    if(!$result){
                        echo "Select failed. Error: ".$conn->error ;
                        return false;
                    }
                    $row1=$result->fetch_array();
                    $userid= $row1['CustomerID'];
                    $q="SELECT * FROM customer WHERE CustomerID = $userid"; 
                    $result = $conn->query($q);
                    $row=$result->fetch_array();
                    echo "<label>Name: </label>";
                    $summaryName = $row['Name'];
                    echo "<label name='summaryname'>$summaryName</label>";
                    echo "<br>";
                    echo "<br>";
                    echo"<label>Delivery Address: </label>";
                    $summaryAddr = $row['Address'];
                    echo "<label name='summaryaddr'>$summaryAddr</label>";
                    echo "<br>";
                    echo "<br>";
                    echo"<label>Phone Number: </label>";
                    $summaryPhonenum = $row['PhoneNumber'];
                    echo "<label name='summaryaddr'>$summaryPhonenum</label>";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    ?>
                </div>
                <div class="summaryprodlist">
                    <table style="border-spacing: 60px;">
                        <col width="5%">
                        <col width="4%">
                        <col width="4%">

                    <tr>
                        <th></th> 
                        <th>Product name</th>
                        <th>Price (Baht)</th>
                    </tr>
 		        <?php 
				$q="SELECT * from incart, product where CustomerID = $userid and incart.ProductID = product.ProductID";
				$result=$conn->query($q);
				if(!$result){
					echo "Select failed. Error: ".$conn->error ;
					return false;
				}
                
				while($row=$result->fetch_array()){ ?>
                <tr class = "productlist">
                    <td><img src = "<?php echo $row['Image']; ?>" height="150" width="225"></td> 
                    <td><?=$row['ProductName']?></td>
                    <td><?=$row['Price']?></td>
                    <br>
                </tr>
                
				<?php } ?>

            </table>
    </div>
    <div class= "sumtotal">
        <?php
            $q = "SELECT SUM(Price) FROM incart, product WHERE CustomerID = $userid AND incart.ProductID = product.ProductID;";
            $result=$conn->query($q);
                if(!$result){
                    echo "Select failed. Error: ".$conn->error ;
                    return false;
                }
            $row=$result->fetch_array();
            $total = $row['SUM(Price)'];
        ?>
        <a class="summarytotal">Total: <?php echo $total?> Baht</a>   
        </div>
        
        <button class="tomainpagebtn" type="submit" name="tomainpage">Back to Main Page</button>
        </form>
        </div>
</body>