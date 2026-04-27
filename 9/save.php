<?php

require("db/connect.php");
$s_id=$_POST["s_id"];
$ism=$_POST["ism"];
$email=$_POST["email"];
$eage=$_POST["eage"];

$sql="UPDATE students SET name=:name, email=:email, eage=:eage WHERE id=:id ";

$stmt=$conn->prepare($sql);
$stmt->execute([
    ':name'=>$ism,
    ':email'=>$email,
    ':eage'=>$eage,
    ':id'=>$s_id
]);

echo "Malumotlar saqlandi<a href='index.php'>qaytish</a> ";

?>