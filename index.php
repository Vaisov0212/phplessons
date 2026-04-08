<?php

require("db/connect.php");

$sql="SELECT * FROM students";

$stmt=$conn->prepare($sql);
$stmt->execute();
$students=$stmt->fetchAll();
// var_dump($students);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>STUDENT LIST</h2>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>eage</th>
            <th>amallar</th>
        </tr>
         <?php  $i=0;
          foreach($students as $student) : 
           
            $i++; ?>
        <tr>

           
            <td><?= $i?></td>
            <td><?= $student["name"] ?></td>
            <td><?= $student["email"] ?></td>
            <td><?= $student["eage"] ?></td>
            <td>
                <input value="edit" type="submit">
                <input value="delete" type="submit">
            </td>
           
        </tr>
         <?php endforeach; ?>
    </table>
</body>
</html>