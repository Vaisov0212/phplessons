<?php
session_start();
require("connect.php");

$login= !empty($_POST["login"]) ? trim($_POST["login"]): '';
$parol= !empty($_POST["password"]) ? trim($_POST["password"]) : '';
$hash_pass=md5($parol);
$errors=[];
unset($_SESSION["login_errors"]);


if($login=='' ){
    $errors['login_bosh']="Login   kiritilmagan";
}
if( $parol==''){
     $errors['parol_bosh']="parol kiritilmagan";
}
if(!empty($login)){
    $sql="SELECT * FROM users WHERE login LIKE '$login'";
    $user=$conn->query($sql)->fetch_assoc();
    if($user==null){
        $errors["login_xato"]="Bunday foydalanuvchi topilmadi";
    }
    else{
        if($user["password"]===$hash_pass){
            $_SESSION["user_id"]=$user["id"];
            header("Location:dashboard/dash.php");
            exit;
        }else{
             $errors["parol_xato"]="parol noto'g'ri";
   
        }
    }
}

if(!empty($errors)){
    $_SESSION["login_errors"]=$errors;
    header("Location:login.php");
}










?>