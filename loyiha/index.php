<!-- fotm ------- -->
<?php
session_start();
date_default_timezone_set("Asia/Tashkent");

?>
<!-- PAGE 1: index.html -->
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nafas Hisoblagich</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
    body{background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);color:#fff}
    .container{max-width:1100px;margin:auto;padding:20px}
    header{display:flex;justify-content:space-between;align-items:center;padding:20px 0}
    header h1{font-weight:600}
    .hero{display:flex;flex-wrap:wrap;align-items:center;gap:40px;margin-top:40px}
    .hero-text{flex:1}
    .hero-text h2{font-size:40px;margin-bottom:20px}
    .hero-text p{opacity:.8;line-height:1.6}
    .form-box{flex:1;background:rgba(255,255,255,0.05);padding:30px;border-radius:20px;backdrop-filter:blur(10px);box-shadow:0 10px 30px rgba(0,0,0,.3)}
    .form-box h3{margin-bottom:20px}
    .input-group{margin-bottom:15px}
    .input-group label{display:block;margin-bottom:5px;font-size:14px}
    .input-group input{width:100%;padding:12px;border:none;border-radius:10px;outline:none}
    button{width:100%;padding:14px;border:none;border-radius:10px;background:#00c6ff;background:linear-gradient(90deg,#00c6ff,#0072ff);color:#fff;font-weight:600;cursor:pointer;transition:.3s}
    button:hover{opacity:.8}
    .features{margin-top:60px;display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px}
    .card{background:rgba(255,255,255,0.05);padding:20px;border-radius:15px;text-align:center}
    .card i{font-size:40px;margin-bottom:10px}
    footer{text-align:center;margin-top:50px;opacity:.6}
    @media(max-width:768px){
      .hero-text h2{font-size:28px}
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Nafas Counter</h1>
    </header>

    <section class="hero">
      <div class="hero-text">
        <h2>Siz hayotingiz davomida nechta nafas oldingiz?</h2>
        <p>Bu loyiha faqat matematik hisob-kitoblarga asoslangan holda ishlaydi. Sizning tug'ilgan sanangizdan boshlab hozirgi vaqtgacha bo'lgan taxminiy nafas olish sonini aniqlaydi.</p>
      </div>

      <div class="form-box">
        <h3>Hisoblash</h3>
        <?php if(!empty($_SESSION["err"])): ?>
            <h4 style="color:red"  ><?= $_SESSION["err"]; ?></h4>
            <?php
             unset($_SESSION["err"]); 
             endif?>
        <form action="respons.php" method="POST" >
          <div class="input-group">
            <label>F.I.Sh</label>
            <input name="name" type="text" placeholder="Ismingizni kiriting" required>
          </div>
          <div class="input-group">
            <label>Tug'ilgan sana</label>
            <input name="b_date" type="date" required>
          </div>
          <button type="submit">Hisoblash</button>
        </form>
      </div>
    </section>

    <section class="features">
      <div class="card">
        <i>📊</i>
        <h4>Aniq hisoblash</h4>
        <p>Matematik formulalar asosida ishlaydi</p>
      </div>
      <div class="card">
        <i>⚡</i>
        <h4>Tezkor</h4>
        <p>Natijani bir zumda ko'rsatadi</p>
      </div>
      <div class="card">
        <i>🎯</i>
        <h4>Qiziqarli</h4>
        <p>Hayotingiz haqida yangi faktlarni bilib oling</p>
      </div>
    </section>

    <footer>
      <p>© 2026 Nafas Counter</p>
    </footer>
  </div>
</body>
</html>

