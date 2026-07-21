<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MCWC — Students' Affairs Office, IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
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
          ['title' => 'Facilities', 'url' => '#'],
          ['title' => 'MCWC']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Mind Care and Wellness Centre (MCWC)</h1>
        <p class="lede hero-subtitle">Dedicated to student welfare, providing emotional, academic, and financial support.</p>
      </div>
    </section>

    <!-- ============ SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="mcwcSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" style="white-space: nowrap;" onclick="document.getElementById('about-mcwc').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-brain"></i> About MCWC</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('online-support').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-laptop-medical"></i> Online Support</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('counselling-section').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-users"></i> Counselling Section</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('guidance').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-hands-holding-child"></i> Support &amp; Guidance</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- ============ ABOUT MCWC ============ -->
          <div class="content-box" id="about-mcwc" style="scroll-margin-top: 100px;">
            <h2>About MCWC</h2>
            <p>The Mind Care and Wellness Centre (MCWC) is dedicated to student welfare and provides emotional, academic, and financial support. It also works to sensitize the campus community on important student-related issues.</p>
            
            <p>Details are available at the official website: <a href="http://www.iiserkol.ac.in/~mcwc/index.html" target="_blank" style="color: blue; text-decoration: underline;">MCWC Official Website</a></p>

            <h3 style="margin-top: var(--space-4);">Psychiatrist Consultation</h3>
            <p>The Institute has a visiting psychiatrist who is available for consultation at the <strong>Medical Unit</strong>.</p>
            
            <table class="matrix-table">
              <thead>
                <tr>
                  <th>Days</th>
                  <th>Timings</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Every Wednesday and Saturday</td>
                  <td><strong>5:00 PM to 7:00 PM</strong></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- ============ ONLINE SUPPORT ============ -->
          <div class="content-box" id="online-support" style="scroll-margin-top: 100px;">
            <h2>YourDOST (Online Support)</h2>
            <p>IISER Kolkata has signed an MoU with <strong>YourDOST</strong>, an online chat-based counselling and emotional wellness platform.</p>
            <p>It provides a convenient, anonymous, and confidential way for students and the campus community to access emotional support from professional experts.</p>
            
            <div style="margin-top: 1rem;">
              <a href="https://yourdost.com" target="_blank" class="btn btn-gold"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit YourDOST Website</a>
            </div>
          </div>

          <!-- ============ COUNSELLING SECTION ============ -->
          <div class="content-box" id="counselling-section" style="scroll-margin-top: 100px;">
            <h2>Counselling Section</h2>
            <p>You can directly reach out to the counseling team for appointments and support:</p>

            <div style="overflow-x:auto;">
              <table class="matrix-table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Email ID</th>
                    <th>Contact No.</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Prof. Anuradha Bhatt</strong></td>
                    <td>Dean, Wellness and Welfare and Chair, MCWC</td>
                    <td><a href="mailto:anuradhabhat@iiserkol.ac.in">anuradhabhat@iiserkol.ac.in</a></td>
                    <td>9748723613</td>
                  </tr>
                  <tr>
                    <td><strong>Dr. Pratanu Saha</strong></td>
                    <td>Psychiatrist</td>
                    <td><a href="mailto:spratanu@gmail.com">spratanu@gmail.com</a></td>
                    <td>9433730959</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Anirban Gupta</strong></td>
                    <td>Male Counselor</td>
                    <td><a href="mailto:anirbangupta220791@iiserkol.ac.in">anirbangupta220791@iiserkol.ac.in</a></td>
                    <td>6290315575</td>
                  </tr>
                  <tr>
                    <td><strong>Ms. Muskan Hossain</strong></td>
                    <td>Female Counselor</td>
                    <td><a href="mailto:muskan@iiserkol.ac.in">muskan@iiserkol.ac.in</a></td>
                    <td>9242103926</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <!-- ============ SUPPORT & GUIDANCE ============ -->
          <div class="content-box" id="guidance" style="scroll-margin-top: 100px;">
            <h2>Reach Out for Help</h2>
            <p>Feel free to reach out to your batchmates, senior students, SAC representatives, faculty members, instructors, or the Students’ Affairs Section whenever you need help or guidance. You may also directly approach the Counsellors or the visiting Psychiatrist whenever required. <strong>You are never alone!</strong></p>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <!-- scroll spy is automatically handled by include.js -->
  <script src="../layout/include.js"></script>

</body>

</html>
