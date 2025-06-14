<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Holiday Booking - Loading</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
    }

    .container {
      background: white;
      border-radius: 20px;
      padding: 50px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 700px;
      width: 95%;
      position: relative;
    }

    .icon-container {
      width: 80px;
      height: 80px;
      margin: 0 auto 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .icon-container::before {
      content: '';
      position: absolute;
      width: 80px;
      height: 80px;
      border: 3px solid #e9ecef;
      border-top: 3px solid #4a90e2;
      border-radius: 50%;
      animation: rotate 1s linear infinite;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .icon {
      width: 50px;
      height: 50px;
      background: #ffa500;
      border-radius: 8px;
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 15px rgba(255, 165, 0, 0.3);
    }

    .icon::before {
      content: '✈️';
      font-size: 24px;
      animation: bounce 1.5s ease-in-out infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    .title {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    .progress-container {
      background: #e9ecef;
      border-radius: 25px;
      height: 24px; /* Ditinggikan */
      width: 100%;
      max-width: 100%;
      margin-bottom: 20px;
      overflow: hidden;
      position: relative;
    }

    .progress-bar {
      height: 100%;
      background: linear-gradient(90deg, #4a90e2, #7b68ee);
      border-radius: 25px;
      width: 0%;
      transition: width 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .progress-bar::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
      animation: slide 2s infinite;
      border-radius: 30px;
    }

    @keyframes slide {
      0% { left: -100%; }
      100% { left: 100%; }
    }

    .progress-text {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      font-size: 14px;
      font-weight: bold;
      color: white;
      white-space: nowrap;
      padding-right: 6px;
      pointer-events: none;
    }

    .status-text {
      font-size: 16px;
      color: #666;
      margin-bottom: 30px;
      opacity: 0;
      animation: fadeIn 0.5s ease-in-out 1s forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .features {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-top: 30px;
    }

    .feature {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      text-align: left;
      opacity: 0;
      animation: slideUp 0.6s ease-out forwards;
    }

    .feature:nth-child(1) { animation-delay: 1.5s; }
    .feature:nth-child(2) { animation-delay: 1.8s; }
    .feature:nth-child(3) { animation-delay: 2.1s; }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .feature-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .feature-icon.pound {
      background: rgba(76, 175, 80, 0.1);
      color: #4caf50;
    }

    .feature-icon.shield {
      background: rgba(33, 150, 243, 0.1);
      color: #2196f3;
    }

    .feature-icon.check {
      background: rgba(255, 152, 0, 0.1);
      color: #ff9800;
    }

    .feature-content h3 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 4px;
      color: #2c3e50;
    }

    .feature-content p {
      font-size: 14px;
      color: #666;
      line-height: 1.4;
    }

    .loading-dots {
      display: inline-flex;
      gap: 4px;
      margin-left: 8px;
    }

    .dot {
      width: 6px;
      height: 6px;
      background: #4a90e2;
      border-radius: 50%;
      animation: pulse 1.5s infinite;
    }

    .dot:nth-child(2) { animation-delay: 0.3s; }
    .dot:nth-child(3) { animation-delay: 0.6s; }

    @keyframes pulse {
      0%, 100% { opacity: 0.3; }
      50% { opacity: 1; }
    }

    @media (max-width: 480px) {
      .features {
        grid-template-columns: 1fr;
      }

      .container {
        padding: 40px 25px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon-container">
      <div class="icon"></div>
    </div>

    <h1 class="title">Looking for the best prices in the market</h1>

    <div class="progress-container">
      <div class="progress-bar" id="progressBar">
        <div class="progress-text" id="progressPercent">0%</div>
      </div>
    </div>

    <div class="status-text">
      Your holiday will be ready in less than 30 seconds
      <div class="loading-dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
    </div>

    <div class="features">
      <div class="feature">
        <div class="feature-icon pound">£</div>
        <div class="feature-content">
          <h3>Spread the cost</h3>
          <p>Deposits from £25pp and pay monthly options</p>
        </div>
      </div>

      <div class="feature">
        <div class="feature-icon shield">🛡️</div>
        <div class="feature-content">
          <h3>ATOL protected</h3>
          <p>Peace of mind on and before your holiday</p>
        </div>
      </div>

      <div class="feature">
        <div class="feature-icon check">✓</div>
        <div class="feature-content">
          <h3>Unbeatable prices</h3>
          <p>Get the best deals with our Best Price Promise</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    let progress = 0;
    const progressBar = document.getElementById('progressBar');
    const progressPercent = document.getElementById('progressPercent');

    function updateProgress() {
      if (progress <= 100) {
        const roundedProgress = Math.min(99, Math.round(progress));
        progressBar.style.width = progress + '%';
        progressPercent.textContent = roundedProgress + '%';

        const barWidth = progressBar.offsetWidth;
        progressPercent.style.left = (barWidth - 40) + 'px';

        if (progress < 30) {
          progress += Math.random() * 3 + 1;
        } else if (progress < 60) {
          progress += Math.random() * 2 + 0.5;
        } else if (progress < 90) {
          progress += Math.random() * 1 + 0.3;
        } else {
          progress += Math.random() * 0.5 + 0.1;
        }

        setTimeout(updateProgress, Math.random() * 200 + 100);
      } else {
        progressPercent.textContent = '100%';
        progressBar.style.width = '100%';
        progressPercent.style.left = 'calc(100% - 40px)';

        setTimeout(() => {
          progress = 0;
          updateProgress();
        }, 2000);
      }
    }

    setTimeout(updateProgress, 500);

    window.addEventListener('resize', () => {
      const barWidth = progressBar.offsetWidth;
      progressPercent.style.left = (barWidth - 40) + 'px';
    });
  </script>
</body>
</html>
