<?php require_once('config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product page of pain</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>
<?php
    if(isset($_POST["seemore"])){
        $productname = $_POST['productname'];
        $q1="select * from product where ProductName = '$productname' ";
		$result=$conn->query($q1);
		if(!$result){
			echo "Select failed. Error: ".$conn->error ;
			return false;
		}
        $row2=$result->fetch_array();
        
    }
    else if(isset($_POST['addtowishlist'])) {
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
        $q1="select * from product where ProductName = '$productname' ";
        $result=$conn->query($q1);
        if(!$result){
            echo "Select failed. Error: ".$conn->error ;
            return false;
        }
        
        $row2=$result->fetch_array();

        $productid = $row2[0];
        $q2="INSERT INTO `inwishlist`(`WishlistID`, `ProductID`) VALUES ($userid,$productid)";
        $result=$conn->query($q2);
            if(!$result){
                echo "INSERT failed. Error: ".$conn->error ;
                return false;
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
        $q1="select * from product where ProductName = '$productname' ";
        $result=$conn->query($q1);
        if(!$result){
            echo "Select failed. Error: ".$conn->error ;
            return false;
        }
        
        $row2=$result->fetch_array();
        $productid = $row2[0];
        $q2="INSERT INTO `incart`(`CustomerID`, `ProductID`) VALUES ($userid,$productid)";
        $result=$conn->query($q2);
            if(!$result){
                echo "INSERT failed. Error: ".$conn->error ;
                return false;
            }

    }
    else{
        $productname = $_GET['productname'];
        $q1="select * from product where ProductName = $productname ";
		$result=$conn->query($q1);
		if(!$result){
			echo "Select failed. Error: ".$conn->error ;
			return false;
		}
        $row2=$result->fetch_array();
    }
?>
<body id="mainbackground">
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
    <div id= "mainpagebody">
        <form method="POST">
            <div id="product_name">
                <label class="big_product_name"><?php echo $row2['ProductName']; ?></label>
                
            </div>
            
            <div name = "pic" style="margin:auto;">
                <img src="<?php echo $row2['Image']; ?>"class="productpic"width="300">
            </div>

            <div class="product_main_right">
                <div id="price">
                    <label class="price">Price: <?php echo $row2['Price']; ?> Baht</label>
            </div>
            <input type="hidden" name="productname" value = "<?php echo $row2['ProductName']; ?>">
        </form>
        </div>
        </div>

        
    </div>
    <br>
    <br>
    <br>
</div>
</body>
</html>