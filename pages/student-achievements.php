<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Achievements &amp; Ecosystem — Students' Affairs Office, IISER</title>
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
          ['title' => 'Student Life', 'url' => '#'],
          ['title' => 'Student Achievements']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Student Achievements</h1>
        <p class="lede hero-subtitle">Empowering students through opportunities in research, sports, culture, and leadership at IISER Kolkata.</p>
      </div>
    </section>

    <!-- ============ SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="achievementsSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" style="white-space: nowrap;" onclick="document.getElementById('research').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">Research &amp; Academics</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('sports-culture').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">Sports &amp; Culture</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('leadership').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">Leadership &amp; Community</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('support').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">Support &amp; Recognition</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- ============ RESEARCH & ACADEMICS ============ -->
          <div class="content-box" id="research" style="scroll-margin-top: 100px;">
            <h2>Research &amp; Academics</h2>
            <p>IISER Kolkata provides state-of-the-art facilities and a rigorous academic environment that empowers students to achieve excellence in research.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-flask" style="margin-right: 8px;"></i>Research Opportunities:</strong> Students are encouraged to participate in research from their early years. Through advanced laboratories, interdisciplinary projects, and the High Performance Computing facility, students gain exposure to industry consultancy, patent ecosystems, and contribute directly to high-impact research publications.</p>

              <p><strong><i class="fa-solid fa-graduation-cap" style="margin-right: 8px;"></i>Scholarships &amp; Fellowships:</strong> The Academic Office actively supports and publicizes national and international internships, research fellowships, and exchange programmes, allowing students to compete for and secure prestigious academic opportunities globally.</p>
            </div>
          </div>

          <!-- ============ SPORTS & CULTURE ============ -->
          <div class="content-box" id="sports-culture" style="scroll-margin-top: 100px;">
            <h2>Sports &amp; Culture</h2>
            <p>Our students excel outside the classroom by actively participating in competitive sports and diverse cultural platforms.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-volleyball" style="margin-right: 8px;"></i>Competitive Sports:</strong> Mentored by our Physical Education Instructor, talented athletes are trained and encouraged to represent the Institute teams in Inter-IISER, Inter-University, State-level, and National competitions.</p>

              <p><strong><i class="fa-solid fa-masks-theater" style="margin-right: 8px;"></i>Cultural Platforms:</strong> The campus boasts numerous vibrant clubs spanning Drama, Music, Dance, Arts, Photography, Cinema, Literature, Coding, Astronomy, Entrepreneurship, and more. These clubs organize regular workshops, discussions, and competitions.</p>

              <p><strong><i class="fa-solid fa-trophy" style="margin-right: 8px;"></i>Major Events:</strong> The primary platforms where students earn recognition include the Inter IISER Sports Meet (IISM), Inter IISER Cultural Meet (IICM), and our flagship fest, Inquivesta.</p>
            </div>
          </div>

          <!-- ============ LEADERSHIP & COMMUNITY ============ -->
          <div class="content-box" id="leadership" style="scroll-margin-top: 100px;">
            <h2>Leadership &amp; Community Impact</h2>
            <p>IISER Kolkata places a strong emphasis on holistic development, teamwork, and social responsibility.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-bullhorn" style="margin-right: 8px;"></i>Student Leadership:</strong> A significant portion of campus life revolves around the Students' Affairs Council (SAC). Students achieve leadership roles by serving as elected office bearers across Academics, Cultural, Games &amp; Sports, Food &amp; Health, and Hostel &amp; Transport councils.</p>

              <p><strong><i class="fa-solid fa-hands-holding-child" style="margin-right: 8px;"></i>Community Outreach:</strong> Highlights of social impact include <strong>EK Pehal</strong>, a student-led outreach initiative. Volunteers contribute to society by teaching underprivileged children, running science and environmental awareness programmes, distributing rations during crises, and providing career guidance and adult education.</p>
            </div>
          </div>

          <!-- ============ SUPPORT & RECOGNITION ============ -->
          <div class="content-box" id="support" style="scroll-margin-top: 100px;">
            <h2>Support &amp; External Recognition</h2>
            <p>The Institute provides the necessary administrative support to ensure that every student's achievements are formally recognized worldwide.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-file-signature" style="margin-right: 8px;"></i>Academic Recognition Support:</strong> The Academic Office seamlessly facilitates the generation of certificates, official transcripts, and credential verifications. The Institute also ensures integration with platforms like DigiLocker and APAAR to permanently secure and share student achievements, scholarships, and fellowships with external institutions.</p>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
    function updateActive(btn) {
      document.querySelectorAll('#achievementsSidebar .tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }
  </script>
  <script src="../layout/include.js"></script>

</body>

</html>