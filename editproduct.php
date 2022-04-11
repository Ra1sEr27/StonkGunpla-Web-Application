<?php require_once('config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit page</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>

<body id="mainbackground">
<div id="wrapper">
    <div id="header">
        <form action="product.php" method="post">
            <a class="logo"href="mainpage(logined).php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="mainpage(logined).php">Stonk Gunpla</a>
            <a class="logout"href="logout.php">Log out<img src="Images/logout.png" alt="logouticon" width="20"></a>
            <a class="order"href="customerorder.php">Order<img src="Images/order.png" alt="logouticon" width="20"></a>
            <a class="profile"href="profile.php">Profile<img src="Images/profile.png" alt="profileicon" width="20"></a>
            <a class="prod"href="productlist(logined).php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    
    <div id="body">
            <h1>Edit Product</h1>
        <div id= "subbody">
            <form action="updateproduct.php" method = "POST">
                <div class="textbox">
                <?php
                
                $productname = $_POST['productname'];
                $q="select * from product where ProductName = '$productname' ";
                $result=$conn->query($q);
                if(!$result){
                    echo "Select failed. Error: ".$conn->error ;
                    return false;
                }
                $row=$result->fetch_array();
                echo "<label>Product Brand</label>";
                echo "<input type='text' name='productbrand' value='".$row['ProductBrand']."'>";
                echo "<br>";
                echo "<br>";
                echo "<label>Product Name</label>";
                echo "<input type='text' name='productname' value='".$row['ProductName']."'>";
                echo "<br>";
                echo "<br>";
                echo"<label>Image</label>";
                echo "<input type='text' name='image' value='".$row['Image']."'>";
                echo "<br>";
                echo "<br>";
                echo "<label>Price</label>";
                echo "<input type='text' name='price' value=".$row['Price'].">";
                ?>
                </div>
                <input type="hidden" name="productid" value="<?php echo $row['ProductID']; ?>">
                <button class="btn" type="submit" name="applychange">Apply</button>
            </form>
        </div>
        
            
    </div>