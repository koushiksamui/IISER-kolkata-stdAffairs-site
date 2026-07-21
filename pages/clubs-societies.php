<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clubs & Societies — Students' Affairs Office, IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/hostel-management.css">
  <style>
    .club-list {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 15px;
      margin-top: 20px;
    }

    .club-list-item {
      background: var(--grey-50);
      padding: 12px;
      border-radius: var(--radius-md);
      border: 1px solid var(--grey-200);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--navy-900);
    }

    .club-list-item i {
      color: var(--gold-600);
    }

    .club-img-box {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: var(--radius-md);
      margin-bottom: 12px;
      background: #fff;
    }

    @media (max-width: 900px) {
      .club-list {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media (max-width: 600px) {
      .club-list {
        grid-template-columns: 1fr;
      }
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
          ['title' => 'Engagement', 'url' => '#'],
          ['title' => 'Clubs & Societies']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Clubs & Societies</h1>
        <p class="lede hero-subtitle">Providing recreation, promoting well-being, and enhancing communication through interaction with diverse groups.</p>
      </div>
    </section>

    <!-- ============ SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="clubsSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" style="white-space: nowrap;" onclick="document.getElementById('introduction').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-circle-info"></i> Introduction</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('academic-clubs').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-microscope"></i> Academic Clubs</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('cultural-clubs').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-masks-theater"></i> Cultural Clubs</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('sports-clubs').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-futbol"></i> Sports Clubs</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('fests-meets').scrollIntoView({behavior:'smooth', block:'start'});"><i class="fa-solid fa-calendar-check"></i> Fests &amp; Meets</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- Image Carousel -->
          <div class="hostel-carousel" style="margin-bottom: var(--space-4);">
            <img src="../images/Clubs/club-img1.jpg" class="carousel-img active" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img2.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img3.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img4.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img5.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img6.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img7.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img8.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img9.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
            <img src="../images/Clubs/club-img10.jpg" class="carousel-img" alt="Club Activity" loading="lazy">
          </div>

          <!-- ============ INTRODUCTION ============ -->
          <div class="content-box" id="introduction" style="scroll-margin-top: 100px;">
            <h2>Clubs and Societies</h2>
            <p>There are various clubs run by the student community where students can join and participate in activities based on their interests. The core purpose of these clubs is to provide recreation, promote physical and mental well-being, and enhance communication skills through interaction with diverse groups of people and increased social exposure.</p>
            <p>Below is a list of the different clubs along with brief details about each.</p>
          </div>

          <!-- ============ ACADEMIC CLUBS ============ -->
          <div class="content-box" id="academic-clubs" style="scroll-margin-top: 100px;">
            <h2>Academic Clubs</h2>

            <div class="club-list">
              <div class="club-list-item"><i class="fa-solid fa-lightbulb"></i> Entrepreneurship Cell</div>
              <div class="club-list-item"><i class="fa-solid fa-code"></i> Slash Dot (Coding)</div>
              <div class="club-list-item"><i class="fa-solid fa-meteor"></i> Singularity (Astronomy)</div>
              <div class="club-list-item"><i class="fa-solid fa-briefcase"></i> Placement Cell</div>
              <div class="club-list-item"><i class="fa-solid fa-rocket"></i> E-Cell</div>
              <div class="club-list-item"><i class="fa-solid fa-user-graduate"></i> Alumni Cell</div>
            </div>

            <h3 style="margin-top: 2rem;">Alumni Relations and Placement</h3>
            <p>The Alumni Cell connects IISER Kolkata with its growing network of accomplished graduates and fosters meaningful interaction between alumni and current students. Alumni of the Institute have excelled in academia, industry, entrepreneurship, and public service.</p>
            <p>The Cell organizes alumni meets, guest lectures, mentorship programmes, and networking events that provide students with career guidance, professional exposure, and valuable insights. Every year, the Students’ Affairs Office hosts an alumni meet where 4–5 distinguished alumni are felicitated with certificates and cash awards for their achievements and contributions to society.</p>
            <p>The Alumni Cell also works closely with the Placement Committee to strengthen corporate connections and improve internship and placement opportunities. It maintains an updated alumni database and keeps former students connected through newsletters, social media, and institutional events.</p>

            <h3 style="margin-top: 2rem;">E-Cell</h3>
            <p>The Entrepreneurship Cell encourages entrepreneurial thinking among students through talks, workshops, and interactive sessions. Beyond entrepreneurship, it helps students develop essential life skills such as problem-solving, quick thinking, communication, confidence, resilience, and the ability to make the most of opportunities.</p>

            <h3 style="margin-top: 2rem;">RISE</h3>
            <p>"RISE Foundation IISER, the Technology Business Incubator of Indian Institute of Science Education and Research Kolkata, supports deep-tech startups and innovators through incubation, mentoring, funding facilitation, IP guidance, and commercialization support.</p>
            <p>Established in 2018 as a Section 8 company, it has supported over 50 startups across sectors including biotechnology, healthcare, AI, agriculture, and sustainability under programs such as DST-NIDHI, MeitY GENESIS, and DBT-BIRAC BioNEST. Through industry collaborations and the Kalyani Innovation Network, RISE aims to bridge research and market-ready innovation while strengthening the regional startup ecosystem."</p>
          </div>

          <!-- ============ CULTURAL CLUBS ============ -->
          <div class="content-box" id="cultural-clubs" style="scroll-margin-top: 100px;">
            <h2>Cultural Clubs</h2>

            <div class="club-list">
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Aarshi.png" class="club-img-box" style="object-fit: contain;">
                <span>Aarshi (Drama)</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Arts Club.png" class="club-img-box" style="object-fit: contain;">
                <span>Arts Club</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Dance Club.png" class="club-img-box" style="object-fit: contain;">
                <span>Nrutya (Dance)</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Movie Club.png" class="club-img-box" style="object-fit: contain;">
                <span>Movie Club</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Campus Radio.png" class="club-img-box" style="object-fit: contain;">
                <span>Campus Radio</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Nature Club.png" class="club-img-box" style="object-fit: contain;">
                <span>Nature Club</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Music Club.png" class="club-img-box" style="object-fit: contain;">
                <span>Music Club</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center;">
                <img src="../images/Clubs/Literary Club.png" class="club-img-box" style="object-fit: contain;">
                <span>Literary Club</span>
              </div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center; justify-content: center;">
                <img src="../images/Clubs/Quiz Club.png" class="club-img-box" style="object-fit: contain;">
                <span style="margin-top: auto;">Quiz Club</span>
              </div>
            </div>
          </div>

          <!-- ============ SPORTS CLUBS ============ -->
          <div class="content-box" id="sports-clubs" style="scroll-margin-top: 100px;">
            <h2>Games and Sports Clubs</h2>

            <div class="club-list">
              <div class="club-list-item"><i class="fa-solid fa-person-running"></i> Athletics Club</div>
              <div class="club-list-item"><i class="fa-solid fa-table-tennis-paddle-ball"></i> Badminton Club</div>
              <div class="club-list-item"><i class="fa-solid fa-basketball"></i> Basketball Club</div>
              <div class="club-list-item"><i class="fa-solid fa-chess"></i> Chess Club</div>
              <div class="club-list-item"><i class="fa-solid fa-baseball-bat-ball"></i> Cricket Club</div>
              <div class="club-list-item"><i class="fa-solid fa-futbol"></i> Football Club</div>
              <div class="club-list-item"><i class="fa-solid fa-dumbbell"></i> Gym Club</div>
              <div class="club-list-item"><i class="fa-solid fa-volleyball"></i> Volleyball Club</div>
              <div class="club-list-item"><i class="fa-solid fa-yin-yang"></i> Self-Defence & Yoga</div>
              <div class="club-list-item" style="flex-direction: column; align-items: stretch; text-align: center; padding: 12px;">
                <img src="../images/Clubs/Photography Club.png" class="club-img-box" style="object-fit: contain; margin-bottom: 8px; height: 100px;">
                <span>PIXEL (Photography)</span>
              </div>
              <div class="club-list-item"><i class="fa-solid fa-crosshairs"></i> Carrom Club</div>
              <div class="club-list-item"><i class="fa-solid fa-gamepad"></i> Gaming Club</div>
              <div class="club-list-item"><i class="fa-solid fa-users"></i> Kabaddi Club</div>
              <div class="club-list-item"><i class="fa-solid fa-users-rays"></i> Kho-Kho Club</div>
              <div class="club-list-item"><i class="fa-solid fa-table-tennis-paddle-ball"></i> Lawn Tennis Club</div>
              <div class="club-list-item"><i class="fa-solid fa-cube"></i> Rubik Club</div>
            </div>
          </div>

          <!-- ============ FESTS AND MEETS ============ -->
          <div class="content-box" id="fests-meets" style="scroll-margin-top: 100px;">
            <h2>Institute Fests and Sports/Cultural Meets</h2>

            <h3 style="margin-top: 2rem;">Inquivesta</h3>
            <p>Inquivesta is IISER Kolkata’s science festival, started in 2011 to ignite curiosity among young minds. It brings together students from schools and colleges across the country through events, seminars, workshops, and activities spanning science, creativity, art, drama, and innovation.</p>
            <p>Website: <a href="http://www.inquivesta.iiserkol.ac.in/" target="_blank" style="color: blue;">http://www.inquivesta.iiserkol.ac.in/</a></p>

            <h3 style="margin-top: 2rem;">SPIC MACAY</h3>
            <p>SPIC MACAY stands for the Society for Promotion of Indian Classical Music and Culture Amongst Youth. At IISER Kolkata, it promotes interest in Indian classical arts through performances by renowned artists, as well as programmes featuring students trained in classical music, dance, and instrumental traditions.</p>
            <img src="../images/Clubs/SPIC MACAY.png" style="width: 200px; height: auto; object-fit: contain; margin-top: 10px; margin-bottom: 10px;">

            <h3 style="margin-top: 2rem;">IISM</h3>
            <p>IISM — Inter IISER Sports Meet is the annual sports meet of IISERs and other basic science institutes in India. IISER Kolkata hosted the fifth edition, IISM 2016, from 8–13 December 2016.</p>
            <p>Website: <a href="http://iism.iiserkol.ac.in/" target="_blank" style="color: blue;">http://iism.iiserkol.ac.in/</a></p>

            <h3 style="margin-top: 2rem;">IICM</h3>
            <p>IICM — Inter IISER Cultural Meet is the annual cultural meet of IISERs and basic science institutes in India. It provides a platform for students to showcase their cultural, artistic, and creative talents.</p>
            <p>Website: <a href="http://iicm.iiserkol.ac.in/" target="_blank" style="color: blue;">http://iicm.iiserkol.ac.in/</a></p>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script src="../layout/include.js"></script>
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

</body>

</html>