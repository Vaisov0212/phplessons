<?php

// emty(). bosh bolsa 0, "", " ", null true aks holda false
// trim(). null false tru aks holda true -- null -- haqiqy boshliq 
//isset() satrning boshi va oxiridagi bosh joylardan tozalaydi
// $a=null;
// $b='';
// $c=0;

// echo "EMPTY()=";
// var_dump(empty($c));

// echo "<br><br>";
// echo "ÏSSET()=";
// var_dump(isset($a));

// var_dump(trim($name)); 
// -------------------------
// if(!empty($_POST["name"])){
//     $name=trim($_POST["name"]);
// }else{
// $name='';
// }


$name=!empty($_POST["name"]) ? trim($_POST["name"]) : '';
// var_dump(!preg_match("/^[a-zA-Z-' ]*$/",$name));
if(strlen($name)<3 || strlen($name)>40 ){
    echo "Ism kamida 3 ta belgidan kam bolmasligi va 40 ta belgidan oshmasligi kerak";
}else{
    if(preg_match("/^[a-zA-Z-' ]*$/",$name)){
        echo "perfect";
    }else{
        echo "Ism da belgilar bolmashligi kerak";
    }
}




?>