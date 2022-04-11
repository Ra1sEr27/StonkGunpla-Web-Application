<?php
session_start();
require_once('config.php');
	if(isset($_POST['applychange'])) {
        $productid = $_POST['productid'];
	    $productname = $_POST['productname'];
	    $image = $_POST['image'];
	    $price = $_POST['price'];
	    $productbrand = $_POST['productbrand'];
		$q="UPDATE product SET ProductName = '$productname', Image = '$image', Price = '$price', 
		ProductBrand = '$productbrand' WHERE ProductID = '$productid'"; 
		$result=$conn->query($q);
		if(!$result){
			echo "Update failed. Error: ".$conn->error ;
			return false;
		}
		header("Location: staffproductlist.php");	
	}
	else if(isset($_POST['addproduct'])) {

        // $productid = $_POST['productid'];
		$productbrand = $_POST['productbrand'];
	    $productname = $_POST['productname'];
	    $image = $_POST['image'];
	    $price = $_POST['price'];
	    $q="ALTER TABLE product AUTO_INCREMENT=1";
		$result=$conn->query($q);
		if(!$result){
			echo "Update failed. Error: ".$conn->error ;
			return false;
		}
		
		$q="INSERT INTO product(`ProductID`, `ProductBrand`, `ProductName`, `Image`, `ProductDescription`, `StaffID`, `Price`) VALUES (NULL,'$productbrand','$productname','$image','','1','$price')"; 
		$result=$conn->query($q);
		if(!$result){
			echo "Update failed. Error: ".$conn->error ;
			return false;
		}
		header("Location: staffproductlist.php");	
	}
?>