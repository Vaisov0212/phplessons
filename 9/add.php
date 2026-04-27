<?php
require("db/connect.php");
$ism=$_POST["ism"];
$email=$_POST["email"];
$eage=$_POST["eage"];

try{

    $sql="INSERT INTO students(name,email,eage) VALUES(:name,:email,:eage)";
    $stmt=$conn->prepare($sql);
    $stmt->execute([':name'=>$ism,':email'=>$email,':eage'=>$eage]);
    echo "Malumotlar yozildi";

}catch(PDOException $e){
    echo $e->getMessage();
}



?>