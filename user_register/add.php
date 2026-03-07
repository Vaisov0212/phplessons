<?php
require("connect.php");


$name= !empty($_POST["full_name"]) ? trim($_POST["full_name"]): '' ;

// if(!empty($_POST["full_name"])){
//     $name=trim($_POST["full_name"]);
// }
// else{
//     $name='';
// }
$date= !empty($_POST["brith_date"]) ? htmlspecialchars(trim($_POST["brith_date"]), ENT_COMPAT): "1999-01-01";
$login=!empty($_POST["login"]) ? htmlspecialchars(trim($_POST["login"]),ENT_COMPAT): '';
$password=!empty($_POST["pass"]) ? htmlspecialchars(trim($_POST["pass"]), ENT_COMPAT): '';
$error=false;
if($name==''){
   echo "ism kiritilishi shart <br>";
   $error=true;
}
if($login==''){
    echo "login kiritilishi shart<br>";
   $error=true;
}
if($date=="1999-01-01"){
    echo "tug'ilgan sana kiritilishi shart<br>";
    $error=true;
}
if($password==''){
      echo "parol kiritilishi shart<br>";
     $error=true;
}
if($error==true){
    exit;
}
else{

$sorov="SELECT * FROM users WHERE login='$login' ";
// $respons=$conn->query($sorov)->fetch_assoc();

if($conn->query($sorov)->num_rows>0){
        echo "Bunday foydalanuvchi nomi allaqachon mavjud";
        exit;
}

$hash_pass=md5($password);


$sql="INSERT INTO users(full_name,brith_date,login,password)
VALUES('$name','$date','$login','$hash_pass')";

if($conn->query($sql)===TRUE){
    echo "Malumotlar yozildi";
 }


}




?>