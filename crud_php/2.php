    <?php


    require("db/connect.php");

    $sql="SELECT * FROM users";
    $result=$conn->query($sql);
    $users=$result->fetch_all(MYSQLI_ASSOC);
    var_dump($users);



    ?>

<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>yosh</th>
    </tr>
  <?php
    foreach($users as $user){
        echo "<tr>
        <td>".$user["id"]."</td>
        <td>".$user["name"]."</td>
        <td>".$user["eage"]."</td>
    </tr>";
    }
  ?>
</table>
