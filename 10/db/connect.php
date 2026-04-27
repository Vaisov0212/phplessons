<?php

$server="localhost";
$user="root";
$password="123456";
$db="tech_db";

$conn=new PDO("mysql:host=$server;db_name=$db;", $user,$password );

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


?>