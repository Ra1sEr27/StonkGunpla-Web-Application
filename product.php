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
        <form action="product.php" method="post">
            <a class="logo"href="mainpage.php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="mainpage.php">Stonk Gunpla</a>
            <a class="login"href="login.php">Login/Sign up<img src="Images/login.png" alt="loginicon" width="20"></a>
            <a class="prod"href="productlist.php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <div id= "mainpagebody">
        
        <div id="product_name">
            <label class="big_product_name"><?php echo $row2[2]; ?></label>
        </div>
        <div name = "pic" style="margin:auto;">
            <img src="<?php echo $row2[3]; ?>"class="productpic"width="300">
        </div>
        <div class="product_main_right">
            <div id="price">
                <label class="price">Price: <?php echo $row2[6]; ?> Baht</label>
        </div>

        </div>
        </div>

        
    </div>
    <br>
    <br>
    <br>
</div>
</body>
</html>