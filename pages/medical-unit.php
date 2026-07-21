<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical Unit — Students' Affairs Office, IISER</title>
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
          ['title' => 'Medical Unit']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Medical Unit</h1>
        <p class="lede hero-subtitle">Compassionate, comprehensive, and prompt healthcare services for the IISER Kolkata community.</p>
      </div>
    </section>

    <!-- ============ SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="medicalSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" style="white-space: nowrap;" onclick="document.getElementById('about-facilities').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">About &amp; Facilities</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('opd-timings').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">OPD Timings</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('insurance').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">Medical Insurance</button>
          <button class="tab-btn" style="white-space: nowrap;" onclick="document.getElementById('contacts').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);">Medical Section (Contacts)</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- Image Carousel -->
          <div class="hostel-carousel" style="margin-bottom: var(--space-4);">
            <img src="../images/Medical Unit/medical-unit.jpg" class="carousel-img active" alt="Medical Unit Exterior" loading="lazy">
            <img src="../images/Medical Unit/0483_D.JPG" class="carousel-img" alt="Medical Unit Interior" loading="lazy">
            <img src="../images/Medical Unit/0484_D.JPG" class="carousel-img" alt="Medical Unit Facilities" loading="lazy">
            <img src="../images/Medical Unit/0485_D.JPG" class="carousel-img" alt="Medical Unit Treatment Area" loading="lazy">
            <img src="../images/Medical Unit/medical-garage.jpg" class="carousel-img" alt="Ambulance Service" loading="lazy">
          </div>

          <!-- ============ ABOUT & FACILITIES ============ -->
          <div class="content-box" id="about-facilities" style="scroll-margin-top: 100px;">
            <h2>About the Medical Unit</h2>
            <p>The <strong>Medical Unit at IISER Kolkata</strong> functions as a dedicated first-aid dispensary, providing <strong>free medical care</strong> to students, faculty, staff, and their dependents. The Institute is committed to delivering prompt, compassionate, and comprehensive healthcare services to the campus community.</p>

            <h3 style="margin-top: var(--space-4);">Medical Facilities</h3>
            <div class="indent-group">
              <p><strong><i class="fa-solid fa-stethoscope" style="margin-right: 8px;"></i>Primary Care:</strong> Free primary medical care for students, faculty, staff, and their dependents, including first-aid and outpatient medical consultation.</p>
              
              <p><strong><i class="fa-solid fa-pills" style="margin-right: 8px;"></i>Apollo Pharmacy:</strong> An Apollo Pharmacy is located within the Medical Unit, providing essential medicines free of cost to the IISER Kolkata community.</p>
              
              <p><strong><i class="fa-solid fa-hospital" style="margin-right: 8px;"></i>Specialized Treatment:</strong> Access to specialized treatment through tie-ups with reputed hospitals and pharmacies, as well as emergency medical support through the Institute's proximity to <strong>AIIMS Kalyani</strong>.</p>
              
              <p><strong><i class="fa-solid fa-truck-medical" style="margin-right: 8px;"></i>Emergency Services:</strong> Ambulance services are available round-the-clock for medical emergencies.</p>
            </div>
          </div>

          <!-- ============ OPD TIMINGS ============ -->
          <div class="content-box" id="opd-timings" style="scroll-margin-top: 100px;">
            <h2>OPD Timings</h2>
            <p>Outpatient Department (OPD) consultations are available during the following hours:</p>

            <table class="matrix-table">
              <thead>
                <tr>
                  <th>Day</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Monday – Saturday</td>
                  <td><strong>9:00 AM – 1:00 PM</strong></td>
                </tr>
                <tr>
                  <td>Sunday</td>
                  <td><strong>2:30 PM – 5:30 PM</strong></td>
                </tr>
              </tbody>
            </table>


          </div>

          <!-- ============ MEDICAL INSURANCE ============ -->
          <div class="content-box" id="insurance" style="scroll-margin-top: 100px;">
            <h2>Medical Insurance</h2>
            <p>To support students during hospitalization and medical emergencies, a comprehensive insurance framework is in place:</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-shield-halved" style="margin-right: 8px;"></i>Annual Coverage:</strong> Every student is covered under a Medical Insurance Policy arranged annually by the Student Affairs Section.</p>
              
              <p><strong><i class="fa-solid fa-money-bill-wave" style="margin-right: 8px;"></i>Funding:</strong> The policy is procured using the medical insurance fee collected from students.</p>
              
              <p><strong><i class="fa-solid fa-bed-pulse" style="margin-right: 8px;"></i>IPD Treatment:</strong> Coverage includes Hospitalization/In-Patient Department (IPD) treatment, subject to the policy's terms and conditions.</p>
              
              <p><strong><i class="fa-solid fa-clipboard-list" style="margin-right: 8px;"></i>Claims Assistance:</strong> Students may contact the Student Affairs Office for guidance regarding insurance claims and procedures.</p>
            </div>
          </div>

          <!-- ============ MEDICAL SECTION CONTACTS ============ -->
          <div class="content-box" id="contacts" style="scroll-margin-top: 100px;">
            <h2>Medical Section</h2>
            <p>For medical assistance, you may reach out to the following personnel:</p>

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
                    <td><strong>Dr. Mayukh Pal</strong></td>
                    <td>Duty Medical Officer</td>
                    <td><a href="mailto:palmayukh8@iiserkol.ac.in">palmayukh8@iiserkol.ac.in</a></td>
                    <td>9433863905</td>
                  </tr>
                  <tr>
                    <td><strong>Dr. Nivedita Chakraborty</strong></td>
                    <td>Duty Medical Officer</td>
                    <td><a href="mailto:dr.nivedita.chakraborty@iiserkol.ac.in">dr.nivedita.chakraborty@iiserkol.ac.in</a></td>
                    <td>7838643462</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Deepak K. Panigrahi</strong></td>
                    <td>Nursing Assistant</td>
                    <td><a href="mailto:deepak.panigrahi@iiserkol.ac.in">deepak.panigrahi@iiserkol.ac.in</a></td>
                    <td>9002232022</td>
                  </tr>
                  <tr>
                    <td><strong>Ms. Purabi Mondal</strong></td>
                    <td>Nursing Assistant</td>
                    <td><a href="mailto:purabi@iiserkol.ac.in">purabi@iiserkol.ac.in</a></td>
                    <td>9836249346</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Arvind Kumar Mishra</strong></td>
                    <td>Physiotherapist</td>
                    <td><a href="mailto:arvind.mishra@iiserkol.ac.in">arvind.mishra@iiserkol.ac.in</a></td>
                    <td>9918492864</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Debu Das</strong></td>
                    <td>Attendant</td>
                    <td><a href="mailto:debudas718@iiserkol.ac.in">debudas718@iiserkol.ac.in</a></td>
                    <td>9088206777</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Nasir Mondal</strong></td>
                    <td>Ambulance Driver</td>
                    <td><a href="mailto:nashir@iiserkol.ac.in">nashir@iiserkol.ac.in</a></td>
                    <td>9836267955</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Debu Halder</strong></td>
                    <td>Ambulance Driver</td>
                    <td><a href="mailto:debu@iiserkol.ac.in">debu@iiserkol.ac.in</a></td>
                    <td>8145549528</td>
                  </tr>
                  <tr>
                    <td><strong>Mr. Jainal Mondal</strong></td>
                    <td>Ambulance Driver</td>
                    <td>—</td>
                    <td>9038469584</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
    /* ================= TAB SWITCHING LOGIC ================= */
    function updateActive(btn) {
      document.querySelectorAll('#medicalSidebar .tab-btn').forEach(b => b.classList.remove('active'));
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
  <script src="../layout/include.js"></script>

</body>

</html>
