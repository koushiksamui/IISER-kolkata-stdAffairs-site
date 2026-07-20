<?php $BASE_URL = $BASE_URL ?? '../'; ?>
<!-- ============ ACCESSIBILITY UTILITY BAR ============ -->
<div class="access-bar">
  <div class="container">
    <div class="a-links">
      <a href="https://www.iiserkol.ac.in" target="_blank">IISER Kolkata Home</a>
      <a href="<?php echo $BASE_URL; ?>index.php#footer-sitemap">Sitemap</a>
    </div>
    <div class="access-tools">
      <div class="font-adjust" role="group" aria-label="Adjust font size">
        <button id="fontDown" aria-label="Decrease font size">A-</button>
        <button id="fontReset" aria-label="Reset font size">A</button>
        <button id="fontUp" aria-label="Increase font size">A+</button>
      </div>
      <button id="contrastToggle" aria-pressed="false">
        <i class="fa-solid fa-circle-half-stroke"></i> High Contrast
      </button>
      <a href="<?php echo $BASE_URL; ?>admin/login.php" class="admin-btn"><i class="fa-solid fa-lock" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</div>

<!-- ============ HEADER ============ -->
<header class="site-header">
  <div class="container header-inner">
    <div class="brand">
      <a class="brand" href="<?php echo $BASE_URL; ?>index.php">
        <div class="brand-mark" aria-hidden="true">
          <img src="<?php echo $BASE_URL; ?>images/logo.png" alt="" />
        </div>
        <div class="brand-text">
          <div class="name">Office of Students' Affairs</div>
          <div class="sub">
            Indian Institute of Science Education and Research Kolkata
          </div>
        </div>
      </a>
    </div>

    <div class="header-right">
      <button
        class="hamburger"
        id="hamburgerBtn"
        aria-label="Open menu"
        aria-expanded="false"
        aria-controls="mobileNav">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>

  <!-- ============ MEGA NAVIGATION ============ -->
  <nav class="main-nav" aria-label="Primary">
    <ul class="nav-list">
      <li>
        <a href="<?php echo $BASE_URL; ?>index.php" aria-label="Home"><i class="fa-solid fa-house"></i></a>
      </li>
      <li>
        <button class="nav-top" aria-expanded="false">
          About Us <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="mega mega-compact">
          <div class="mega-col">
            <h4>Who We Are</h4>
            <ul>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/about.php"><i class="fa-solid fa-circle-info"></i> About</a>
              </li>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/message-deans.php"><i class="fa-solid fa-users"></i> Message from the Deans</a>
              </li>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/campus-map.php"><i class="fa-solid fa-users"></i> Campus Map</a>
              </li>
            </ul>
          </div>
        </div>
      </li>

      <li>
        <button class="nav-top" aria-expanded="false">
          Services <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="mega">
          <div class="mega-col">
            <h4>Living &amp; Community</h4>
            <ul>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/hostel-management.php"><i class="fa-solid fa-building"></i>Hostel Management</a>
              </li>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/smc-info.php"><i class="fa-solid fa-users-gear"></i> SMC Information</a>
              </li>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/transport.php"><i class="fa-solid fa-bus"></i>Transport</a>
              </li>
            </ul>
          </div>
          <div class="mega-col">
            <h4>Engagement</h4>
            <ul>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/student-achievements.php"><i class="fa-solid fa-medal"></i>Student Achievements</a>
              </li>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/clubs-societies.php"><i class="fa-solid fa-masks-theater"></i> Clubs &amp;
                  Societies</a>
              </li>
            </ul>
          </div>
        </div>
      </li>

      <li>
        <button class="nav-top" aria-expanded="false">
          Facilities <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="mega">
          <div class="mega-col">
            <h4>Health &amp; Wellbeing</h4>
            <ul>
              <li>
                <a href="#"><i class="fa-solid fa-kit-medical"></i> Medical Unit</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-heart-pulse"></i> MCWC</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-brain"></i> Counselling Services</a>
              </li>
            </ul>
          </div>
          <div class="mega-col">
            <h4>Sports</h4>
            <ul>
              <li>
                <a href="#"><i class="fa-solid fa-futbol"></i> Sports Facilities</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-trophy"></i> Tournaments</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-dumbbell"></i> Gymnasium</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-pen-ruler"></i> Stationery Shop</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-building-columns"></i> Bank &amp;
                  ATM</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-book-open"></i> Library Facilities</a>
              </li>
            </ul>
          </div>
          <div class="mega-col">
            <h4>Support</h4>
            <ul>
              <li>
                <a href="#"><i class="fa-solid fa-graduation-cap"></i> Scholarship &amp;
                  Financial Aid</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-briefcase"></i> Placement / CCD</a>
              </li>
            </ul>
          </div>
        </div>
      </li>

      <li><a href="<?php echo $BASE_URL; ?>pages/committees.php">Committees</a></li>

      <li><a href="#">SAC</a></li>
      <li><a href="<?php echo $BASE_URL; ?>pages/hostel-management.php">Hostel</a></li>

      <li><a href="<?php echo $BASE_URL; ?>pages/notices.php">Notices</a></li>

      <li>
        <button class="nav-top" aria-expanded="false">
          Resources <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="mega">
          <div class="mega-col">
            <h4>Downloads</h4>
            <ul>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/forms_downloads.php"><i class="fa-solid fa-file-arrow-down"></i> Forms &amp;
                  Downloads</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-file-lines"></i> Circulars</a>
              </li>
            </ul>
          </div>
          <div class="mega-col">
            <h4>Guidelines</h4>
            <ul>
              <li>
                <a href="#"><i class="fa-solid fa-book"></i> Manuals</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-gavel"></i> Policies</a>
              </li>
              <li>
                <a href="#"><i class="fa-solid fa-list-check"></i> SOPs</a>
              </li>
            </ul>
          </div>
        </div>
      </li>

      <li>
        <button class="nav-top" aria-expanded="false">
          Gallery <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="mega">
          <div class="mega-col">
            <h4>Media</h4>
            <ul>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/photo_gallery.php"><i class="fa-solid fa-camera"></i> Photo Gallery</a>
              </li>
              <li>
                <a href="<?php echo $BASE_URL; ?>pages/video_gallery.php"><i class="fa-solid fa-video"></i> Video Gallery</a>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </nav>
</header>