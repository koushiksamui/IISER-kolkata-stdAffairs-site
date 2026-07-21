<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transport — Students' Affairs Office, IISER</title>
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
          ['title' => 'Services', 'url' => '../index.html#services'],
          ['title' => 'Transport']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Transport</h1>
        <p class="lede hero-subtitle">Information regarding Institute and public transportation for IISER Kolkata.</p>
      </div>
    </section>

    <!-- ============ TRANSPORT SECTIONS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="transportSidebar" style="position: sticky; top: 100px; height: fit-content;">
          <button class="tab-btn active" onclick="document.getElementById('connectivity').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-route"></i> Campus Connectivity</button>
          <button class="tab-btn" onclick="document.getElementById('institute-transport').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-bus"></i> Institute Transport</button>
          <button class="tab-btn" onclick="document.getElementById('admin-complaints').scrollIntoView({behavior:'smooth', block:'start'}); updateActive(this);"><i class="fa-solid fa-headset"></i> Admin &amp; Complaints</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content" style="display:flex; flex-direction:column;">

          <!-- ============ CAMPUS CONNECTIVITY ============ -->
          <div class="content-box" id="connectivity" style="scroll-margin-top: 100px;">
            <h2>Campus Connectivity</h2>
            <p>IISER Kolkata is situated in a location that is well connected to major transit hubs.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-map-location-dot" style="margin-right: 8px;"></i>Public Transport:</strong> The campus is well connected by public transport from both <strong>Kalyani</strong> and <strong>Kolkata</strong>, assuring students that commuting to and from the institute is highly convenient.</p>
            </div>
          </div>

          <!-- ============ INSTITUTE TRANSPORT ============ -->
          <div class="content-box" id="institute-transport" style="scroll-margin-top: 100px;">
            <h2>Institute Transport Services</h2>
            <p>The institute operates its own transport facilities specifically for the IISER Kolkata community.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong><i class="fa-solid fa-bus-simple" style="margin-right: 8px;"></i>Available Vehicles:</strong> The Institute provides dedicated Bus services and Bolero vehicle services.</p>
              <p><strong><i class="fa-solid fa-arrow-right-arrow-left" style="margin-right: 8px;"></i>Primary Route:</strong> These institute vehicles operate primarily between the <strong>Campus</strong> and <strong>Kalyani Railway Station</strong> (via Central Park, Kalyani).</p>
            </div>
          </div>

          <!-- ============ ADMIN & COMPLAINTS ============ -->
          <div class="content-box" id="admin-complaints" style="scroll-margin-top: 100px;">
            <h2>Administration &amp; Complaint Escalation</h2>
            <p>Transport operations and concerns are managed under the umbrella of the Office of Students' Affairs and Hostel administration.</p>

            <div class="indent-group" style="margin-top: 20px;">
              <p><strong>Student Representatives:</strong> The Students' Affairs Council (SAC) has a dedicated body for Hostel &amp; Transport. The current representatives are <strong>Ashutosh Jha</strong>, <strong>Mirza Mohammed Hasnain Baig</strong>, and <strong>Sangeetha T</strong>.</p>

              <p><strong>Escalation Matrix:</strong> If you face any issues related to transport, follow this formal complaint flow:</p>

              <div style="margin-top: 15px;">
                <p><strong>Step 1 - Wing Representatives (WRs) &amp; SAC GS Hostel:</strong> Your first point of contact for day-to-day transport and hostel issues.</p>
                <p><strong>Step 2 - Hostel Attendants &amp; Assistants:</strong> Contact them if your issue requires operational intervention at the hostel level.</p>
                <p><strong>Step 3 - Hostel Warden:</strong> For issues that remain unresolved by the assistants.</p>
                <p><strong>Step 4 - Chief Warden:</strong> For severe or completely unresolved issues across hostels.</p>
                <p><strong>Step 5 - Associate Dean (Hostel) &amp; Dean of Students:</strong> The final authority for overarching student and transport affairs.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
    function updateActive(btn) {
      document.querySelectorAll('#transportSidebar .tab-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }
  </script>
  <script src="../layout/include.js"></script>

</body>

</html>