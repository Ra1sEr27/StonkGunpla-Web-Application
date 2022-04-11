<?php require_once('config.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile page</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
</head>

<body id="mainbackground">
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
    
    <div id="body">
            <h1>My Profile</h1>
        <div id= "subbody">
            <form action="updatecustomer.php" method = "POST">
                <div class="editprofileinfo">
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
                    
                    echo "<label>Name</label>";
                    echo "<input type='text' name='name' value='".$row['Name']."'>";
                    echo "<br>";
                    echo "<br>";
                    echo"<label>Address</label>";
                    echo "<input type='text' name='address' value='".$row['Address']."'>";
                    echo "<br>";
                    echo "<br>";
                    echo "<label>Email</label>";
                    echo "<input type='text' name='email' value=".$row['Email'].">";
                    echo "<br>";
                    echo "<br>";
                    echo "<label>Phone Number</label>";
                    echo "<input type='text' name='phonenum' value=".$row['PhoneNumber'].">";
                    echo "<br>";
                    echo "<br>";
                    echo "<label>Card Number</label>";
                    echo "<input type='text' name='cardnum' value=".$row['CardNumber'].">";
                    ?>
                </div>
                <button class="btn" type="submit" name="applychange">Apply</button>
            </form>
        </div>
    </div>