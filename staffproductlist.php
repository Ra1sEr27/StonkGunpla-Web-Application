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
        <form action="staffproduct.php" method="post">
            <a class="logo"href="staffmainpage.php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="staffmainpage.php">Stonk Gunpla</a>
            <a class="logout"href="logout.php">Log out<img src="Images/logout.png" alt="logouticon" width="20"></a>
            <a class="order"href="customerorder.php">Order<img src="Images/order.png" alt="logouticon" width="20"></a>
            <a class="profile"href="staffprofile.php">Profile<img src="Images/profile.png" alt="profileicon" width="20"></a>
            <a class="prod"href="staffproductlist.php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <?php
		if(isset($_POST['remove'])) { //remove product from the inwishlist table
            $productname = $_POST['productname'];
            $q1="select ProductID from product where ProductName = '$productname' ";
			$result=$conn->query($q1);
			if(!$result){
				echo "Select failed. Error: ".$conn->error ;
				return false;
			}
            
            $row2=$result->fetch_array();
            $productid = $row2['ProductID'];
			$q2="DELETE FROM `incart` WHERE ProductID = $productid;";
			$result=$conn->query($q2);
				if(!$result){
					echo "INSERT failed. Error: ".$conn->error ;
					return false;
				}
            $q2="DELETE FROM `inwishlist` WHERE ProductID = $productid;";
			$result=$conn->query($q2);
				if(!$result){
					echo "INSERT failed. Error: ".$conn->error ;
					return false;
				}
			$q2="DELETE FROM `product` WHERE ProductID = $productid;";
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
                    <th>
                        <form action="addproduct.php" method="POST">
                                <button class="btn" type="submit" name="edit">Add</button></a>
                                <input type="hidden" name="productname" value="<?php echo $row['ProductName']; ?>">
                        </form>
                    </th> 
                </tr>
 		<?php 
				$q="select * from product";
				$result=$conn->query($q);
				if(!$result){
					echo "Select failed. Error: ".$conn->error ;
					return false;
				}
				while($row=$result->fetch_array()){ ?>
                    <tr class = "productlist">
                        <td><img src = "<?php echo $row['Image']; ?>" height="300" width="450"></td> 
                        <td><?=$row['ProductName']?></td>
                        <input type="hidden" name="productname" value = "<?php echo $row['ProductName']; ?>">
                        <td><?=$row['Price']?></td>
                        <td>
                            <form action="editproduct.php" method="POST">
                                <button class="btn" type="submit" name="edit">Edit</button></a>
                                <input type="hidden" name="productname" value="<?php echo $row['ProductName']; ?>">
                            </form>
                        </td>
                        <td>
                            <form method = "POST">
                                <button class="btn" type="submit" name="remove">Remove</button>
                                <input type="hidden" name="productname" value="<?php echo $row['ProductName']; ?>">
                            </form>
                        </td>
                    </tr>
                
				<?php } ?>
            </table>
    </div>
    
</div>
</body>
</html>