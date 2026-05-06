<?php
session_start();
date_default_timezone_set("Asia/Tashkent");

function breaths($date){

        $min_date=round((time()-strtotime($date))/60);
        $breaths_numbers=$min_date*16;
        return $breaths_numbers;
}

$name=!empty($_POST["name"])? trim($_POST["name"]): '';
$b_date=!empty($_POST["b_date"])? trim($_POST["b_date"]): '';



if($name=='' || $b_date=='' || strlen($name)<3 ){
      header("Location:index.php");
      $_SESSION["err"]="Malumotlar toliq toldirilishi kerak";
}
else{
        $response=breaths($b_date);
}


?>


<!-- PAGE 2: result.html -->
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Natija</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
    body{background:linear-gradient(135deg,#1d2671,#c33764);color:#fff;display:flex;justify-content:center;align-items:center;height:100vh}
    .result-box{background:rgba(255,255,255,0.08);padding:40px;border-radius:20px;text-align:center;backdrop-filter:blur(10px);box-shadow:0 10px 40px rgba(0,0,0,.4);max-width:500px;width:90%}
    h1{margin-bottom:20px}
    .number{font-size:40px;font-weight:600;margin:20px 0;color:#00ffcc}
    p{opacity:.85;line-height:1.6}
    a{display:inline-block;margin-top:20px;padding:12px 20px;border-radius:10px;background:#fff;color:#333;text-decoration:none;font-weight:500;transition:.3s}
    a:hover{background:#ddd}
  </style>
</head>
<body>
  <div class="result-box">
    <h1><?= $name ?></h1>
    <p>Siz tug'ilganingizdan beri taxminan</p>
    <div class="number"><?= $response  ?></div>
    <p>marta nafas olgansiz 🌬️</p>
    <p>Bu raqam sizning hayotingiz davomida qanchalik faol yashaganingizni ko'rsatadi.</p>
    <a href="index.php">Qayta hisoblash</a>
  </div>
</body>
</html>
