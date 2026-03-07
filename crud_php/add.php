<?php
require("db/connect.php");

$name=$_POST["odi"];
$email=$_POST["pochta"];
$eage=$_POST["yosh"];

$sql="INSERT INTO users(name,email,eage) Values('$name','$email','$eage')";

if($conn->query($sql)===TRUE){
    echo "Malumotlar yozildi !";
}
else{
    echo "xatolik";
}




?>