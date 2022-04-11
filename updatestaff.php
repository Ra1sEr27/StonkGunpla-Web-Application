<?php
session_start();
require_once('config.php');
	if(isset($_POST['applychange'])) {
        $username = $_SESSION['username'];
        $q="select StaffID from admin where Name = '$username' ";
		$result=$conn->query($q);
		if(!$result){
			echo "Select failed. Error: ".$conn->error ;
			return false;
		}
        $row1=$result->fetch_array();
        $userid= $row1['StaffID'];
	    $name = $_POST['name'];
        $_SESSION['username'] = $name;
	    $email = $_POST['email'];
	    $phonenum = $_POST['phonenum'];
	$q="UPDATE admin SET Name = '$name', Email = '$email', 
	PhoneNumber = '$phonenum' WHERE StaffID = '$userid'"; 
	$result=$conn->query($q);
	if(!$result){
	 	echo "Update failed. Error: ".$conn->error ;
		return false;
		}
	header("Location: staffprofile.php");	
	}
?>