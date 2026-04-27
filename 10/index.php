<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Students Form</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f5f4f0;
      padding: 2rem 1rem;
      font-family: 'DM Sans', sans-serif;
    }

    .sf-card {
      background: #ffffff;
      border: 0.5px solid rgba(0,0,0,0.12);
      border-radius: 20px;
      padding: 2.5rem 2.25rem 2rem;
      max-width: 480px;
      width: 100%;
      position: relative;
      overflow: hidden;
    }

    .sf-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #534AB7, #1D9E75, #D85A30);
    }

    .sf-accent {
      position: absolute;
      top: -30px;
      right: -30px;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: #f5f4f0;
      opacity: 0.6;
    }

    .sf-accent2 {
      position: absolute;
      bottom: -20px;
      left: -20px;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #f5f4f0;
      opacity: 0.4;
    }

    .sf-inner {
      position: relative;
    }

    .sf-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #EEEDFE;
      color: #3C3489;
      font-size: 11px;
      font-weight: 500;
      padding: 4px 10px;
      border-radius: 20px;
      margin-bottom: 1rem;
      letter-spacing: 0.5px;
    }

    .sf-badge-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #534AB7;
    }

    .sf-title {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 0.25rem;
      line-height: 1.2;
    }

    .sf-sub {
      font-size: 13px;
      color: #888;
      margin-bottom: 1.75rem;
      font-weight: 300;
    }

    .sf-group {
      margin-bottom: 1.25rem;
    }

    .sf-label {
      display: block;
      font-size: 11px;
      font-weight: 500;
      color: #888;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 6px;
    }

    .sf-input-wrap {
      position: relative;
    }

    .sf-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      pointer-events: none;
    }

    .sf-input {
      width: 100%;
      background: #f8f7f4;
      border: 0.5px solid rgba(0,0,0,0.1);
      border-radius: 10px;
      padding: 11px 14px 11px 42px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 400;
      color: #1a1a1a;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .sf-input:focus {
      border-color: #7F77DD;
      box-shadow: 0 0 0 3px rgba(127, 119, 221, 0.12);
      background: #ffffff;
    }

    .sf-input::placeholder {
      color: #bbb;
      font-weight: 300;
    }

    .sf-divider {
      border: none;
      border-top: 0.5px solid rgba(0,0,0,0.08);
      margin: 1.5rem 0 1.25rem;
    }

    .sf-btn {
      width: 100%;
      padding: 13px;
      border: none;
      border-radius: 12px;
      background: #534AB7;
      color: #EEEDFE;
      font-family: 'DM Sans', sans-serif;
      font-size: 15px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: background 0.2s, transform 0.1s;
      letter-spacing: 0.2px;
    }

    .sf-btn:hover {
      background: #3C3489;
    }

    .sf-btn:active {
      transform: scale(0.98);
    }

    .sf-footer {
      text-align: center;
      margin-top: 1rem;
      font-size: 12px;
      color: #bbb;
    }
  </style>
</head>
<body>

  <div class="sf-card">
    <div class="sf-accent"></div>
    <div class="sf-accent2"></div>
    <div class="sf-inner">

      <div class="sf-badge">
        <div class="sf-badge-dot"></div>
        Students table
      </div>

      <h1 class="sf-title">Add new student</h1>
      <p class="sf-sub">Fill in the details below to add a student record</p>
        <form action="create.php" method="POST" >

      <div class="sf-group">
        <label class="sf-label">Full name</label>
        <div class="sf-input-wrap">
          <span class="sf-icon">👤</span>
          <input name="name" required class="sf-input" type="text" placeholder="e.g. Amir Karimov" />
        </div>
      </div>

      <div class="sf-group">
        <label class="sf-label">Email address</label>
        <div class="sf-input-wrap">
          <span class="sf-icon">✉️</span>
          <input name="email" class="sf-input" type="email" placeholder="student@example.com" />
        </div>
      </div>

      <div class="sf-group">
        <label class="sf-label">Age</label>
        <div class="sf-input-wrap">
          <span class="sf-icon">🎂</span>
          <input name="eage" class="sf-input" type="number" placeholder="18" />
        </div>
      </div>

      <hr class="sf-divider" />

      <button class="sf-btn">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M8 3v10M3 8h10" stroke="#EEEDFE" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        Add to Students Table
      </button>

        </form>
      <p class="sf-footer">All fields are required to submit</p>

    </div>
  </div>

</body>
</html>