<?php
session_start();
require_once('config.php');
	if(isset($_POST['applychange'])) {
        $username = $_SESSION['username'];
        $q="select CustomerID from customer where Name = '$username' ";
		$result=$conn->query($q);
		if(!$result){
			echo "Select failed. Error: ".$conn->error ;
			return false;
		}
        $row1=$result->fetch_array();
        $userid= $row1['CustomerID'];
	    $name = $_POST['name'];
        $_SESSION['username'] = $name;
	    $address = $_POST['address'];
	    $email = $_POST['email'];
	    $phonenum = $_POST['phonenum'];
	    $cardnum = $_POST['cardnum'];
	$q="UPDATE customer SET Name = '$name', Address = '$address', Email = '$email', 
	PhoneNumber = '$phonenum', CardNumber= '$cardnum' WHERE CustomerID = '$userid'"; 
    //$q ="INSERT INTO `customer`(`CustomerID`, `Name`, `Address`, `Email`, `Password`, `PhoneNumber`, `CardNumber`, `CardHolderName`) VALUES (NULL,'$name','$address','$email','NULL','$phonenum','$cardnum','NULL')";
	$result=$conn->query($q);
	if(!$result){
	 	echo "Update failed. Error: ".$conn->error ;
		return false;
		}
	header("Location: profile.php");	
	}
?>