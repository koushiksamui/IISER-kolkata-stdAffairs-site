<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMC Information — Students' Affairs Office, IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/smc-info.css">
  <link rel="stylesheet" href="../css/hostel-management.css">
</head>

<body>

  <a href="#main" class="skip-link">Skip to main content</a>

  <?php include __DIR__ . '/../components/navbar.php'; ?>

  <div id="mobile-drawer-placeholder"></div>

  <main id="main">

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero page-hero-banner">
      <div class="container page-hero-inner">
        <?php
        $breadcrumbs = [
          ['title' => 'Home', 'url' => '../index.html'],
          ['title' => 'Services', 'url' => '../index.html#services'],
          ['title' => 'SMC Information']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">SMC Information</h1>
        <p class="lede hero-subtitle">Students' Monitored Canteen — A unique, student-monitored, non-profit dining facility at IISER Kolkata.</p>

        <div class="hero-cta" style="margin-top: 1rem;">
          <a href="https://studentmess.iiserkol.ac.in" target="_blank" class="btn btn-gold"><i class="fa-solid fa-credit-card"></i> Recharge Account</a>
          <a onclick="document.getElementById('facilities').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(document.querySelectorAll('#smcSidebar .tab-btn')[2]);" style="cursor: pointer;" class="btn btn-outline"><i class="fa-solid fa-utensils"></i> Dining Facilities</a>
        </div>
      </div>
    </section>

    <!-- ============ SMC SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="smcSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" onclick="document.getElementById('overview').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-circle-info"></i> Overview</button>
          <button class="tab-btn" onclick="document.getElementById('core-features').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-star"></i> Core Features</button>
          <button class="tab-btn" onclick="document.getElementById('recharge').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-money-bill-wave"></i> Activation &amp; Recharge</button>
          <button class="tab-btn" onclick="document.getElementById('facilities').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-utensils"></i> Campus Dining</button>
          <button class="tab-btn" onclick="document.getElementById('escalation').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-headset"></i> Escalation Matrix</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- SMC Image Carousel -->
          <div class="hostel-carousel">
            <img src="../images/Food court and canteen/0416_D.JPG" class="carousel-img active" alt="SMC View 1" loading="lazy">
            <img src="../images/Food court and canteen/0421_D.JPG" class="carousel-img" alt="SMC View 1" loading="lazy">
            <img src="../images/Food court and canteen/0456_D.JPG" class="carousel-img" alt="SMC View 1" loading="lazy">
          </div>

          <!-- ============ OVERVIEW ============ -->
          <div class="content-box" id="overview" style="scroll-margin-top: 100px;">
            <h2>Introduction to SMC</h2>
            <p>The <strong>Students' Monitored Canteen (SMC)</strong> is the official dining system of IISER Kolkata. It is a unique, student-monitored, non-profit dining facility designed to provide affordable and high-quality meals to the student community.</p>
            <p>The SMC is entirely managed by elected student representatives in coordination with the institute administration, ensuring transparency, regular quality checks, and menus that cater to diverse dietary preferences.</p>
          </div>

          <!-- ============ CORE FEATURES ============ -->
          <div class="content-box" id="core-features" style="scroll-margin-top: 100px;">
            <h2>How the SMC works</h2>
            <p>The Students' Monitored Canteen takes pride in being a system unique to IISER Kolkata, providing a highly flexible and affordable dining experience.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-wallet" style="margin-right: 8px;"></i>Prepaid Wallet System:</strong> SMC operates on a cashless prepaid model linked directly to your Institute ID Card. Simply tap your ID to pay for meals. No cash handling required.</p>

              <p><strong><i class="fa-solid fa-pizza-slice" style="margin-right: 8px;"></i>Pay-As-You-Eat Model:</strong> You are charged only for the food you actually consume. There is no compulsory fixed monthly deduction. If you skip a meal, no money is deducted!</p>

              <p><strong><i class="fa-solid fa-tags" style="margin-right: 8px;"></i>Non-Profit Student Pricing:</strong> Students receive access to non-profit rates, ensuring affordable meals. (Note: Outsiders must pay higher rates using cash or debit/credit cards).</p>
            </div>
          </div>

          <!-- ============ RECHARGE & ACTIVATION ============ -->
          <div class="content-box" id="recharge" style="scroll-margin-top: 100px;">
            <h2>Account Activation &amp; Recharge</h2>
            <p>Before you can enjoy SMC's student rates, you need to activate and fund your mess account.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-power-off" style="margin-right: 8px;"></i>1. Account Activation:</strong> After completing institute registration and receiving your Wi-Fi User ID and Password, visit the Students' Monitored Canteen with your Institute ID card to activate your mess account.</p>

              <p><strong><i class="fa-solid fa-money-bill-wave" style="margin-right: 8px;"></i>2. Initial Recharge:</strong> We recommend an initial recharge of <strong>₹1000–₹2500</strong>. You can pay via ATM Card, Debit Card, or Credit Card. Once activated, you can add funds whenever needed.</p>

              <p><strong><i class="fa-solid fa-laptop" style="margin-right: 8px;"></i>3. Online Management:</strong> Recharge your wallet online at anytime via <a href="https://studentmess.iiserkol.ac.in" target="_blank" style="color: blue;">studentmess.iiserkol.ac.in</a>. Keep an eye on your balance!</p>

              <p><strong><i class="fa-solid fa-triangle-exclamation" style="margin-right: 8px;"></i>4. Minimum Balance Policy:</strong> If your available balance falls below <strong>₹50</strong>, your mess account will be temporarily blocked. You must recharge the account before you can continue using SMC services. Until you receive your ID card, you can pay directly at the cash counter.</p>
            </div>
          </div>

          <!-- ============ OTHER DINING FACILITIES ============ -->
          <div class="content-box" id="facilities" style="scroll-margin-top: 100px;">
            <h2>Campus Dining Options</h2>
            <p>IISER Kolkata provides a wide range of dining options integrated with your hostel life to cater to all tastes and timings.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-utensils" style="margin-right: 8px;"></i>Main SMC:</strong> The primary dining facility serving students with non-profit, high-quality daily meals.</p>

              <p><strong><i class="fa-solid fa-moon" style="margin-right: 8px;"></i>Night Canteen:</strong> Located at Nivedita Hall, the night canteen serves snacks and meals late into the night for those studying late.</p>

              <p><strong><i class="fa-solid fa-mug-hot" style="margin-right: 8px;"></i>Food Court &amp; Cafés:</strong> Explore the Food Court near the Lecture Hall Complex for breakfast, lunch, and snacks, or visit the two cafés located inside the RC/TRC.</p>

              <p><strong><i class="fa-solid fa-store" style="margin-right: 8px;"></i>Basement Shops:</strong> The canteen basement offers a variety of stores selling cakes, cold drinks, daily essentials, and educational materials.</p>

              <p><strong><i class="fa-solid fa-cookie-bite" style="margin-right: 8px;"></i>Vending Machines:</strong> Smart vending machines are installed across the hostels, SAC Building, and RC for instant snacks and beverages 24/7.</p>
            </div>
          </div>

          <!-- ============ ADMINISTRATION & ESCALATION ============ -->
          <div class="content-box" id="escalation" style="scroll-margin-top: 100px;">
            <h2>Administration &amp; Escalation Matrix</h2>
            <p>For any issues concerning food quality, hygiene, health, or mess services, please follow this escalation path.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong>Step 1 - Students' Mess Committee &amp; SAC GS:</strong> Your first point of contact for day-to-day dining concerns, food quality, and hygiene.</p>

              <p><strong>Step 2 - Mess Managers:</strong> Contact the respective Mess Manager for unresolved operational issues within a specific hall.</p>

              <p><strong>Step 3 - Assistant Warden (Mess):</strong> Dr. Debananda Roy oversees maintenance and mess operations at the warden level.</p>

              <p><strong>Step 4 - Warden &amp; Chief Warden:</strong> For severe or completely unresolved issues, escalate to the Warden and finally the Chief Warden.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <script>
      function updateActive(btn) {
        document.querySelectorAll('#smcSidebar .tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      }

      /* ================= CAROUSEL LOGIC ================= */
      const carouselImgs = document.querySelectorAll('.carousel-img');
      if (carouselImgs.length > 1) {
        let currentImgIndex = 0;
        setInterval(() => {
          carouselImgs[currentImgIndex].classList.remove('active');
          currentImgIndex = (currentImgIndex + 1) % carouselImgs.length;
          carouselImgs[currentImgIndex].classList.add('active');
        }, 4000);
      }
    </script>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
    scrim.addEventListener('click', shutDrawer);

    // No additional scripts required for this page
  </script>
  <script src="../layout/include.js"></script>

</body>

</html>