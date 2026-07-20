<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Achievements — Students' Affairs Office, IISER</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/student-achievements.css">
</head>
<body>

<a href="#main" class="skip-link">Skip to main content</a>

<?php include __DIR__ . '/../components/navbar.php'; ?>

<div id="mobile-drawer-placeholder"></div>

<main id="main">

<!-- ============ PAGE HERO ============ -->
<section class="page-hero">
  <div class="container page-hero-inner">
    <div class="breadcrumb"><a href="index.html">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:.6rem"></i> <a href="index.html#services">Services</a> <i class="fa-solid fa-chevron-right" style="font-size:.6rem"></i> <span>Student Achievements</span></div>
    <span class="eyebrow" style="color:var(--gold-500)">Celebrating our students</span>
    <h1>Student Achievements</h1>
    <p class="lede">From national medals to peer-reviewed papers, from stage performances to community service — this is where we celebrate what IISER students accomplish, on campus and beyond.</p>

    <div class="hero-cta">
      <a href="#submit" class="btn btn-gold"><i class="fa-solid fa-award"></i> Submit Your Achievement</a>
      <a href="#wall" class="btn btn-outline"><i class="fa-solid fa-star"></i> View Wall of Fame</a>
    </div>

    <div class="hero-stats">
      <div class="hero-stat"><div class="num">340+</div><div class="lbl">Achievements logged this year</div></div>
      <div class="hero-stat"><div class="num">28</div><div class="lbl">National &amp; international medals</div></div>
      <div class="hero-stat"><div class="num">96</div><div class="lbl">Published research papers</div></div>
      <div class="hero-stat"><div class="num">₹42L</div><div class="lbl">Scholarships &amp; grants won</div></div>
    </div>
  </div>
</section>

<!-- ============ FEATURED SPOTLIGHT ============ -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Achievement of the month</span>
      <h2>Featured spotlight</h2>
    </div>
    <div class="spotlight">
      <div class="spotlight-photo">
        <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=700&q=80" alt="Student presenting research at an international conference">
        <span class="badge"><i class="fa-solid fa-flask"></i> Research</span>
      </div>
      <div class="spotlight-body">
        <span class="cat">International Recognition</span>
        <h3>Final-year student wins Best Paper Award at the International Conference on Quantum Materials</h3>
        <p>Ananya Bhattacharya (BS-MS, Batch of 2026) received the Best Paper Award for her work on topological insulators, competing against submissions from over 40 countries. Her research was conducted under the Physics department's condensed matter group.</p>
        <div class="spotlight-meta">
          <span><i class="fa-solid fa-user"></i> Ananya Bhattacharya, BS-MS 2026</span>
          <span><i class="fa-solid fa-calendar"></i> June 2026</span>
          <span><i class="fa-solid fa-location-dot"></i> Singapore</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ ACHIEVEMENTS GRID ============ -->
<section class="section section-alt">
  <div class="container">
    <div class="section-head flex-head">
      <div>
        <span class="eyebrow">Recent achievements</span>
        <h2>Browse by category</h2>
      </div>
    </div>

    <div class="filter-bar" role="tablist" aria-label="Achievement filters">
      <button class="filter-chip active" data-filter="all">All</button>
      <button class="filter-chip" data-filter="academic">Academic</button>
      <button class="filter-chip" data-filter="sports">Sports</button>
      <button class="filter-chip" data-filter="cultural">Cultural</button>
      <button class="filter-chip" data-filter="research">Research &amp; Innovation</button>
      <button class="filter-chip" data-filter="social">Social Impact</button>
    </div>

    <div class="ach-grid" id="achGrid"></div>
  </div>
</section>

<!-- ============ YEARLY HIGHLIGHTS ============ -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Year in review</span>
      <h2>2025–26 highlights</h2>
    </div>
    <div class="timeline">
      <div class="tl-item">
        <div class="tl-dot">Aug</div>
        <h4>Inter-IISER Sports Meet — Overall Championship</h4>
        <p>Our contingent brought home the overall trophy for the second consecutive year, with 14 gold medals across athletics, swimming, and badminton.</p>
      </div>
      <div class="tl-item">
        <div class="tl-dot">Nov</div>
        <h4>National Science Olympiad — 3 students shortlisted for international team</h4>
        <p>Three undergraduates cleared the national camp for the International Physics and Chemistry Olympiad selection process.</p>
      </div>
      <div class="tl-item">
        <div class="tl-dot">Feb</div>
        <h4>Confluence Cultural Fest — Best Delegation, Zonal Round</h4>
        <p>The cultural society's contingent won Best Delegation at the zonal inter-collegiate fest, sweeping street play and classical dance categories.</p>
      </div>
      <div class="tl-item">
        <div class="tl-dot">May</div>
        <h4>Student-led startup secures seed funding</h4>
        <p>A biotech venture incubated at IISER's innovation cell closed a seed round to commercialize a low-cost water-quality sensor.</p>
      </div>
      <div class="tl-item">
        <div class="tl-dot">Jun</div>
        <h4>Best Paper Award at ICQM 2026</h4>
        <p>Featured spotlight achievement — see above.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ WALL OF FAME ============ -->
