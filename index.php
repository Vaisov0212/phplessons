<?php
require('db/connect.php');

    $sql="SELECT * FROM users   ORDER BY id DESC ";
    $result=$conn->query($sql);
    $users=$result->fetch_all(MYSQLI_ASSOC);
    ?>
    
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Foydalanuvchilar</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      color: #333;
    }

    header {
      background: #2563eb;
      color: white;
      padding: 16px 32px;
      font-size: 20px;
      font-weight: bold;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 16px;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .top-bar h2 {
      font-size: 22px;
    }

    .btn-add {
      background: #2563eb;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-add:hover {
      background: #1d4ed8;
    }

    table {
      width: 100%;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      border-collapse: collapse;
      box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }

    thead {
      background: #2563eb;
      color: white;
    }

    th, td {
      padding: 14px 18px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
      font-size: 14px;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover td {
      background: #f9fafb;
    }

    .actions {
      display: flex;
      gap: 8px;
    }

    .btn-edit {
      background: #f59e0b;
      color: white;
      padding: 6px 14px;
      border-radius: 5px;
      text-decoration: none;
      font-size: 13px;
    }

    .btn-edit:hover { background: #d97706; }

    .btn-delete {
      background: #ef4444;
      color: white;
      padding: 6px 14px;
      border-radius: 5px;
      text-decoration: none;
      font-size: 13px;
    }

    .btn-delete:hover { background: #dc2626; }
  </style>
</head>
<body>

<header>👥 Users CRUD</header>

<div class="container">
  <div class="top-bar">
    <h2>Foydalanuvchilar ro'yxati</h2>
    <a href="create.php" class="btn-add">+ Yangi qo'shish</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Ism</th>
        <th>Email</th>
        <th>yoshi</th>
        <th>Amallar</th>
      </tr>
    </thead>
    <tbody>
      <!-- PHP da shu yerga foreach bilan chiqarish -->
        <?php foreach($users as $user):?>
            <tr>
                <td><?=$user["id"] ;?></td>
                <td><?=$user["name"]?></td>
                <td><?=$user["email"]?></td>
                <td><?=$user["eage"]?></td>
                <td class="actions">
                <a href="edit.html?id=1" class="btn-edit">Tahrir</a>
                <a href="delete.php?id=1" class="btn-delete" onclick="return confirm('O\'chirishni tasdiqlaysizmi?')">O'chirish</a>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
  </table>
</div>

</body>
</html>