<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: mainpage.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM customer WHERE Email='$email' AND Password='$password'";
	$result = mysqli_query($conn, $sql);
	if (!$result) {
        die('Error: '.$q." ". $mysqli->error);
    }
	
	if ($result -> num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['Name'];
		print_r($_SESSION);
		header("Location: mainpage(logined).php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website!</title>
    <link rel="stylesheet" href="style.css"><!--Awaiting further css file-->
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
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button style = "margin-top: 70px;" name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
			<p class="login-register-text">Are you staff? <a href="stafflogin.php">Click Here my amigos</a>.</p>
		</form>
	</div>
</body>