<section class="section section-alt" id="wall">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Recognized this year</span>
      <h2>Wall of Fame</h2>
      <p>A running record of students who've represented IISER with distinction.</p>
    </div>
    <div class="fame-grid">
      <div class="fame-card">
        <div class="fame-photo"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&q=70" alt=""></div>
        <div class="name">Ananya Bhattacharya</div>
        <div class="achievement">Best Paper, ICQM 2026</div>
        <div class="fame-icon"><i class="fa-solid fa-trophy"></i></div>
      </div>
      <div class="fame-card">
        <div class="fame-photo"><img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&q=70" alt=""></div>
        <div class="name">Rohan Verma</div>
        <div class="achievement">Gold, 400m — Inter-IISER Meet</div>
        <div class="fame-icon"><i class="fa-solid fa-medal"></i></div>
      </div>
      <div class="fame-card">
        <div class="fame-photo"><img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=200&q=70" alt=""></div>
        <div class="name">Sneha Iyer</div>
        <div class="achievement">National Physics Olympiad Camp</div>
        <div class="fame-icon"><i class="fa-solid fa-star"></i></div>
      </div>
      <div class="fame-card">
        <div class="fame-photo"><img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=200&q=70" alt=""></div>
        <div class="name">Kabir Singh</div>
        <div class="achievement">Founder, water-sensor startup</div>
        <div class="fame-icon"><i class="fa-solid fa-lightbulb"></i></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SUBMIT YOUR ACHIEVEMENT ============ -->
<section class="section" id="submit">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Have something to share?</span>
      <h2>Submit your achievement</h2>
      <p>Tell us about a competition, publication, award, or milestone — we feature select submissions on this page and in the monthly SAO newsletter.</p>
    </div>

    <div class="submit-wrap">
      <form class="submit-form" onsubmit="return false;">
        <div class="form-row-2">
          <div class="form-row">
            <label for="studentName">Full name</label>
            <input type="text" id="studentName" placeholder="Your name">
          </div>
          <div class="form-row">
            <label for="studentBatch">Batch / programme</label>
            <input type="text" id="studentBatch" placeholder="e.g. BS-MS 2027">
          </div>
        </div>
        <div class="form-row">
          <label for="achCategory">Category</label>
          <select id="achCategory">
            <option>Academic</option>
            <option>Sports</option>
            <option>Cultural</option>
            <option>Research &amp; Innovation</option>
            <option>Social Impact</option>
          </select>
        </div>
        <div class="form-row">
          <label for="achTitle">Achievement title</label>
          <input type="text" id="achTitle" placeholder="e.g. Gold medal at National Chess Championship">
        </div>
        <div class="form-row">
          <label for="achDesc">Tell us more</label>
          <textarea id="achDesc" placeholder="Where, when, and what did this involve?"></textarea>
        </div>
        <div class="form-row">
          <label>Supporting photo or certificate</label>
          <div class="upload-drop"><i class="fa-solid fa-cloud-arrow-up"></i>Drag a file here, or click to browse</div>
        </div>
        <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;"><i class="fa-solid fa-paper-plane"></i> Submit for Review</button>
      </form>

      <div class="submit-notes">
        <h3>How submissions are reviewed</h3>
        <ul>
          <li><i class="fa-solid fa-circle-check"></i> Submissions are reviewed by the SAO engagement team within 5 working days.</li>
          <li><i class="fa-solid fa-circle-check"></i> Selected achievements are published on this page, the homepage notice widget, and social media.</li>
          <li><i class="fa-solid fa-circle-check"></i> Outstanding achievements may be nominated for institute-level recognition at Convocation.</li>
          <li><i class="fa-solid fa-circle-check"></i> Please include verifiable proof (certificate, publication link, or official result).</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">In their words</span>
      <h2>What students say</h2>
    </div>
    <div class="quote-grid">
      <div class="quote-card">
        <p>Being featured on the Wall of Fame gave my research the visibility it needed — a recruiter actually reached out after seeing it.</p>
        <div class="quote-who">
          <div class="quote-avatar"><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=70" alt=""></div>
          <div><div class="name">Ananya Bhattacharya</div><div class="tag">BS-MS, Physics</div></div>
        </div>
      </div>
      <div class="quote-card">
        <p>The SAO helped coordinate travel and leave approvals for the national meet within days. That support made all the difference.</p>
        <div class="quote-who">
          <div class="quote-avatar"><img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=70" alt=""></div>
          <div><div class="name">Rohan Verma</div><div class="tag">BS-MS, Biology</div></div>
        </div>
      </div>
      <div class="quote-card">
        <p>Submitting my startup's milestone here connected me with two mentors from the alumni network. Simple process, real impact.</p>
        <div class="quote-who">
          <div class="quote-avatar"><img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=100&q=70" alt=""></div>
          <div><div class="name">Kabir Singh</div><div class="tag">BS-MS, Chemistry</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA BAND ============ -->
