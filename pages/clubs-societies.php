<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clubs & Societies — Students' Affairs Office, IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/clubs-societies.css">
</head>

<body>

  <a href="#main" class="skip-link">Skip to main content</a>

  <?php include __DIR__ . '/../components/navbar.php'; ?>

  <div id="mobile-drawer-placeholder"></div>

  <main id="main">

    <!-- ============ PAGE HERO ============ -->
    <section class="page-hero">
      <div class="container page-hero-inner">
        <div class="breadcrumb"><a href="index.html">Home</a> <i class="fa-solid fa-chevron-right"
            style="font-size:.6rem"></i> <a href="index.html#services">Services</a> <i class="fa-solid fa-chevron-right"
            style="font-size:.6rem"></i> <span>Clubs &amp; Societies</span></div>
        <span class="eyebrow" style="color:var(--gold-500)">Beyond the classroom</span>
        <h1>Clubs &amp; Societies</h1>
        <p class="lede">Over 60 student-run clubs and societies across technology, culture, the arts, sport, and social
          impact — every one of them a place to find your people.</p>

        <div class="hero-cta">
          <a href="#directory" class="btn btn-gold"><i class="fa-solid fa-compass"></i> Browse All Clubs</a>
          <a href="#start" class="btn btn-outline"><i class="fa-solid fa-plus"></i> Start a New Club</a>
        </div>

        <div class="hero-stats">
          <div class="hero-stat">
            <div class="num">62</div>
            <div class="lbl">Active clubs &amp; societies</div>
          </div>
          <div class="hero-stat">
            <div class="num">4,100+</div>
            <div class="lbl">Student memberships</div>
          </div>
          <div class="hero-stat">
            <div class="num">180+</div>
            <div class="lbl">Events run per year</div>
          </div>
          <div class="hero-stat">
            <div class="num">6</div>
            <div class="lbl">Broad categories</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ FEATURED SPOTLIGHT ============ -->
    <section class="section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Club of the month</span>
          <h2>Featured spotlight</h2>
        </div>
        <div class="spotlight">
          <div class="spotlight-photo">
            <img src="https://images.unsplash.com/photo-1581091870622-2c9b0e2c6f4b?w=700&q=80"
              alt="Robotics club members working on a robot prototype">
            <span class="badge"><i class="fa-solid fa-microchip"></i> Technical</span>
          </div>
          <div class="spotlight-body">
            <span class="cat">Technology &amp; Innovation</span>
            <h3>Robotics &amp; Automation Society builds its first autonomous rover for Inter-IISER Tech Fest</h3>
            <p>Founded in 2019, the Robotics &amp; Automation Society has grown to 140 active members. This semester,
              the team designed and built a fully autonomous rover that took second place at the Inter-IISER Tech Fest —
              entirely student-engineered, from chassis to control software.</p>
            <div class="spotlight-meta">
              <span><i class="fa-solid fa-users"></i> 140 members</span>
              <span><i class="fa-solid fa-calendar"></i> Meets Tuesdays &amp; Fridays</span>
              <span><i class="fa-solid fa-location-dot"></i> Innovation Lab, Block C</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ CLUB DIRECTORY ============ -->
    <section class="section section-alt" id="directory">
      <div class="container">
        <div class="section-head flex-head">
          <div>
            <span class="eyebrow">Find your community</span>
            <h2>Club directory</h2>
          </div>
        </div>

        <div class="filter-bar" role="tablist" aria-label="Club filters">
          <button class="filter-chip active" data-filter="all">All</button>
          <button class="filter-chip" data-filter="technical">Technical</button>
          <button class="filter-chip" data-filter="cultural">Cultural</button>
          <button class="filter-chip" data-filter="arts">Arts &amp; Literary</button>
          <button class="filter-chip" data-filter="social">Social Impact</button>
          <button class="filter-chip" data-filter="sports">Sports</button>
          <button class="filter-chip" data-filter="special">Special Interest</button>
        </div>

        <div class="club-grid" id="clubGrid"></div>
      </div>
    </section>

    <!-- ============ UPCOMING EVENTS ============ -->
    <section class="section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">What's coming up</span>
          <h2>Upcoming club events</h2>
        </div>
        <div class="events-list">
          <div class="event-row">
            <div class="event-date">
              <div class="d">18</div>
              <div class="m">Jul</div>
            </div>
            <div class="event-info">
              <h4>Robotics Society — Open Build Night</h4>
              <div class="meta"><span><i class="fa-solid fa-clock"></i> 6:00 PM – 9:00 PM</span><span><i
                    class="fa-solid fa-location-dot"></i> Innovation Lab, Block C</span></div>
            </div>
            <span class="event-tag">Technical</span>
          </div>
          <div class="event-row">
            <div class="event-date">
              <div class="d">21</div>
              <div class="m">Jul</div>
            </div>
            <div class="event-info">
              <h4>Dramatics Society — Auditions for Autumn Production</h4>
              <div class="meta"><span><i class="fa-solid fa-clock"></i> 4:00 PM – 7:00 PM</span><span><i
                    class="fa-solid fa-location-dot"></i> Amphitheatre</span></div>
            </div>
            <span class="event-tag">Cultural</span>
          </div>
          <div class="event-row">
            <div class="event-date">
              <div class="d">25</div>
              <div class="m">Jul</div>
            </div>
            <div class="event-info">
              <h4>Environment Collective — Campus Clean-Up Drive</h4>
              <div class="meta"><span><i class="fa-solid fa-clock"></i> 7:00 AM – 9:00 AM</span><span><i
                    class="fa-solid fa-location-dot"></i> Assembly at Main Gate</span></div>
            </div>
            <span class="event-tag">Social Impact</span>
          </div>
          <div class="event-row">
            <div class="event-date">
              <div class="d">02</div>
              <div class="m">Aug</div>
            </div>
            <div class="event-info">
              <h4>Photography Club — Golden Hour Walk &amp; Workshop</h4>
              <div class="meta"><span><i class="fa-solid fa-clock"></i> 5:30 PM – 7:30 PM</span><span><i
                    class="fa-solid fa-location-dot"></i> Campus Green Quadrangle</span></div>
            </div>
            <span class="event-tag">Arts &amp; Literary</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ START A CLUB ============ -->
    <section class="section section-alt" id="start">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Got an idea?</span>
          <h2>Start a new club or society</h2>
          <p>Don't see something that fits? Here's how to officially register a new student body.</p>
        </div>
        <div class="process-grid">
          <div class="process-step">
            <div class="process-num">1</div>
            <h4>Gather Members</h4>
            <p>Find at least 15 interested students and a faculty advisor willing to mentor the group.</p>
          </div>
          <div class="process-step">
            <div class="process-num">2</div>
            <h4>Submit Proposal</h4>
            <p>Fill out the club registration form with your charter, goals, and planned activities.</p>
          </div>
          <div class="process-step">
            <div class="process-num">3</div>
            <h4>SAC Review</h4>
            <p>The Students' Activity Council reviews the proposal for overlap and feasibility.</p>
          </div>
          <div class="process-step">
            <div class="process-num">4</div>
            <h4>Get Recognized</h4>
            <p>Approved clubs receive a budget allocation, a campus venue, and listing on this page.</p>
          </div>
        </div>
        <div style="margin-top:var(--space-4);display:flex;gap:var(--space-2);flex-wrap:wrap;">
          <a href="#" class="btn btn-navy"><i class="fa-solid fa-file-signature"></i> Download Registration Form</a>
          <a href="#" class="btn btn-ghost"><i class="fa-solid fa-comments"></i> Talk to the SAC</a>
        </div>
      </div>
    </section>

    <!-- ============ COUNCIL CONTACTS ============ -->
    <section class="section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Who to contact</span>
          <h2>Students' Activity Council</h2>
        </div>
        <div class="staff-grid">
          <div class="staff-card">
            <div class="staff-top">
              <div class="staff-avatar"><img
                  src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=120&q=70" alt=""></div>
              <div>
                <div class="staff-name">Aditi Rao</div>
                <div class="staff-role">SAC General Secretary</div>
              </div>
            </div>
            <div class="staff-actions"><a href="mailto:sac.gensec@iiser.ac.in"><i class="fa-solid fa-envelope"></i>
                Email</a><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></div>
          </div>
          <div class="staff-card">
            <div class="staff-top">
              <div class="staff-avatar"><img
                  src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=120&q=70" alt=""></div>
              <div>
                <div class="staff-name">Nikhil Choudhary</div>
                <div class="staff-role">Technical Clubs Coordinator</div>
              </div>
            </div>
            <div class="staff-actions"><a href="mailto:sac.tech@iiser.ac.in"><i class="fa-solid fa-envelope"></i>
                Email</a><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></div>
          </div>
          <div class="staff-card">
            <div class="staff-top">
              <div class="staff-avatar"><img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=120&q=70"
                  alt=""></div>
              <div>
                <div class="staff-name">Priyanka Das</div>
                <div class="staff-role">Cultural &amp; Arts Coordinator</div>
              </div>
            </div>
            <div class="staff-actions"><a href="mailto:sac.cultural@iiser.ac.in"><i class="fa-solid fa-envelope"></i>
                Email</a><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></div>
          </div>
          <div class="staff-card">
            <div class="staff-top">
              <div class="staff-avatar"><img
                  src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=120&q=70" alt=""></div>
              <div>
                <div class="staff-name">Dr. Meera Nair</div>
                <div class="staff-role">Faculty Advisor, SAC</div>
              </div>
            </div>
            <div class="staff-actions"><a href="mailto:sac.advisor@iiser.ac.in"><i class="fa-solid fa-envelope"></i>
                Email</a><a href="tel:0112345695"><i class="fa-solid fa-phone"></i> Call</a></div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ CTA BAND ============ -->
    <section class="section">
      <div class="container">
        <div class="cta-band">
          <div>
            <h3>Ready to get involved?</h3>
            <p>Join a club this week, or bring your own idea to life with SAC support.</p>
          </div>
          <div class="cta-actions">
            <a href="#directory" class="btn btn-gold"><i class="fa-solid fa-compass"></i> Browse All Clubs</a>
            <a href="index.html#footer" class="btn btn-outline"><i class="fa-solid fa-envelope"></i> Contact Us</a>
          </div>
        </div>
      </div>
    </section>

  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>

  <script>
    /* ================= CLUB DIRECTORY DATA ================= */
    const clubData = [
      { cat: 'technical', icon: 'fa-microchip', name: 'Robotics &amp; Automation Society', desc: 'Building autonomous systems, from line-followers to competition-grade rovers.', members: '140', meets: 'Tue &amp; Fri, 6 PM', venue: 'Innovation Lab' },
      { cat: 'technical', icon: 'fa-code', name: 'Competitive Programming Club', desc: 'Weekly contests, algorithm workshops, and ICPC team training.', members: '95', meets: 'Wed, 7 PM', venue: 'CS Lab 2' },
      { cat: 'cultural', icon: 'fa-masks-theater', name: 'Dramatics Society', desc: 'Stage productions, street plays, and an annual original script showcase.', members: '80', meets: 'Mon &amp; Thu, 5 PM', venue: 'Amphitheatre' },
      { cat: 'cultural', icon: 'fa-music', name: 'Music &amp; Bands Collective', desc: 'Indian classical, western bands, and open-mic nights every month.', members: '110', meets: 'Sat, 4 PM', venue: 'Music Room' },
      { cat: 'arts', icon: 'fa-feather', name: 'Literary &amp; Debating Society', desc: 'Poetry slams, creative writing circles, and inter-collegiate debate meets.', members: '70', meets: 'Tue, 6 PM', venue: 'Seminar Hall 1' },
      { cat: 'arts', icon: 'fa-camera', name: 'Photography Club', desc: 'Golden-hour walks, gear workshops, and an annual campus photo exhibit.', members: '88', meets: 'Sun, 5:30 PM', venue: 'Media Room' },
      { cat: 'social', icon: 'fa-leaf', name: 'Environment Collective', desc: 'Campus sustainability audits, clean-up drives, and a student organic garden.', members: '64', meets: 'Fri, 7 AM', venue: 'Main Gate' },
      { cat: 'social', icon: 'fa-hand-holding-heart', name: 'Community Outreach Cell', desc: 'Weekend teaching programmes at nearby government schools.', members: '102', meets: 'Sat, 9 AM', venue: 'Village Outreach Van' },
      { cat: 'sports', icon: 'fa-futbol', name: 'Football Club', desc: 'Inter-hostel league organizer and Inter-IISER tournament squad.', members: '130', meets: 'Daily, 6 AM', venue: 'Sports Ground' },
      { cat: 'sports', icon: 'fa-chess', name: 'Chess &amp; Board Games Club', desc: 'Casual play, rated tournaments, and a growing bridge circle.', members: '56', meets: 'Wed, 8 PM', venue: 'Student Common Room' },
      { cat: 'special', icon: 'fa-flask', name: 'Astronomy &amp; Skywatching Club', desc: 'Telescope nights, eclipse-watch camps, and a working campus observatory.', members: '48', meets: 'New Moon nights', venue: 'Rooftop Observatory' },
      { cat: 'special', icon: 'fa-utensils', name: 'Culinary Exchange Club', desc: 'Regional cooking workshops and a termly potluck across hostels.', members: '72', meets: 'Sun, 4 PM', venue: 'Mess Annexe' }
    ];
    const catLabels = { technical: 'Technical', cultural: 'Cultural', arts: 'Arts &amp; Literary', social: 'Social Impact', sports: 'Sports', special: 'Special Interest' };
    const iconClassByCat = { technical: '', cultural: 'cultural', arts: 'cultural', social: 'social', sports: 'sports', special: '' };
    const clubGrid = document.getElementById('clubGrid');
    function renderClubs(filter) {
      clubGrid.innerHTML = '';
      const items = filter === 'all' ? clubData : clubData.filter(c => c.cat === filter);
      items.forEach(c => {
        const el = document.createElement('div');
        el.className = 'club-card';
        el.innerHTML = `
      <div class="club-top">
        <div class="club-icon ${iconClassByCat[c.cat]}"><i class="fa-solid ${c.icon}"></i></div>
        <div class="club-titles">
          <h4>${c.name}</h4>
          <span class="club-cat-tag">${catLabels[c.cat]}</span>
        </div>
      </div>
      <p class="club-desc">${c.desc}</p>
      <div class="club-meta">
        <span><i class="fa-solid fa-users"></i> ${c.members} members</span>
        <span><i class="fa-solid fa-clock"></i> ${c.meets}</span>
        <span><i class="fa-solid fa-location-dot"></i> ${c.venue}</span>
      </div>
      <div class="club-footer">
        <a href="#">View club page <i class="fa-solid fa-arrow-right"></i></a>
      </div>`;
        clubGrid.appendChild(el);
      });
    }
    renderClubs('all');
    document.querySelectorAll('.filter-chip').forEach(chip => {
      chip.addEventListener('click', () => {
        document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        renderClubs(chip.dataset.filter);
      });
    });
  </script>
  <script src="../layout/include.js"></script>

</body>

</html>