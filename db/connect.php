<?php
$server="localhost";
$user="root";
$password="123456";
$db_name="tech_db";

try{
    $conn=new PDO("mysql:host=$server;dbname=$db_name",$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}catch(PDOException $error){
    echo $error->getMessage();
}





?>