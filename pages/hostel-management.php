<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Management — Students' Affairs Office, IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/hostel-management.css?v=<?php echo time(); ?>">
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
          ['title' => 'Hostel Management']
        ];
        include __DIR__ . '/../components/breadcrumb.php';
        ?>
        <h1 class="hero-title">Hostel Management</h1>
        <p class="lede hero-subtitle">Everything to do with where you live — room allotment, warden contacts, maintenance requests, mess and fee information, and hostel rules — in one place.</p>
      </div>
    </section>

    <!-- ============ HOSTEL TABS LAYOUT ============ -->
    <section class="section">
      <div class="container hostel-layout">

        <!-- Sidebar Navigation -->
        <aside class="sidebar-menu" id="hostelSidebar">
          <button class="tab-btn active" data-target="tab-overview"><i class="fa-solid fa-building"></i> Overview &amp; Life</button>
          <button class="tab-btn" data-target="tab-mess"><i class="fa-solid fa-utensils"></i> Mess &amp; Dining</button>
          <button class="tab-btn" data-target="tab-admin"><i class="fa-solid fa-users-gear"></i> Admin &amp; Contacts</button>
          <button class="tab-btn" data-target="tab-rules"><i class="fa-solid fa-scale-balanced"></i> Rules &amp; Anti-Ragging</button>
          <button class="tab-btn" data-target="tab-complaints"><i class="fa-solid fa-headset"></i> Complaints &amp; Maint.</button>
          <button class="tab-btn" data-target="tab-fees"><i class="fa-solid fa-money-check-dollar"></i>Fees</button>
        </aside>

        <!-- Main Content Area -->
        <div class="tab-content">

          <!-- TAB 1: OVERVIEW & LIFE -->
          <div class="tab-pane active" id="tab-overview">

            <!-- Hostel Image Carousel -->
            <div class="hostel-carousel">
              <img src="../images/Hostels/0454_D.JPG" class="carousel-img active" alt="Hostel Building View" loading="lazy">
              <img src="../images/Hostels/0464_D.JPG" class="carousel-img" alt="Hostel Common Area" loading="lazy">
            </div>

            <div class="content-box">
              <h2>Orientation &amp; Hostel Life</h2>
              <p><strong>Welcome to IISER Kolkata!</strong> For many of you, this is your first time living away from home. You'll experience a new place, new people, different food, and a vibrant culture. We are here to support you!</p>
              <p>To help you settle into campus life, we organize several orientation and interactive sessions led by faculty members and senior students:</p>
              <div class="indent-group">
                <p><strong>Campus Walk:</strong> Familiarize yourself with the academic, administrative, and residential zones.</p>
                <p><strong>Ice-breaking Sessions:</strong> Participate in games and interactive activities to connect with peers.</p>
                <p><strong>Club Fair:</strong> Discover and join student-led clubs for cultural, technical, and sports activities.</p>
              </div>
            </div>

            <div class="content-box">
              <h2>Accommodation &amp; Hostels</h2>
              <p>We provide comfortable and secure residential facilities. Note that <strong>first-year BS-MS students are exclusively accommodated in Nivedita Hall.</strong></p>

              <div class="hostel-grid">
                <div class="hostel-card">
                  <div class="hostel-photo">
                    <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=500&q=70" alt="NSCB Hall" loading="lazy">
                    <span class="hostel-tag">Boys &amp; Girls</span>
                  </div>
                  <div class="hostel-body">
                    <h4>Netaji Subhash Chandra Bose Hall (NSCB)</h4>
                    <div class="hostel-meta">
                      <span><i class="fa-solid fa-door-closed"></i> Shared, 2 per room</span>
                    </div>
                  </div>
                </div>
                <div class="hostel-card">
                  <div class="hostel-photo">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=500&q=70" alt="Nivedita Hall" loading="lazy">
                    <span class="hostel-tag girls">Boys &amp; Girls</span>
                  </div>
                  <div class="hostel-body">
                    <h4>Nivedita Hall</h4>
                    <div class="hostel-meta">
                      <span><i class="fa-solid fa-users"></i> First-year BS-MS</span>
                      <span><i class="fa-solid fa-door-closed"></i> Shared rooms</span>
                    </div>
                  </div>
                </div>
                <div class="hostel-card">
                  <div class="hostel-photo">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500&q=70" alt="ICV Hall" loading="lazy">
                    <span class="hostel-tag">Boys Only</span>
                  </div>
                  <div class="hostel-body">
                    <h4>Ishwar Chandra Vidyasagar Hall (ICV)</h4>
                    <div class="hostel-meta">
                      <span><i class="fa-solid fa-door-closed"></i> Shared &amp; Single rooms</span>
                    </div>
                  </div>
                </div>
              </div>

              <h3>In-Room Facilities</h3>
              <p>Every student is provided with basic furniture to ensure a comfortable stay:</p>
              <div class="indent-group">
                <p><strong>Standard Bed</strong></p>
                <p><strong>Study Table</strong></p>
                <p><strong>Chair</strong></p>
                <p><strong>Almirah / Wardrobe</strong></p>
              </div>

              <h3>Common Facilities</h3>
              <p>Each hostel block is equipped with shared amenities for daily convenience:</p>
              <div class="indent-group">
                <p><strong>24×7 running water and electricity</strong></p>
                <p><strong>High-speed Campus Wi-Fi</strong></p>
                <p><strong>Hot drinking water dispensers</strong></p>
                <p><strong>Geysers in bathrooms</strong></p>
                <p><strong>Washing machines for laundry</strong></p>
                <p><strong>Refrigerators in common areas</strong></p>
              </div>
            </div>

            <div class="content-box">
              <h2>Safety &amp; Security</h2>
              <p>The safety of our residents is a top priority. Hostels are fully covered under the central campus security network.</p>
              <div class="indent-group">
                <p><strong>Security Personnel:</strong> Stationed 24/7 at all hostel entrances.</p>
                <p><strong>Patrols:</strong> Regular security patrols cover the hostel perimeters.</p>
                <p><strong>Emergency Response:</strong> A dedicated Security Control Room manages fire safety and emergency protocols.</p>
                <p>In case of a security emergency, students can directly contact the Chief Security Officer.</p>
              </div>
            </div>
          </div>

          <!-- TAB 2: MESS & DINING -->
          <div class="tab-pane" id="tab-mess">
            <div class="content-box">
              <h2>Students' Monitored Canteen (SMC)</h2>
              <p>The dining facilities at IISER Kolkata operate on a unique, flexible system designed for student convenience.</p>

              <p><strong>ID-Based System:</strong> The mess uses a digitized Institute ID-based prepaid system. You scan your ID card at the counter, and you only pay for the food you consume.</p>

              <h3>How the Prepaid System Works</h3>
              <div class="indent-group">
                <p><strong>No Fixed Deductions:</strong> Unlike traditional messes, there is no automatic deduction for skipped meals. You are charged solely for what you eat.</p>
                <p><strong>Initial Recharge:</strong> We suggest an initial recharge of ₹1000–₹2500 when you arrive.</p>
                <p><strong>Online Recharge:</strong> You can conveniently top-up your mess account online through the student portal.</p>
                <p><strong>Minimum Balance:</strong> If your account balance drops below ₹50, it will be temporarily blocked until recharged.</p>
              </div>

              <h3>Late Night &amp; Quick Cravings</h3>
              <div class="indent-group">
                <p><strong>Night Canteen:</strong> Located at Nivedita Hall, the night canteen serves snacks and meals late into the night.</p>
                <p><strong>Vending Machines:</strong> Smart vending machines are available inside the hostels for instant snacks and beverages 24/7.</p>
              </div>
            </div>
          </div>

          <!-- TAB 3: ADMIN & CONTACTS -->
          <div class="tab-pane" id="tab-admin">
            <div class="content-box">
              <h2>Hostel Administration</h2>
              <p>The hostel administration works closely with the Students' Affairs Office to ensure student welfare, discipline, and smooth functioning of residential facilities.</p>
            </div>

            <div class="content-box">
              <h2>Leadership</h2>
              <p>The leadership team at the Students' Affairs Office oversees the strategic direction, policy formulation, and overall welfare of the student community. They ensure a safe, inclusive, and conducive environment for all residents across the campus.</p>
              <div class="contact-grid">
                <div class="contact-card">
                  <img src="../images/Deans/DOSA.jpg" class="contact-img" alt="Dean of Students" loading="lazy">
                  <h4>Dean of Students</h4>
                  <div class="role">Welfare, Discipline & Safety</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> dosa@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/adosa.jpg" class="contact-img" alt="Associate Dean of Students (Hostel)" loading="lazy">
                  <h4>Associate Dean of Students (Hostel)</h4>
                  <div class="role">Room Allotment & Policies</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> adosa.hostel@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/asst-reg.jpg" class="contact-img" alt="Assistant Registrar (Students' Affairs)" loading="lazy">
                  <h4>Assistant Registrar (Students' Affairs)</h4>
                  <div class="role">Coordination & Administration</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> ar.sao@iiserkol.ac.in</a>
                </div>
              </div>
            </div>

            <div class="content-box">
              <h2>Hostel Wardens</h2>
              <p>Hostel Wardens are responsible for the day-to-day management of individual hostels, ensuring discipline, safety, and prompt resolution of student concerns. They serve as the primary administrative authority and mentors within the residential blocks.</p>
              <div class="contact-grid">
                <div class="contact-card">
                  <img src="../images/Hostels/chief-warden.png" class="contact-img" alt="Dr. Bheemalingam Chittari" loading="lazy">
                  <h4>Dr. Bheemalingam Chittari</h4>
                  <div class="role">Chief Warden</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> chief.warden@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/assoc-cheif-warden.jpg" class="contact-img" alt="Dr. Sangita Sen" loading="lazy">
                  <h4>Dr. Sangita Sen</h4>
                  <div class="role">Associate Chief Warden</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> assoc.chiefwarden@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/warden-icv-hall.png" class="contact-img" alt="Dr. Shirshendu Chowdhury" loading="lazy">
                  <h4>Dr. Shirshendu Chowdhury</h4>
                  <div class="role">Warden (ICV Hall)</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> warden.icv@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/warden-nscb-boys.png" class="contact-img" alt="Dr. Babu Sudhamalla" loading="lazy">
                  <h4>Dr. Babu Sudhamalla</h4>
                  <div class="role">Warden (NSCB Boys)</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> warden.nscb.boys@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/warden-nscb-girls.jpg" class="contact-img" alt="Dr. Susmita Roy" loading="lazy">
                  <h4>Dr. Susmita Roy</h4>
                  <div class="role">Warden (NSCB Girls)</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> warden.nscb.girls@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/girls-warden-nh.png" class="contact-img" alt="Dr. Monidipa Das" loading="lazy">
                  <h4>Dr. Monidipa Das</h4>
                  <div class="role">Warden (Nivedita Girls)</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> warden.nivedita.girls@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/warden-nh-boys.jpg" class="contact-img" alt="Dr. Sreeramaiah Gangappa" loading="lazy">
                  <h4>Dr. Sreeramaiah Gangappa</h4>
                  <div class="role">Warden (Nivedita Boys)</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> warden.nivedita.boys@iiserkol.ac.in</a>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/warden-maintenance-mess.png" class="contact-img" alt="Dr. Debananda Roy" loading="lazy">
                  <h4>Dr. Debananda Roy</h4>
                  <div class="role">Mess Warden</div>
                  <a href="#"><i class="fa-solid fa-envelope"></i> warden.mess@iiserkol.ac.in</a>
                </div>
              </div>
            </div>

            <div class="content-box">
              <h2>Hostel Assistants</h2>
              <p>Hostel Assistants provide essential on-ground administrative support for daily operations and immediate maintenance coordination. They are your first point of contact for routine queries, room-related issues, and everyday residential assistance.</p>
              <div class="contact-grid">
                <div class="contact-card">
                  <img src="../images/Hostels/puskar-das.jpg" class="contact-img" alt="Mr. Puskar Das" loading="lazy">
                  <h4>Mr. Puskar Das</h4>
                  <div class="role">Hostel Assistant</div>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/sudhir-kr-sharma.jpg" class="contact-img" alt="Mr. Sudhir Kumar Sharma" loading="lazy">
                  <h4>Mr. Sudhir Kumar Sharma</h4>
                  <div class="role">Hostel Assistant</div>
                </div>
                <div class="contact-card">
                  <img src="../images/Hostels/prosenjit-majumdar.jpg" class="contact-img" alt="Mr. Prosenjit Majumdar" loading="lazy">
                  <h4>Mr. Prosenjit Majumdar</h4>
                  <div class="role">Hostel Assistant</div>
                </div>
              </div>
            </div>

            <div class="content-box">
              <h2>Office &amp; Visiting Hours</h2>
              <p>Students can meet with the authorities during the following designated office hours:</p>
              <table class="matrix-table">
                <thead>
                  <tr>
                    <th>Authority</th>
                    <th>Visiting Schedule</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Dean of Students</td>
                    <td>04:30PM to 05:30PM at DoSA Office, Room No. 106, AAC Building</td>
                  </tr>
                  <tr>
                    <td>Associate Dean (Hostel)</td>
                    <td>11:00AM to 11:30AM at DoSA Office, Room No. 106, AAC Building</td>
                  </tr>
                  <tr>
                    <td>Associate Dean (Sports)</td>
                    <td>12:00PM to 12:30PM at DoSA Office, Room No. 106, AAC Building</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- TAB 4: RULES & ANTI-RAGGING -->
          <div class="tab-pane" id="tab-rules">
            <div class="content-box">
              <h2>Hostel Rules &amp; Protocols</h2>
              <p>The Chief Warden is the primary authority for hostel matters, while individual wardens manage their respective hostels. All students must strictly adhere to the following rules:</p>

              <div class="indent-group">
                <p><strong>General Conduct:</strong> Follow all Hostel Rules &amp; Regulations. No unauthorized absence from the hostel is permitted.</p>
                <p><strong>Restricted Areas:</strong> Entry into restricted hostel areas is strictly prohibited.</p>
                <p><strong>Entry/Exit Log:</strong> Students must sign the hostel register when leaving or entering the campus.</p>
                <p><strong>Leave Rules:</strong> Always follow the official hostel leave rules before planning a trip home.</p>
                <p><strong>Prohibited Items:</strong> Smoking, consumption of alcohol, and illegal substances are strictly prohibited in the hostel premises.</p>
                <p><strong>Pets:</strong> Keeping pets in the hostel rooms or premises is not allowed.</p>
                <p><strong>Medical Needs:</strong> Students should seek immediate help from hostel authorities if they fall ill.</p>
              </div>
              <p style="margin-top:var(--space-3)"><strong>Emergency Protocol:</strong> In emergencies, if wardens are temporarily unavailable, follow instructions from security personnel or hostel staff without hesitation.</p>
            </div>

            <div class="content-box">
              <h2>Anti-Ragging Policy</h2>
              <p>IISER Kolkata maintains a strict <strong>Zero Tolerance Policy</strong> towards ragging.</p>
              <div class="indent-group">
                <p>An <strong>Anti-Ragging Vigil Team</strong> conducts surprise checks and visits hostels regularly between <strong>9:30 PM and 11:00 PM</strong>.</p>
                <p>Hostel Wardens may also inspect hostels at night to ensure a safe environment.</p>
              </div>
            </div>
          </div>

          <!-- TAB 5: COMPLAINTS & MAINTENANCE -->
          <div class="tab-pane" id="tab-complaints">

            <div class="content-box">
              <h2>Raise a Maintenance Request</h2>
              <p>Submit issues directly to the facilities team. Routine requests are resolved within 48 hours.</p>

              <form class="maint-form" onsubmit="return false;">
                <div class="form-row" style="margin-bottom:15px">
                  <label for="hostelBlock" style="display:block;margin-bottom:5px;font-weight:600;font-size:0.9rem">Hostel &amp; room number</label>
                  <input type="text" id="hostelBlock" placeholder="e.g. Nivedita — Room 214" style="width:100%;padding:10px;border:1px solid #ccc;border-radius:4px;">
                </div>
                <div class="form-row" style="margin-bottom:15px">
                  <label for="issueCategory" style="display:block;margin-bottom:5px;font-weight:600;font-size:0.9rem">Issue category</label>
                  <select id="issueCategory" style="width:100%;padding:10px;border:1px solid #ccc;border-radius:4px;">
                    <option>Electrical</option>
                    <option>Plumbing</option>
                    <option>Furniture</option>
                    <option>Housekeeping</option>
                    <option>Internet / Wi-Fi</option>
                    <option>Other</option>
                  </select>
                </div>
                <div class="form-row" style="margin-bottom:15px">
                  <label style="display:block;margin-bottom:5px;font-weight:600;font-size:0.9rem">Priority</label>
                  <div class="priority-group">
                    <label class="priority-opt"><input type="radio" name="priority" checked><span>Low</span></label>
                    <label class="priority-opt"><input type="radio" name="priority"><span>Medium</span></label>
                    <label class="priority-opt"><input type="radio" name="priority"><span>Urgent</span></label>
                  </div>
                </div>
                <div class="form-row" style="margin-bottom:15px">
                  <label for="issueDesc" style="display:block;margin-bottom:5px;font-weight:600;font-size:0.9rem">Describe the issue</label>
                  <textarea id="issueDesc" placeholder="Tell us what's wrong and where exactly it's located..." style="width:100%;padding:10px;border:1px solid #ccc;border-radius:4px;min-height:80px;"></textarea>
                </div>
                <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;border:none;cursor:pointer"><i class="fa-solid fa-paper-plane"></i> Submit Request</button>
              </form>
            </div>

            <div class="content-box">
              <h2>Whom to Contact Matrix</h2>
              <p>For various issues, follow this structured communication matrix:</p>

              <div style="overflow-x:auto;">
                <table class="matrix-table">
                  <thead>
                    <tr>
                      <th>Issue</th>
                      <th>First Point of Contact</th>
                      <th>Escalation Authority</th>
                      <th>CC Hierarchy</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><strong>Maintenance</strong></td>
                      <td>Facilities Helpdesk</td>
                      <td>Hostel Warden</td>
                      <td>Hostel Assistants</td>
                    </tr>
                    <tr>
                      <td><strong>Cleanliness</strong></td>
                      <td>Hostel Attendants</td>
                      <td>Hostel Warden</td>
                      <td>SAC GS Hostel</td>
                    </tr>
                    <tr>
                      <td><strong>Mess / Food Hygiene</strong></td>
                      <td>Mess Manager</td>
                      <td>Mess Warden</td>
                      <td>SAC GS Hostel</td>
                    </tr>
                    <tr>
                      <td><strong>Medical Issues</strong></td>
                      <td>Medical Center</td>
                      <td>Hostel Warden</td>
                      <td>Chief Warden</td>
                    </tr>
                    <tr>
                      <td><strong>Accommodation</strong></td>
                      <td>Hostel Assistants</td>
                      <td>Assoc. Dean (Hostel)</td>
                      <td>Chief Warden</td>
                    </tr>
                    <tr>
                      <td><strong>Discipline</strong></td>
                      <td>Hostel Warden</td>
                      <td>Chief Warden</td>
                      <td>Dean of Students</td>
                    </tr>
                    <tr>
                      <td><strong>Transport</strong></td>
                      <td>Transport Office</td>
                      <td>Admin Officer</td>
                      <td>SAC GS Transport</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="content-box">
              <h2>Grievance Escalation Workflow</h2>
              <p>If your complaint is not resolved, please follow this tier-based escalation mechanism:</p>

              <h3>Tier 1 (Initial Resolution)</h3>
              <div class="indent-group">
                <p>Enter issue in <strong>Complaint Register</strong></p>
                <p>Contact <strong>Hostel Attendants / Assistants</strong></p>
                <p>Reach out to <strong>Hostel Representatives</strong> or <strong>GS Hostel</strong></p>
              </div>

              <h3>Tier 2 (Escalation)</h3>
              <p>If unresolved at Tier 1, escalate in this order:</p>
              <div class="indent-group">
                <p><strong>1.</strong> Respective Hostel Warden</p>
                <p><strong>2.</strong> Associate Chief Warden</p>
                <p><strong>3.</strong> Chief Warden</p>
                <p><strong>4.</strong> Associate Dean of Students (Hostel)</p>
                <p><strong>5.</strong> Dean of Students</p>
              </div>

              <h3>SAC Hostel &amp; Transport Representatives</h3>
              <p>You can also reach out to student representatives from the Students' Affairs Council for peer support regarding hostel and transport matters. Check the SAC directory for their contact numbers and emails.</p>
            </div>
          </div>

          <!-- TAB 6: FEES & ALLOTMENT -->
          <div class="tab-pane" id="tab-fees">

            <div class="content-box">
              <h2>Hostel Fee Structure</h2>
              <p>Fees are billed per semester and must be cleared to retain your allotted room.</p>

              <div style="overflow-x:auto;">
                <table class="fee-table">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Room Rent</th>
                      <th>Mess Advance</th>
                      <th>Establishment</th>
                      <th>Due Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Undergraduate (Shared)</td>
                      <td>₹9,500</td>
                      <td>₹18,000</td>
                      <td>₹2,200</td>
                      <td class="due">31 Jul 2026</td>
                    </tr>
                    <tr>
                      <td>Undergraduate (Single)</td>
                      <td>₹14,000</td>
                      <td>₹18,000</td>
                      <td>₹2,200</td>
                      <td class="due">31 Jul 2026</td>
                    </tr>
                    <tr>
                      <td>PG / Research Scholar</td>
                      <td>₹11,500</td>
                      <td>₹20,000</td>
                      <td>₹2,500</td>
                      <td class="due">05 Aug 2026</td>
                    </tr>
                    <tr>
                      <td>International Students</td>
                      <td>₹16,000</td>
                      <td>₹20,000</td>
                      <td>₹2,500</td>
                      <td class="due">05 Aug 2026</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
    /* ================= TAB SWITCHING LOGIC ================= */
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    function switchTab(targetId) {
      // Remove active from all
      tabBtns.forEach(btn => btn.classList.remove('active'));
      tabPanes.forEach(pane => pane.classList.remove('active'));

      // Add active to target
      const targetBtn = document.querySelector(`.tab-btn[data-target="${targetId}"]`);
      const targetPane = document.getElementById(targetId);

      if (targetBtn && targetPane) {
        targetBtn.classList.add('active');
        targetPane.classList.add('active');
        
        // Scroll to the top of the page when switching tabs
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      }
    }

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        switchTab(btn.dataset.target);
      });
    });

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