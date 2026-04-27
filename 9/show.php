<?php

require("db/connect.php");

$s_id=$_POST["s_id"];

$sql="SELECT * FROM students WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->execute([
    ':id'=>$s_id
]);
$student=$stmt->fetch();

var_dump($student);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>STUDENT CREATE</h2>
    <form action="save.php" method="POST" >
        <input value="<?= $student["id"] ?>" type="hidden" name="s_id" >
        ism: <br>
        <input value="<?= $student["name"] ?>" name="ism" type="text"> <br> <br>
        email <br>
        <input value="<?= $student["email"]?>" name="email" type="email"> <br> <br>
        yosh: <br>
        <input  value="<?= $student["eage"]?>" name="eage" type="number"> <br> <br>

        <button type="submit">saqlash</button> 
    </form>
</body>
</html>