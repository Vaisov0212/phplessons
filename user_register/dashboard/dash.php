<?php
session_start();
require("../connect.php");

if(empty($_SESSION["user_id"])){
    header("Location:../login.php");
    exit;
}
else{
    $id=$_SESSION["user_id"];
    $sql="SELECT * FROM users WHERE id=$id";
    $user=$conn->query($sql)->fetch_assoc();
    // var_dump($user);


}


?>

<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --ink:      #0f0e0d;
      --cream:    #f5f0e8;
      --sidebar:  #131210;
      --gold:     #c8a96e;
      --gold-dk:  #a07840;
      --gold-lt:  #e8d5b0;
      --muted:    #8a7f70;
      --line:     rgba(200,169,110,0.22);
      --card-bg:  #ffffff;
      --body-bg:  #f0ebe0;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--body-bg);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
    }

    /* ===================== SIDEBAR ===================== */
    .sidebar {
      width: 240px;
      min-height: 100vh;
      background: var(--sidebar);
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      border-right: 1px solid rgba(200,169,110,0.15);
    }

    .sidebar-logo {
      padding: 2rem 1.6rem 1.4rem;
      border-bottom: 1px solid var(--line);
    }

    .logo-mark {
      display: flex;
      align-items: center;
      gap: .65rem;
    }

    .logo-icon {
      width: 34px; height: 34px;
      background: var(--gold);
      border-radius: 3px;
      display: flex; align-items: center; justify-content: center;
    }

    .logo-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      font-weight: 900;
      color: #fff;
      letter-spacing: -.01em;
    }

    .logo-name span { color: var(--gold); font-style: italic; }

    .sidebar-section {
      padding: 1.4rem 1rem .4rem;
    }

    .sidebar-section-label {
      font-size: .6rem;
      font-weight: 600;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: #4a453c;
      padding: 0 .6rem;
      margin-bottom: .5rem;
    }

    .nav-item-custom {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: .62rem .8rem;
      border-radius: 3px;
      color: #7a736a;
      font-size: .85rem;
      font-weight: 400;
      text-decoration: none;
      transition: background .18s, color .18s;
      margin-bottom: 2px;
      cursor: pointer;
    }

    .nav-item-custom:hover {
      background: rgba(200,169,110,0.1);
      color: var(--gold-lt);
    }

    .nav-item-custom.active {
      background: rgba(200,169,110,0.15);
      color: var(--gold);
      font-weight: 500;
    }

    .nav-item-custom.active .nav-icon { opacity: 1; }

    .nav-icon { opacity: .55; flex-shrink: 0; }
    .nav-item-custom:hover .nav-icon,
    .nav-item-custom.active .nav-icon { opacity: 1; }

    .nav-badge {
      margin-left: auto;
      background: var(--gold);
      color: var(--ink);
      font-size: .6rem;
      font-weight: 700;
      padding: .1rem .45rem;
      border-radius: 20px;
    }

    .sidebar-bottom {
      margin-top: auto;
      padding: 1.2rem 1rem;
      border-top: 1px solid var(--line);
    }

    .user-card {
      display: flex;
      align-items: center;
      gap: .7rem;
      padding: .5rem .6rem;
      border-radius: 3px;
    }

    .user-avatar {
      width: 34px; height: 34px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold-dk), var(--gold));
      display: flex; align-items: center; justify-content: center;
      font-family: 'Playfair Display', serif;
      font-weight: 900;
      font-size: .9rem;
      color: var(--ink);
      flex-shrink: 0;
    }

    .user-info .user-name {
      font-size: .82rem;
      font-weight: 500;
      color: #ccc;
      line-height: 1.2;
    }

    .user-info .user-role {
      font-size: .68rem;
      color: #555;
    }

    /* ===================== MAIN ===================== */
    .main-area {
      flex: 1;
      display: flex;
      flex-direction: column;
      min-width: 0;
    }

    /* ---- TOPBAR ---- */
    .topbar {
      background: #fff;
      border-bottom: 1px solid rgba(200,169,110,0.2);
      padding: .85rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 10;
      animation: fadeDown .5s ease both;
    }

    @keyframes fadeDown {
      from { opacity:0; transform: translateY(-12px); }
      to   { opacity:1; transform: translateY(0); }
    }

    .topbar-left .page-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem;
      font-weight: 900;
      color: var(--ink);
      letter-spacing: -.01em;
    }

    .topbar-left .breadcrumb-text {
      font-size: .72rem;
      color: var(--muted);
      margin-top: .1rem;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .topbar-date {
      font-size: .75rem;
      color: var(--muted);
      padding: .35rem .8rem;
      background: var(--body-bg);
      border-radius: 2px;
      border: 1px solid rgba(200,169,110,0.2);
    }

    .notif-btn {
      width: 36px; height: 36px;
      background: var(--body-bg);
      border: 1px solid rgba(200,169,110,0.2);
      border-radius: 3px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      position: relative;
      transition: border-color .2s;
    }
    .notif-btn:hover { border-color: var(--gold); }

    .notif-dot {
      position: absolute;
      top: 6px; right: 7px;
      width: 7px; height: 7px;
      background: var(--gold);
      border-radius: 50%;
      border: 1.5px solid #fff;
    }

    .topbar-avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--gold-dk), var(--gold));
      display: flex; align-items: center; justify-content: center;
      font-family: 'Playfair Display', serif;
      font-weight: 900;
      font-size: .85rem;
      color: var(--ink);
      border: 2px solid var(--gold);
      cursor: pointer;
    }

    /* ===================== CONTENT ===================== */
    .content {
      padding: 2rem;
      flex: 1;
    }

    /* ---- STATS CARDS ---- */
    .stats-row {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.2rem;
      margin-bottom: 1.8rem;
    }

    .stat-card {
      background: var(--card-bg);
      border-radius: 4px;
      padding: 1.4rem 1.4rem 1.2rem;
      border: 1px solid rgba(200,169,110,0.15);
      position: relative;
      overflow: hidden;
      animation: riseCard .55s ease both;
      transition: box-shadow .2s, transform .2s;
    }

    .stat-card:hover {
      box-shadow: 0 8px 28px rgba(0,0,0,0.08);
      transform: translateY(-2px);
    }

    .stat-card:nth-child(1) { animation-delay: .05s; }
    .stat-card:nth-child(2) { animation-delay: .12s; }
    .stat-card:nth-child(3) { animation-delay: .19s; }
    .stat-card:nth-child(4) { animation-delay: .26s; }

    @keyframes riseCard {
      from { opacity:0; transform: translateY(20px); }
      to   { opacity:1; transform: translateY(0); }
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--gold-dk), var(--gold));
      opacity: 0;
      transition: opacity .25s;
    }
    .stat-card:hover::before { opacity: 1; }

    .stat-icon-wrap {
      width: 40px; height: 40px;
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 1rem;
    }

    .ic-blue   { background: #eff6ff; color: #3b82f6; }
    .ic-green  { background: #f0fdf4; color: #22c55e; }
    .ic-amber  { background: #fffbeb; color: #f59e0b; }
    .ic-rose   { background: #fff1f2; color: #f43f5e; }

    .stat-value {
      font-family: 'Playfair Display', serif;
      font-size: 1.9rem;
      font-weight: 900;
      color: var(--ink);
      line-height: 1;
      margin-bottom: .3rem;
    }

    .stat-label {
      font-size: .75rem;
      color: var(--muted);
      font-weight: 400;
      text-transform: uppercase;
      letter-spacing: .08em;
    }

    .stat-change {
      display: inline-flex;
      align-items: center;
      gap: .2rem;
      font-size: .72rem;
      font-weight: 600;
      margin-top: .5rem;
      padding: .15rem .5rem;
      border-radius: 20px;
    }

    .stat-change.up   { background: #f0fdf4; color: #16a34a; }
    .stat-change.down { background: #fff1f2; color: #dc2626; }

    /* ---- MIDDLE ROW ---- */
    .mid-row {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 1.2rem;
      margin-bottom: 1.8rem;
    }

    /* ---- SECTION CARD ---- */
    .section-card {
      background: var(--card-bg);
      border-radius: 4px;
      border: 1px solid rgba(200,169,110,0.15);
      overflow: hidden;
      animation: riseCard .55s .3s ease both;
    }

    .section-head {
      padding: 1.2rem 1.4rem;
      border-bottom: 1px solid rgba(200,169,110,0.12);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      font-weight: 700;
      color: var(--ink);
    }

    .section-sub {
      font-size: .72rem;
      color: var(--muted);
      margin-top: .1rem;
    }

    .badge-gold {
      font-size: .68rem;
      font-weight: 600;
      letter-spacing: .08em;
      text-transform: uppercase;
      background: rgba(200,169,110,0.12);
      color: var(--gold-dk);
      padding: .25rem .7rem;
      border-radius: 20px;
      border: 1px solid rgba(200,169,110,0.25);
    }

    /* ---- CHART BARS (CSS only) ---- */
    .chart-area {
      padding: 1.4rem;
    }

    .bar-chart {
      display: flex;
      align-items: flex-end;
      gap: .6rem;
      height: 140px;
    }

    .bar-col {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: .4rem;
      height: 100%;
      justify-content: flex-end;
    }

    .bar-fill {
      width: 100%;
      border-radius: 3px 3px 0 0;
      background: linear-gradient(180deg, var(--gold) 0%, var(--gold-dk) 100%);
      opacity: .75;
      transition: opacity .2s;
      animation: growBar .7s ease both;
      transform-origin: bottom;
    }

    .bar-fill:hover { opacity: 1; }

    @keyframes growBar {
      from { transform: scaleY(0); }
      to   { transform: scaleY(1); }
    }

    .bar-col:nth-child(1) .bar-fill { height: 55%; animation-delay: .1s; }
    .bar-col:nth-child(2) .bar-fill { height: 72%; animation-delay: .15s; }
    .bar-col:nth-child(3) .bar-fill { height: 48%; animation-delay: .2s; }
    .bar-col:nth-child(4) .bar-fill { height: 88%; animation-delay: .25s; }
    .bar-col:nth-child(5) .bar-fill { height: 65%; animation-delay: .3s; }
    .bar-col:nth-child(6) .bar-fill { height: 78%; animation-delay: .35s; }
    .bar-col:nth-child(7) .bar-fill { height: 92%; animation-delay: .4s; background: linear-gradient(180deg, #f59e0b, #d97706); opacity: 1; }

    .bar-label {
      font-size: .65rem;
      color: var(--muted);
      text-align: center;
    }

    /* ---- ACTIVITY LIST ---- */
    .activity-list { padding: .4rem 0; }

    .activity-item {
      display: flex;
      align-items: flex-start;
      gap: .85rem;
      padding: .85rem 1.4rem;
      border-bottom: 1px solid rgba(200,169,110,0.08);
      transition: background .15s;
    }
    .activity-item:last-child { border-bottom: none; }
    .activity-item:hover { background: #fdfaf5; }

    .act-dot {
      width: 8px; height: 8px;
      border-radius: 50%;
      margin-top: .35rem;
      flex-shrink: 0;
    }

    .act-blue  { background: #3b82f6; }
    .act-green { background: #22c55e; }
    .act-amber { background: #f59e0b; }
    .act-rose  { background: #f43f5e; }

    .act-text {
      font-size: .82rem;
      color: var(--ink);
      line-height: 1.4;
    }

    .act-text strong { font-weight: 600; }

    .act-time {
      font-size: .7rem;
      color: var(--muted);
      margin-top: .2rem;
    }

    /* ---- TABLE ---- */
    .table-card {
      background: var(--card-bg);
      border-radius: 4px;
      border: 1px solid rgba(200,169,110,0.15);
      overflow: hidden;
      animation: riseCard .55s .4s ease both;
    }

    .custom-table {
      width: 100%;
      border-collapse: collapse;
      font-size: .82rem;
    }

    .custom-table thead tr {
      background: #fdfaf5;
      border-bottom: 1px solid rgba(200,169,110,0.15);
    }

    .custom-table th {
      padding: .85rem 1.2rem;
      font-size: .68rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--muted);
      text-align: left;
      white-space: nowrap;
    }

    .custom-table td {
      padding: .9rem 1.2rem;
      color: var(--ink);
      border-bottom: 1px solid rgba(200,169,110,0.07);
      vertical-align: middle;
    }

    .custom-table tbody tr:last-child td { border-bottom: none; }

    .custom-table tbody tr {
      transition: background .15s;
    }
    .custom-table tbody tr:hover { background: #fdfaf5; }

    .pill {
      display: inline-block;
      font-size: .68rem;
      font-weight: 600;
      padding: .18rem .6rem;
      border-radius: 20px;
      letter-spacing: .04em;
    }

    .pill-green  { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .pill-amber  { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
    .pill-blue   { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .pill-rose   { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }

    .table-avatar {
      width: 28px; height: 28px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center; justify-content: center;
      font-size: .7rem;
      font-weight: 700;
      color: var(--ink);
      margin-right: .5rem;
    }

    .av1 { background: #bfdbfe; }
    .av2 { background: #bbf7d0; }
    .av3 { background: #fde68a; }
    .av4 { background: #fecdd3; }
    .av5 { background: #ddd6fe; }

    /* ===================== RESPONSIVE ===================== */
    @media (max-width: 1100px) {
      .stats-row { grid-template-columns: repeat(2, 1fr); }
      .mid-row   { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
      .sidebar { display: none; }
      .stats-row { grid-template-columns: repeat(2, 1fr); }
      .content { padding: 1rem; }
      .topbar  { padding: .8rem 1rem; }
    }
  </style>
</head>
<body>

<!-- =================== SIDEBAR =================== -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-mark">
      <div class="logo-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0f0e0d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
        </svg>
      </div>
      <span class="logo-name">Au<span>rum</span></span>
    </div>
  </div>

  <div class="sidebar-section">
    <div class="sidebar-section-label">Asosiy</div>
    <a class="nav-item-custom active">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Dashboard
    </a>
    <a class="nav-item-custom">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
      Statistika
    </a>
    <a class="nav-item-custom">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      Buyurtmalar
      <span class="nav-badge">12</span>
    </a>
    <a class="nav-item-custom">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Foydalanuvchilar
    </a>
  </div>

  <div class="sidebar-section">
    <div class="sidebar-section-label">Boshqaruv</div>
    <a class="nav-item-custom">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      Hisobotlar
    </a>
    <a class="nav-item-custom">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
      Sozlamalar
    </a>
    <a class="nav-item-custom">
      <svg class="nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
      Xabarlar
      <span class="nav-badge">3</span>
    </a>
  </div>

  <div class="sidebar-bottom">
    <div class="user-card">
      <div class="user-avatar">A</div>
      <div class="user-info">
        <div class="user-name">Admin</div>
        <div class="user-role">Super Admin</div>
      </div>
    </div>
  </div>
</aside>

<!-- =================== MAIN =================== -->
<div class="main-area">

  <!-- TOPBAR -->
  <header class="topbar">
    <div class="topbar-left">
      <div class="page-title"><?= $user["full_name"] ?></div>
      <div class="breadcrumb-text">Bosh sahifa · Umumiy ko'rinish</div>
    </div>
    <div class="topbar-right">
      <div class="topbar-date">10 Mart, 2026</div>
      <div class="notif-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6b6355" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        <div class="notif-dot"></div>
      </div>
      <div > <a href="logout.php" class="btn btn-sm btn-warning" > logout </a> </div>
    </div>
  </header>

  <!-- CONTENT -->
  <main class="content">

    <!-- STATS -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon-wrap ic-blue">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="stat-value">2,840</div>
        <div class="stat-label">Jami foydalanuvchi</div>
        <div class="stat-change up">↑ 12.5% o'tgan oyga</div>
      </div>

      <div class="stat-card">
        <div class="stat-icon-wrap ic-green">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        </div>
        <div class="stat-value">1,294</div>
        <div class="stat-label">Buyurtmalar</div>
        <div class="stat-change up">↑ 8.1% o'tgan oyga</div>
      </div>

      <div class="stat-card">
        <div class="stat-icon-wrap ic-amber">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div class="stat-value">84.2M</div>
        <div class="stat-label">Daromad (so'm)</div>
        <div class="stat-change up">↑ 22.3% o'tgan oyga</div>
      </div>

      <div class="stat-card">
        <div class="stat-icon-wrap ic-rose">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <div class="stat-value">96.4%</div>
        <div class="stat-label">Faollik darajasi</div>
        <div class="stat-change down">↓ 1.2% o'tgan oyga</div>
      </div>
    </div>

    <!-- MIDDLE ROW -->
    <div class="mid-row">

      <!-- BAR CHART -->
      <div class="section-card">
        <div class="section-head">
          <div>
            <div class="section-title">Haftalik buyurtmalar</div>
            <div class="section-sub">Joriy hafta ko'rsatkichlari</div>
          </div>
          <span class="badge-gold">2026</span>
        </div>
        <div class="chart-area">
          <div class="bar-chart">
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Du</div></div>
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Se</div></div>
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Ch</div></div>
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Pa</div></div>
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Ju</div></div>
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Sh</div></div>
            <div class="bar-col"><div class="bar-fill"></div><div class="bar-label">Ya</div></div>
          </div>
        </div>

        <!-- progress bars -->
        <div style="padding: 0 1.4rem 1.4rem;">
          <div style="display:flex; justify-content:space-between; font-size:.72rem; color:var(--muted); margin-bottom:.4rem;">
            <span>Maqsad: 1,500 buyurtma</span><span>86%</span>
          </div>
          <div style="height:6px; background:#f0ebe0; border-radius:10px; overflow:hidden;">
            <div style="height:100%; width:86%; background:linear-gradient(90deg,var(--gold-dk),var(--gold)); border-radius:10px;"></div>
          </div>
        </div>
      </div>

      <!-- ACTIVITY -->
      <div class="section-card">
        <div class="section-head">
          <div>
            <div class="section-title">So'nggi faollik</div>
            <div class="section-sub">Oxirgi hodisalar</div>
          </div>
        </div>
        <div class="activity-list">
          <div class="activity-item">
            <div class="act-dot act-green"></div>
            <div>
              <div class="act-text"><strong>Alisher N.</strong> yangi buyurtma berdi</div>
              <div class="act-time">5 daqiqa oldin</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-dot act-blue"></div>
            <div>
              <div class="act-text"><strong>Malika R.</strong> ro'yxatdan o'tdi</div>
              <div class="act-time">18 daqiqa oldin</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-dot act-amber"></div>
            <div>
              <div class="act-text"><strong>#1284</strong> buyurtma kutilmoqda</div>
              <div class="act-time">42 daqiqa oldin</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-dot act-rose"></div>
            <div>
              <div class="act-text"><strong>Javlon K.</strong> buyurtmani bekor qildi</div>
              <div class="act-time">1 soat oldin</div>
            </div>
          </div>
          <div class="activity-item">
            <div class="act-dot act-green"></div>
            <div>
              <div class="act-text"><strong>#1281</strong> muvaffaqiyatli yetkazildi</div>
              <div class="act-time">2 soat oldin</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
      <div class="section-head">
        <div>
          <div class="section-title">So'nggi buyurtmalar</div>
          <div class="section-sub">Barcha faol buyurtmalar ro'yxati</div>
        </div>
        <span class="badge-gold">Hammasi ko'rish →</span>
      </div>
      <div style="overflow-x:auto;">
        <table class="custom-table">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Mijoz</th>
              <th>Mahsulot</th>
              <th>Miqdor</th>
              <th>Summa</th>
              <th>Status</th>
              <th>Sana</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="color:var(--muted); font-family:monospace;">#1294</td>
              <td><span class="table-avatar av1">AN</span>Alisher N.</td>
              <td>Noutbuk Pro X</td>
              <td>2 dona</td>
              <td><strong>4,800,000</strong> so'm</td>
              <td><span class="pill pill-green">Yetkazildi</span></td>
              <td style="color:var(--muted);">10 Mart</td>
            </tr>
            <tr>
              <td style="color:var(--muted); font-family:monospace;">#1293</td>
              <td><span class="table-avatar av2">MR</span>Malika R.</td>
              <td>Simsiz quloqchin</td>
              <td>1 dona</td>
              <td><strong>950,000</strong> so'm</td>
              <td><span class="pill pill-amber">Kutilmoqda</span></td>
              <td style="color:var(--muted);">10 Mart</td>
            </tr>
            <tr>
              <td style="color:var(--muted); font-family:monospace;">#1292</td>
              <td><span class="table-avatar av3">JK</span>Javlon K.</td>
              <td>Smartfon Z50</td>
              <td>1 dona</td>
              <td><strong>7,200,000</strong> so'm</td>
              <td><span class="pill pill-rose">Bekor qilindi</span></td>
              <td style="color:var(--muted);">9 Mart</td>
            </tr>
            <tr>
              <td style="color:var(--muted); font-family:monospace;">#1291</td>
              <td><span class="table-avatar av4">DY</span>Dilnoza Y.</td>
              <td>Planshet Mini</td>
              <td>3 dona</td>
              <td><strong>5,100,000</strong> so'm</td>
              <td><span class="pill pill-blue">Jo'natildi</span></td>
              <td style="color:var(--muted);">9 Mart</td>
            </tr>
            <tr>
              <td style="color:var(--muted); font-family:monospace;">#1290</td>
              <td><span class="table-avatar av5">BT</span>Bobur T.</td>
              <td>Monitor 27"</td>
              <td>1 dona</td>
              <td><strong>3,600,000</strong> so'm</td>
              <td><span class="pill pill-green">Yetkazildi</span></td>
              <td style="color:var(--muted);">8 Mart</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>
</div>

</body>
</html>