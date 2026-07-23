<?php
$BASE_URL = '../';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAC — Students' Affairs Office, IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/hostel-management.css">
  <style>
    /* Custom utility classes specific to SAC page elements if needed */
    .sac-cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 1rem;
      margin-bottom: 2rem;
    }
    
    .sac-card {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: 8px;
      padding: 20px;
    }
    
    .sac-card h3 {
      font-size: 1.15rem;
      margin-bottom: 10px;
      color: var(--gray-900);
    }
    
    .sac-card ul {
      list-style-type: disc;
      padding-left: 20px;
      margin-top: 10px;
    }
    
    .table-group-header {
      background-color: var(--gold-100) !important;
      color: var(--gold-800) !important;
      font-weight: 700 !important;
      text-transform: uppercase;
      font-size: 0.9rem;
    }
  </style>
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
          ['title' => 'Institutional Initiative', 'url' => '#'],
          ['title' => 'SAC']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Students' Affairs Council (SAC)</h1>
        <p class="lede hero-subtitle">Empowering Students | Building Community | Leading Change</p>
      </div>
    </section>

    <!-- ============ SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="sacSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" style="white-space: nowrap;" onclick="document.getElementById('about-sac').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-users-viewfinder"></i> About SAC</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('mission-values').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-bullseye"></i> Mission & Role</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('sac-body').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-users"></i> Current SAC Body</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('sac-building').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-building"></i> SAC Building & Contact</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- SAC Building Image Carousel -->
          <div class="hostel-carousel" style="margin-bottom: 30px;">
            <img src="../images/SAC Building/0477_D.JPG" class="carousel-img active" alt="SAC Building" loading="lazy">
            <img src="../images/SAC Building/0478_D.JPG" class="carousel-img" alt="SAC Building" loading="lazy">
            <img src="../images/SAC Building/0479_D.JPG" class="carousel-img" alt="SAC Building" loading="lazy">
            <img src="../images/SAC Building/0480_D.JPG" class="carousel-img" alt="SAC Building" loading="lazy">
          </div>

          <!-- ============ ABOUT SAC ============ -->
          <div class="content-box" id="about-sac" style="scroll-margin-top: 100px;">
            <h2>About SAC</h2>
            <p>The essence of the success story of any educational institute lies in the success of its students. An enthusiastic student fraternity coupled with an able student administration forms the base for scaling great heights. We at the Student Affairs Council of IISER-Kolkata look to channelize the energy and vigor of our student community and give voice to their opinion.</p>
            
            <p>Please visit the official website: <a href="http://www.iiserkol.ac.in/~sac/" target="_blank" style="color: blue; text-decoration: underline;">SAC Official Website</a> for more details.</p>
          </div>

          <!-- ============ MISSION & ROLE ============ -->
          <div class="content-box" id="mission-values" style="scroll-margin-top: 100px;">
            <h2>Mission & Role</h2>
            <p><strong>Who they Are:</strong> A democratically elected student body representing and serving the IISER Kolkata community.</p>
            <p><strong>Their Mission:</strong> To ensure student welfare, promote holistic development, and create a vibrant campus environment.</p>
            <p><strong>What they Do:</strong> Represent student voices, manage clubs & activities, organize events & fests, improve campus life, and support student well-being.</p>
            <p><strong>Their Strength:</strong> Democratic representation, inclusive decision-making, active student participation, and strong student–administration collaboration.</p>
            
            <p><strong>Be a Part of SAC:</strong> Lead. Contribute. Make a Difference.</p>
          </div>

          <!-- ============ SAC BODY ============ -->
          <div class="content-box" id="sac-body" style="scroll-margin-top: 100px;">
            <h2>Our Current SAC Body</h2>
            <p>Get in touch with the current student representatives.</p>

            <div style="overflow-x:auto;">
              <table class="matrix-table">
                <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Roll No.</th>
                    <th>Position</th>
                    <th>Contact No.</th>
                    <th>Email ID</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Academics -->
                  <tr class="table-group-header">
                    <td colspan="6">SAC GS ACADEMICS</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Abhinandan Yadav</td>
                    <td>22MS074</td>
                    <td>SAC GS Academics (BS-MS)</td>
                    <td>06392757896</td>
                    <td rowspan="4" style="vertical-align: middle;"><a href="mailto:sac.acad@iiserkol.ac.in">sac.acad@iiserkol.ac.in</a></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Vidhi Bhushan</td>
                    <td>22MS066</td>
                    <td>SAC GS Academics (BS-MS)</td>
                    <td>07651835269</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Soumyadeep Sarkar</td>
                    <td>23IP008</td>
                    <td>SAC GS Academics (IP/MP)</td>
                    <td>07872351451</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Sandeep Yadav</td>
                    <td>22RS043</td>
                    <td>SAC GS Academics (PhD)</td>
                    <td>07988353976</td>
                  </tr>

                  <!-- Cultural -->
                  <tr class="table-group-header">
                    <td colspan="6">SAC GS CULTURAL</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Aritra Barua</td>
                    <td>22MS058</td>
                    <td>SAC GS Cultural (BS-MS)</td>
                    <td>09163120930</td>
                    <td rowspan="3" style="vertical-align: middle;"><a href="mailto:sac.cult@iiserkol.ac.in">sac.cult@iiserkol.ac.in</a></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Anubhab Das</td>
                    <td>22MS136</td>
                    <td>SAC GS Cultural (BS-MS)</td>
                    <td>09874757752</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Bishal Hazra</td>
                    <td>22RS014</td>
                    <td>SAC GS Cultural (PhD)</td>
                    <td>07865803866</td>
                  </tr>

                  <!-- Food Health and Hygiene -->
                  <tr class="table-group-header">
                    <td colspan="6">SAC GS FOOD HEALTH AND HYGIENE</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Khimavath Srishanth</td>
                    <td>23MS072</td>
                    <td>SAC GS Food Health & Hygiene (BS-MS)</td>
                    <td>08977646212</td>
                    <td rowspan="2" style="vertical-align: middle;"><a href="mailto:sac.food@iiserkol.ac.in">sac.food@iiserkol.ac.in</a></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Ruben Sandeep Pulickal</td>
                    <td>23MS104</td>
                    <td>SAC GS Food Health & Hygiene (BS-MS)</td>
                    <td>07356452271</td>
                  </tr>

                  <!-- Games and Sports -->
                  <tr class="table-group-header">
                    <td colspan="6">SAC GS GAMES AND SPORTS</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Aviyank Aryan</td>
                    <td>22MS030</td>
                    <td>SAC GS Games & Sports (BS-MS)</td>
                    <td>07764854741</td>
                    <td rowspan="2" style="vertical-align: middle;"><a href="mailto:sac.game@iiserkol.ac.in">sac.game@iiserkol.ac.in</a></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Agrawal Shyam Dipak</td>
                    <td>23MS063</td>
                    <td>SAC GS Games & Sports (BS-MS)</td>
                    <td>09307795369</td>
                  </tr>

                  <!-- Hostel and Transport -->
                  <tr class="table-group-header">
                    <td colspan="6">SAC GS HOSTEL AND TRANSPORT</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Ashutosh Jha</td>
                    <td>23MS179</td>
                    <td>SAC GS Hostel & Transport (BS-MS)</td>
                    <td>07297021124</td>
                    <td rowspan="3" style="vertical-align: middle;"><a href="mailto:sac.hostel@iiserkol.ac.in">sac.hostel@iiserkol.ac.in</a></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Mirza Mohammed Hasnain Baig</td>
                    <td>22MS137</td>
                    <td>SAC GS Hostel & Transport (BS-MS)</td>
                    <td>08457919048</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sangeetha T</td>
                    <td>21IP010</td>
                    <td>SAC GS Hostel & Transport (IP)</td>
                    <td>08075953256</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <!-- ============ SAC BUILDING & CONTACT ============ -->
          <div class="content-box" id="sac-building" style="scroll-margin-top: 100px;">
            <h2>SAC Building & Contact</h2>
            <p>The essence of the success story of any educational institute lies in the success of its students. An enthusiastic student fraternity coupled with an able student administration forms the base for scaling great heights. We at the Student Affairs Council of IISER-Kolkata look to channelize the energy and vigor of our student community and give voice to their opinion.</p>
            <p>Please visit to <a href="http://www.iiserkol.ac.in/~sac/" target="_blank" style="color: blue; text-decoration: underline;">http://www.iiserkol.ac.in/~sac/</a> for more details or reach out to our representatives via the emails provided above.</p>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
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
  
  <!-- scroll spy is automatically handled by include.js -->
  <script src="../layout/include.js"></script>

</body>

</html>
