
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kirish</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --ink:     #0f0e0d;
      --cream:   #f5f0e8;
      --gold:    #c8a96e;
      --gold-dk: #a07840;
      --line:    rgba(200,169,110,0.35);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      min-height: 100vh;
      background-color: var(--ink);
      background-image:
        radial-gradient(ellipse 80% 60% at 50% -10%, rgba(200,169,110,0.18) 0%, transparent 70%),
        url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c8a96e' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'DM Sans', sans-serif;
      padding: 2rem 1rem;
    }

    /* ---- CARD ---- */
    .login-card {
      width: 100%;
      max-width: 440px;
      background: var(--cream);
      border-radius: 4px;
      overflow: hidden;
      position: relative;
      box-shadow:
        0 0 0 1px var(--gold),
        0 32px 80px rgba(0,0,0,0.6),
        0 8px 24px rgba(200,169,110,0.12);
      animation: riseUp .7s cubic-bezier(.22,1,.36,1) both;
    }

    @keyframes riseUp {
      from { opacity: 0; transform: translateY(40px) scale(0.97); }
      to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .card-bar {
      height: 5px;
      background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-dk));
    }

    /* ---- HEADER ---- */
    .card-header-area {
      padding: 2.5rem 2.5rem 1.5rem;
      border-bottom: 1px solid var(--line);
    }

    .card-eyebrow {
      font-size: .68rem;
      font-weight: 500;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: .6rem;
    }

    .card-title {
      font-family: 'Playfair Display', serif;
      font-size: 2.1rem;
      font-weight: 900;
      color: var(--ink);
      line-height: 1.1;
      letter-spacing: -.02em;
    }

    .card-title span {
      color: var(--gold-dk);
      font-style: italic;
    }

    /* ---- LOCK ICON ---- */
    .lock-wrap {
      display: flex;
      align-items: center;
      gap: .75rem;
      margin-top: 1rem;
    }

    .lock-circle {
      width: 40px; height: 40px;
      background: var(--ink);
      border: 1.5px solid var(--gold);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }

    .lock-text {
      font-size: .78rem;
      color: #8a7f70;
      line-height: 1.4;
    }

    /* ---- FORM BODY ---- */
    .card-body-area {
      padding: 2rem 2.5rem 2.5rem;
    }

    .form-group {
      margin-bottom: 1.4rem;
      position: relative;
      animation: fadeSlide .5s ease both;
    }
    .form-group:nth-child(1) { animation-delay: .1s; }
    .form-group:nth-child(2) { animation-delay: .2s; }

    @keyframes fadeSlide {
      from { opacity:0; transform: translateX(-12px); }
      to   { opacity:1; transform: translateX(0); }
    }

    .form-label {
      display: block;
      font-size: .72rem;
      font-weight: 500;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: #6b6355;
      margin-bottom: .45rem;
    }

    .input-wrap { position: relative; }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      width: 18px; height: 18px;
      color: var(--gold-dk);
      pointer-events: none;
      opacity: .8;
    }

    .form-control {
      width: 100%;
      height: 50px;
      padding: 0 1rem 0 2.8rem;
      border: 1.5px solid rgba(200,169,110,0.4);
      border-radius: 3px;
      background: #fff;
      font-family: 'DM Sans', sans-serif;
      font-size: .92rem;
      color: var(--ink);
      outline: none;
      transition: border-color .22s, box-shadow .22s, background .22s;
    }

    .form-control::placeholder { color: #b8ae9e; }

    .form-control:focus {
      border-color: var(--gold);
      background: #fffdf9;
      box-shadow: 0 0 0 3px rgba(200,169,110,0.15);
    }

    /* error state */
    .form-control.is-error {
      border-color: #c0392b;
      box-shadow: 0 0 0 3px rgba(192,57,43,0.12);
    }

    .toggle-pass {
      position: absolute;
      right: 1rem; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      cursor: pointer; color: #a09080;
      padding: 0; line-height: 1;
      transition: color .2s;
    }
    .toggle-pass:hover { color: var(--gold-dk); }

    /* ---- REMEMBER + FORGOT ---- */
    .form-extras {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.6rem;
      animation: fadeSlide .5s .28s ease both;
    }

    .remember-label {
      display: flex;
      align-items: center;
      gap: .5rem;
      cursor: pointer;
      font-size: .82rem;
      color: #6b6355;
      user-select: none;
    }

    .remember-box {
      width: 16px; height: 16px;
      border: 1.5px solid rgba(200,169,110,0.6);
      border-radius: 2px;
      background: #fff;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      cursor: pointer;
      transition: background .2s, border-color .2s;
    }

    #rememberMe:checked + .remember-label .remember-box {
      background: var(--gold-dk);
      border-color: var(--gold-dk);
    }

    #rememberMe { display: none; }

    .check-icon { display: none; }
    #rememberMe:checked + .remember-label .check-icon { display: block; }

    .forgot-link {
      font-size: .82rem;
      color: var(--gold-dk);
      text-decoration: none;
      font-weight: 500;
      transition: color .2s;
    }
    .forgot-link:hover { color: var(--gold); text-decoration: underline; }

    /* ---- BUTTON ---- */
    .btn-login {
      display: block;
      width: 100%;
      height: 52px;
      background: linear-gradient(135deg, var(--ink) 0%, #2a2620 100%);
      border: 1.5px solid var(--gold);
      border-radius: 3px;
      font-family: 'DM Sans', sans-serif;
      font-size: .8rem;
      font-weight: 500;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--gold);
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: box-shadow .25s, transform .18s;
      animation: fadeSlide .5s .36s ease both;
    }

    .btn-login::before {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, var(--gold-dk), var(--gold));
      opacity: 0;
      transition: opacity .28s;
    }

    .btn-login:hover {
      box-shadow: 0 8px 28px rgba(200,169,110,0.3);
      transform: translateY(-1px);
    }
    .btn-login:hover::before { opacity: 1; }
    .btn-login:active { transform: translateY(0); }

    .btn-login .btn-text {
      position: relative; z-index: 1;
      display: flex; align-items: center;
      justify-content: center; gap: .6rem;
      transition: color .28s;
    }
    .btn-login:hover .btn-text { color: var(--ink); }

    /* loading spinner (shown on click) */
    .spinner {
      width: 16px; height: 16px;
      border: 2px solid currentColor;
      border-top-color: transparent;
      border-radius: 50%;
      display: none;
      animation: spin .7s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    .btn-login.loading .btn-label { display: none; }
    .btn-login.loading .spinner   { display: block; }

    /* ---- ALERT ---- */
    .alert-box {
      display: none;
      margin-top: 1rem;
      padding: .75rem 1rem;
      border-radius: 3px;
      font-size: .82rem;
      border: 1px solid;
      animation: fadeSlide .3s ease both;
    }
    .alert-box.error {
      display: flex; align-items: center; gap: .5rem;
      background: #fdf2f2;
      border-color: #e8c4c0;
      color: #922;
    }
    .alert-box.success {
      display: flex; align-items: center; gap: .5rem;
      background: #f2fdf5;
      border-color: #b8dfc4;
      color: #2a6640;
    }

    /* ---- DIVIDER ---- */
    .divider {
      display: flex; align-items: center; gap: 1rem;
      margin: 1.5rem 0;
      animation: fadeSlide .5s .44s ease both;
    }
    .divider::before, .divider::after {
      content: ''; flex: 1;
      height: 1px;
      background: var(--line);
    }
    .divider span {
      font-size: .7rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: #a09080;
    }

    /* ---- FOOTER ---- */
    .card-foot {
      text-align: center;
      font-size: .82rem;
      color: #8a7f70;
      animation: fadeSlide .5s .5s ease both;
    }
    .card-foot a {
      color: var(--gold-dk);
      text-decoration: none;
      font-weight: 500;
    }
    .card-foot a:hover { text-decoration: underline; }

    /* corners */
    .corner {
      position: absolute;
      width: 36px; height: 36px;
      border-color: var(--gold);
      border-style: solid;
      opacity: .45;
    }
    .corner-tl { top:14px; left:14px; border-width: 1px 0 0 1px; }
    .corner-tr { top:14px; right:14px; border-width: 1px 1px 0 0; }
    .corner-bl { bottom:14px; left:14px; border-width: 0 0 1px 1px; }
    .corner-br { bottom:14px; right:14px; border-width: 0 1px 1px 0; }
  </style>
</head>
<body>

<div class="login-card">
  <div class="card-bar"></div>

  <div class="corner corner-tl"></div>
  <div class="corner corner-tr"></div>
  <div class="corner corner-bl"></div>
  <div class="corner corner-br"></div>

  <!-- HEADER -->
  <div class="card-header-area">
    <p class="card-eyebrow">Xush kelibsiz</p>
    <h1 class="card-title">Hisobga<br><span>kirish</span></h1>

    <div class="lock-wrap">
      <div class="lock-circle">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c8a96e" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2"/>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
      </div>
        <div>
            <ul>
                <?php 
                if(isset($_SESSION["login_errors"])){
                    $errors=$_SESSION["login_errors"];
                    foreach($errors as $error){
                        echo "<li style='color:red' >".$error."</li> <br>";
                    }
                    unset($_SESSION["login_errors"]);
                } ?>
            </ul>
        </div>
    </div>
  </div>

  <!-- FORM -->
  <div class="card-body-area">

    <form action="verfication.php" method="POST" >
        <!-- Login input -->
    <div class="form-group">
      <label class="form-label" for="login">Login</label>
      <div class="input-wrap">
        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <input name="login" type="text" class="form-control" id="login" placeholder="foydalanuvchi_nomi" autocomplete="username">
      </div>
    </div>

    <!-- Password input -->
    <div class="form-group">
      <label class="form-label" for="password">Parol</label>
      <div class="input-wrap">
        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2"/>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        <input name="password" type="password" class="form-control" id="password" placeholder="••••••••" autocomplete="current-password">
        <button class="toggle-pass" type="button" aria-label="Parolni ko'rsatish" onclick="
          var i=document.getElementById('password');
          i.type = i.type==='password' ? 'text' : 'password';
          this.querySelector('.eye-off').style.display = i.type==='text' ? 'none' : 'block';
          this.querySelector('.eye-on').style.display  = i.type==='text' ? 'block' : 'none';
        ">
          <svg class="eye-off" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
          </svg>
          <svg class="eye-on" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </button>
      </div>
    </div>

    <!-- Remember + Forgot -->
    <div class="form-extras">
      <input type="checkbox" id="rememberMe">
      <label for="rememberMe" class="remember-label">
        <div class="remember-box">
          <svg class="check-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="1.5 5 4 7.5 8.5 2.5"/>
          </svg>
        </div>
        Meni eslab qol
      </label>
      <a href="#" class="forgot-link">Parolni unutdingizmi?</a>
    </div>

    <!-- Alert box -->
    <div class="alert-box" id="alertBox">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <span id="alertMsg"></span>
    </div>

    <!-- Submit button -->
    <button class="btn-login" type="submit" id="loginBtn" >
      <div class="btn-text">
        <span class="btn-label">Kirish</span>
        <div class="spinner"></div>
      </div>
    </button>

    <div class="divider"><span>yoki</span></div>

    <div class="card-foot">
      Hisobingiz yo'qmi? <a href="create.php">Ro'yxatdan o'tish</a>
    </div>
    </form>
  </div>
</div>


</body>
</html>