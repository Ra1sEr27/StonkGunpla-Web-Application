<?php
$mysqli = new mysqli('localhost','root','','robot_model_onlineshop');
   if($mysqli->connect_errno){
      echo $mysqli->connect_errno.": ".$mysqli->connect_error;
   }
 ?>
