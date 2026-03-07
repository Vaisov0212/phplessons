<?php

$server="localhost";
$user="root";
$password="123456";
$db="tech_db";

$conn=new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("ulanishda xatolik".$conn->connect_error);
}


?>