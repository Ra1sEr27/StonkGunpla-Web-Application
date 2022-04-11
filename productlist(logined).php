<?php require_once('config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products list page (Logined)</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>

<body>
<div id="wrapper">
    <div id="header">
        <form action="product.php" method="post">
            <a class="logo"href="mainpage(logined).php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="mainpage(logined).php">Stonk Gunpla</a>
            <a class="logout"href="logout.php">Log out<img src="Images/logout.png" alt="logouticon" width="20"></a>
            <a class="profile"href="profile.php">Profile<img src="Images/profile.png" alt="profileicon" width="20"></a>
            <a class="cart"href="cart.php">My Cart<img src="Images/cart.png" alt="profileicon" width="20"></a>
            <a class="wish"href="wishlist.php">Wishlist<img src="Images/wishlist.png" alt="wishicon" width="20"></a>
            <a class="prod"href="productlist(logined).php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <?php
		if(isset($_POST['addtowishlist'])) {
			$username = $_SESSION['username'];
            $q="select CustomerID from customer where Name = '$username' ";
			$result=$conn->query($q);
			if(!$result){
				echo "Select failed. Error: ".$conn->error ;
				return false;
			}
            $row1=$result->fetch_array();
            $userid= $row1['CustomerID'];

            $productname = $_POST['productname'];
            $q1="select ProductID from product where ProductName = '$productname' ";
			$result=$conn->query($q1);
			if(!$result){
				echo "Select failed. Error: ".$conn->error ;
				return false;
			}
            
            $row2=$result->fetch_array();

            $productid = $row2['ProductID'];
			$q2="INSERT INTO `inwishlist`(`WishlistID`, `ProductID`) VALUES ($userid,$productid)";
			$result=$conn->query($q2);
				if(!$result){
					// echo "INSERT failed. Error: ".$conn->error ;
                    echo "<script>alert('This Product is already in your wishlist.')</script>";
					// return false;
				}
		}
        else if(isset($_POST['addtocart'])) { //insert product into the incart table
			$username = $_SESSION['username'];
            $q="select CustomerID from customer where Name = '$username' ";
			$result=$conn->query($q);
			if(!$result){
				echo "Select failed. Error: ".$conn->error ;
				return false;
			}
            $row1=$result->fetch_array();
            $userid= $row1['CustomerID'];

            $productname = $_POST['productname'];
            $q1="select ProductID from product where ProductName = '$productname' ";
			$result=$conn->query($q1);
			if(!$result){
				echo "Select failed. Error: ".$conn->error ;
				return false;
			}
            
            $row2=$result->fetch_array();
            $productid = $row2['ProductID'];
            
			$q2="INSERT INTO `incart`(`CustomerID`, `ProductID`) VALUES ($userid,$productid)";
			$result=$conn->query($q2);
				if(!$result){
					echo "INSERT failed. Error: ".$conn->error ;
					return false;
				}
		}
	?>
    <div class="prodlist">
            <table style="border-spacing: 60px;">
                <col width="30%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <tr>
                    <th></th> 
                    <th>Product name</th>
                    <th>Price (Baht)</th>
                    <th></th> 
                    <th></th> 
                </tr>
 		<?php 
				$q="select * from product";
				$result=$conn->query($q);
				if(!$result){
					echo "Select failed. Error: ".$conn->error ;
					return false;
				}
				while($row=$result->fetch_array()){ ?>
                <form method = "POST">
                    <tr class = "productlist">
                        <td><img src = "<?php echo $row['Image']; ?>" height="300" width="450"></td> 
                        <td><?=$row['ProductName']?></td>
                        <input type="hidden" name="productname" value = "<?php echo $row['ProductName']; ?>">
                        <td><?=$row['Price']?></td>
                        <td>
                            <button class="btn" type="submit" name="addtowishlist">Add to Wishlist</button>
                        </td>
                        <td>
                            <button class="btn" type="submit" name="addtocart">Add to Cart</button>
                        </td>
                    </tr>
                </form>
				<?php } ?>
            </table>
    </div>
    
</div>
</body>
</html>