<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h3>Know a student who deserves recognition?</h3>
        <p>Nominate a peer, or explore clubs and societies that could help you get there.</p>
      </div>
      <div class="cta-actions">
        <a href="#submit" class="btn btn-gold"><i class="fa-solid fa-award"></i> Nominate a Student</a>
        <a href="#" class="btn btn-outline"><i class="fa-solid fa-masks-theater"></i> Explore Clubs &amp; Societies</a>
      </div>
    </div>
  </div>
</section>

</main>

<?php include __DIR__ . '/../components/footer.php'; ?>

<script>
/* ================= ACHIEVEMENTS DATA ================= */
const achData=[
  {cat:'academic',tag:'Academic',title:'All-India Rank 2 in Chemical Sciences GATE 2026',name:'Devika Menon',batch:'BS-MS 2026',date:'Mar 2026',img:'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500&q=70',avatar:'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&q=70'},
  {cat:'sports',tag:'Sports',title:'Gold medal, 400m sprint — Inter-IISER Sports Meet',name:'Rohan Verma',batch:'BS-MS 2027',date:'Aug 2025',img:'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=500&q=70',avatar:'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=70'},
  {cat:'cultural',tag:'Cultural',title:'Best Choreographer, Confluence Cultural Fest',name:'Ishaan Kapoor',batch:'BS-MS 2028',date:'Feb 2026',img:'https://images.unsplash.com/photo-1498243691581-8ee0c72c15ca?w=500&q=70',avatar:'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=70'},
  {cat:'research',tag:'Research',title:'Best Paper Award, International Conference on Quantum Materials',name:'Ananya Bhattacharya',batch:'BS-MS 2026',date:'Jun 2026',img:'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=500&q=70',avatar:'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=70'},
  {cat:'social',tag:'Social Impact',title:'Led a rural literacy drive reaching 300+ children',name:'Fatima Ansari',batch:'BS-MS 2027',date:'Dec 2025',img:'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=500&q=70',avatar:'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=70'},
  {cat:'research',tag:'Research',title:'Seed funding secured for water-quality sensor startup',name:'Kabir Singh',batch:'BS-MS 2026',date:'May 2026',img:'https://images.unsplash.com/photo-1581091870622-2c9b0e2c6f4b?w=500&q=70',avatar:'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=100&q=70'},
  {cat:'academic',tag:'Academic',title:'Selected for National Physics Olympiad training camp',name:'Sneha Iyer',batch:'BS-MS 2028',date:'Nov 2025',img:'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=500&q=70',avatar:'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=70'},
  {cat:'sports',tag:'Sports',title:'State-level Chess Championship — Gold',name:'Arjun Nair',batch:'BS-MS 2029',date:'Jan 2026',img:'https://images.unsplash.com/photo-1529699211952-734e80c4d42b?w=500&q=70',avatar:'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&q=70'},
  {cat:'cultural',tag:'Cultural',title:"Published debut poetry collection",name:'Meher Kaur',batch:'BS-MS 2027',date:'Apr 2026',img:'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=500&q=70',avatar:'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=70'}
];
const achGrid=document.getElementById('achGrid');
function renderAch(filter){
  achGrid.innerHTML='';
  const items = filter==='all' ? achData : achData.filter(a=>a.cat===filter);
  items.forEach(a=>{
    const el=document.createElement('div');
    el.className='ach-card';
    el.innerHTML=`
      <div class="ach-photo">
        <img src="${a.img}" alt="${a.title}" loading="lazy">
        <span class="ach-cat-tag ${a.cat}">${a.tag}</span>
      </div>
      <div class="ach-body">
        <h4>${a.title}</h4>
        <div class="student">
          <div class="ach-avatar"><img src="${a.avatar}" alt=""></div>
          <div><div class="s-name">${a.name}</div><div class="s-batch">${a.batch}</div></div>
          <span class="date">${a.date}</span>
        </div>
      </div>`;
    achGrid.appendChild(el);
  });
}
renderAch('all');
document.querySelectorAll('.filter-chip').forEach(chip=>{
  chip.addEventListener('click',()=>{
    document.querySelectorAll('.filter-chip').forEach(c=>c.classList.remove('active'));
    chip.classList.add('active');
    renderAch(chip.dataset.filter);
  });
});
</script>
<script src="../layout/include.js"></script>

</body>
</html>