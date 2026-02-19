<?php
require('db/connect.php');

$name=$_POST["name"];
$email=$_POST["email"];
$eage=$_POST["eage"];

$sql="INSERT INTO users(name,email,eage) VALUES('$name','$email','$eage')";

if($conn->query($sql)===TRUE){
    echo "Muofaqiyatli qo'shildi";
}


?>