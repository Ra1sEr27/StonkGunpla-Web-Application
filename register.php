<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$phonenum = $_POST['phonenum'];
	$cardnum = $_POST['cardnum'];
	$cardname = $_POST['cardname'];
	
	if ($password == $cpassword) {
		$sql = "SELECT * FROM customer WHERE Email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$q="ALTER TABLE customer AUTO_INCREMENT=1";
				$result=$conn->query($q);
				if(!$result){
				echo "Update failed. Error: ".$conn->error ;
				return false;
			}
			$sql = "INSERT INTO customer (Name, Address, Email, Password , PhoneNumber , CardNumber , CardHolderName)
					VALUES ('$username', '$address' , '$email', '$password' , '$phonenum' , '$cardnum' , '$cardname')"; //insert the rest of the data IN
			$result = mysqli_query($conn, $sql);
			
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$q="select CustomerID from customer where Name = '$username' ";
				$result=$conn->query($q);
				if(!$result){
					echo "Select failed. Error: ".$conn->error ;
					return false;
				}
				$row1=$result->fetch_array();
				$userid= $row1['CustomerID'];
				$q="ALTER TABLE wishlist AUTO_INCREMENT=1";
				$result=$conn->query($q);
				if(!$result){
					echo "Update failed. Error: ".$conn->error ;
					return false;
				}
				$q2="INSERT INTO `wishlist`(`WishlistID`, `CustomerID`) VALUES (NULL,'$userid')";
				$result=$conn->query($q2);
					if(!$result){
						echo "INSERT failed. Error: ".$conn->error ;
						return false;
					}
				// $q="ALTER TABLE shoppingcart AUTO_INCREMENT=1";
				// $result=$conn->query($q);
				// if(!$result){
				// 	echo "Update failed. Error: ".$conn->error ;
				// 	return false;
				// }
				// $q2="INSERT INTO `shoppingcart`(`CartID`, `CustomerID`) VALUES (NULL,'$userid')";
				// $result=$conn->query($q2);
				// 	if(!$result){
				// 		echo "INSERT failed. Error: ".$conn->error ;
				// 		return false;
				// 	}
				$username = "";
				$email = "";
				$address = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				$phonenum = "";
				$cardnum = "";
				$cardname = "";
				// header("Location: login.php");
				
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mainpage lol</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="mainbackground">
    <div id="header">
        <form action="product.php" method="post">
            <a class="logo"href="mainpage.php"><img src="Images/logo.png" alt="profileicon" width="70"></a>
            <a class="storename"href="mainpage.php">Stonk Gunpla</a>
            <a class="login"href="login.php">Login/Sign up<img src="Images/login.png" alt="loginicon" width="20"></a>
            <a class="prod"href="productlist.php">Product<img src="Images/product.png" alt="productcon" width="20"></a>
        </form>
    </div>
    <div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Your Address" name="address" value="<?php echo $address; ?>" required> <!-- address input -->
			</div>
			<div class="input-group">
				<input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Phone Number" name="phonenum" value="<?php echo $phonenum; ?>" required> <!-- phone number -->
			</div>
			<div class="input-group">
				<input type="text" placeholder="Card Number" name="cardnum" value="<?php echo $cardnum; ?>" required> <!-- card number -->
			</div>
			<div class="input-group">
				<input type="text" placeholder="Card Holder Name" name="cardname" value="<?php echo $cardname; ?>" required> <!-- card holder name -->
			</div>
			<div class="input-group">
				<button style = "margin-top: 70px;" name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
</body>