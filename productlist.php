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

<body>
<div id="wrapper">
    <div id="header">
        <form action="product.php" method="post">
            <a class="logo"href="mainpage.php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="mainpage.php">Stonk Gunpla</a>
            <a class="login"href="login.php">Login/Sign up<img src="Images/login.png" alt="loginicon" width="20"></a>
            <a class="prod"href="productlist.php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <div class="prodlist">
            <table style="border-spacing: 60px;">
                <col width="2%">
                <col width="4%">
                <col width="4%">

                <tr>
                    <th></th> 
                    <th>Product name</th>
                    <th>Price (Baht)</th>
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
                    <td><?=$row['Price']?></td>
                    <!-- <br> -->
                </tr>                               
				<?php } ?>

            </table>
    </div>
    
</div>
</body>
</html>