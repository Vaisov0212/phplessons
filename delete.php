<?php

require("db/connect.php");
$s_id=$_POST['s_id'];

$sql="DELETE FROM students WHERE id=:id";

$stmt=$conn->prepare($sql);
$stmt->execute([
    ':id'=>$s_id
]);

echo "Mlumtlar ochirildi <a href='index.php'>qaytish</a>";

?>