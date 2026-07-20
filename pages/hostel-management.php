<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hostel Management — Students' Affairs Office, IISER</title>
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
<section class="page-hero">
  <div class="container page-hero-inner">
    <div>
      <div class="breadcrumb"><a href="../index.html">Home</a> <i class="fa-solid fa-chevron-right" style="font-size:.6rem"></i> <a href="../index.html#services">Services</a> <i class="fa-solid fa-chevron-right" style="font-size:.6rem"></i> <span>Hostel Management</span></div>
      <span class="eyebrow" style="color:var(--gold-500)">Living on campus</span>
      <h1>Hostel Management</h1>
      <p class="lede">Everything to do with where you live — room allotment, warden contacts, maintenance requests, mess and fee information, and hostel rules — in one place.</p>
      <div class="hero-cta">
        <a href="#allotment" class="btn btn-gold"><i class="fa-solid fa-key"></i> Check Allotment Status</a>
        <a href="#maintenance" class="btn btn-outline"><i class="fa-solid fa-screwdriver-wrench"></i> Raise Maintenance Request</a>
      </div>
    </div>

    <div class="occupancy-card">
      <h3><i class="fa-solid fa-chart-simple" style="color:var(--gold-500)"></i> Live Occupancy Overview</h3>
      <div class="occ-item">
        <div class="occ-row"><span>Boys' Hostels (BH1–BH4)</span><span>92%</span></div>
        <div class="occ-bar"><div class="occ-fill" style="width:92%"></div></div>
      </div>
      <div class="occ-item">
        <div class="occ-row"><span>Girls' Hostels (GH1–GH2)</span><span>88%</span></div>
        <div class="occ-bar"><div class="occ-fill" style="width:88%"></div></div>
      </div>
      <div class="occ-item">
        <div class="occ-row"><span>PG / Research Scholar Block</span><span>97%</span></div>
        <div class="occ-bar"><div class="occ-fill warn" style="width:97%"></div></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ QUICK ACTIONS ============ -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Quick actions</span>
      <h2>What would you like to do?</h2>
    </div>
    <div class="quick-grid">
      <div class="quick-card">
        <div class="ic"><i class="fa-solid fa-key"></i></div>
        <h4>Room Allotment</h4>
        <p>Apply for a room, check allotment status, or request a room change.</p>
        <a class="card-link" href="#allotment">Go to allotment <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="quick-card">
        <div class="ic"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        <h4>Maintenance Request</h4>
        <p>Report a plumbing, electrical, furniture, or housekeeping issue.</p>
        <a class="card-link" href="#maintenance">Raise a request <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="quick-card">
        <div class="ic"><i class="fa-solid fa-indian-rupee-sign"></i></div>
        <h4>Hostel Fees</h4>
        <p>View the fee structure, due dates, and payment receipts.</p>
        <a class="card-link" href="#fees">View fee details <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <div class="quick-card">
        <div class="ic"><i class="fa-solid fa-book-open"></i></div>
        <h4>Hostel Rules &amp; SOPs</h4>
        <p>Curfew, guest policy, ragging-free undertaking, and disciplinary norms.</p>
        <a class="card-link" href="#">Read guidelines <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

<!-- ============ HOSTEL DIRECTORY ============ -->
<section class="section section-alt">
  <div class="container">
    <div class="section-head flex-head">
      <div>
        <span class="eyebrow">Where you could live</span>
        <h2>Hostel directory</h2>
      </div>
    </div>

    <div class="filter-bar" role="tablist" aria-label="Hostel filters">
      <button class="filter-chip active" data-filter="all">All Hostels</button>
      <button class="filter-chip" data-filter="boys">Boys' Hostels</button>
      <button class="filter-chip" data-filter="girls">Girls' Hostels</button>
      <button class="filter-chip" data-filter="pg">PG / Scholars</button>
    </div>

    <div class="hostel-grid" id="hostelGrid"></div>
  </div>
</section>

<!-- ============ ROOM ALLOTMENT PROCESS ============ -->
<section class="section" id="allotment">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Room allotment</span>
      <h2>How allotment works</h2>
      <p>Allotment runs once per semester through the student portal. Here's the process, start to finish.</p>
    </div>
    <div class="process-grid">
      <div class="process-step">
        <div class="process-num">1</div>
        <h4>Apply Online</h4>
        <p>Submit preferences via the student portal within the announced window.</p>
      </div>
      <div class="process-step">
        <div class="process-num">2</div>
        <h4>Verification</h4>
        <p>SAO verifies eligibility, fee dues, and category-based reservations.</p>
      </div>
      <div class="process-step">
        <div class="process-num">3</div>
        <h4>Draw &amp; Allotment</h4>
        <p>Rooms are assigned by seniority and preference; results are published.</p>
      </div>
      <div class="process-step">
        <div class="process-num">4</div>
        <h4>Fee Payment</h4>
        <p>Confirm your seat by paying hostel fees within 7 days of allotment.</p>
      </div>
      <div class="process-step">
        <div class="process-num">5</div>
        <h4>Check-in</h4>
        <p>Collect keys from the warden's office and complete the room inventory form.</p>
      </div>
    </div>
    <div style="margin-top:var(--space-4);display:flex;gap:var(--space-2);flex-wrap:wrap;">
      <a href="#" class="btn btn-navy"><i class="fa-solid fa-arrow-right-to-bracket"></i> Apply for Allotment</a>
      <a href="#" class="btn btn-ghost"><i class="fa-solid fa-magnifying-glass"></i> Check My Status</a>
    </div>
  </div>
</section>

<!-- ============ MAINTENANCE REQUEST ============ -->
<section class="section section-alt" id="maintenance">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Something needs fixing?</span>
      <h2>Raise a maintenance request</h2>
      <p>Submit issues directly to your hostel's maintenance team — most requests are resolved within 48 hours.</p>
    </div>

    <div class="maint-wrap">
      <form class="maint-form" onsubmit="return false;">
        <div class="form-row">
          <label for="hostelBlock">Hostel &amp; room number</label>
          <input type="text" id="hostelBlock" placeholder="e.g. BH2 — Room 214">
        </div>
        <div class="form-row">
          <label for="issueCategory">Issue category</label>
          <select id="issueCategory">
            <option>Electrical</option>
            <option>Plumbing</option>
            <option>Furniture</option>
            <option>Housekeeping</option>
            <option>Internet / Wi-Fi</option>
            <option>Other</option>
          </select>
        </div>
        <div class="form-row">
          <label>Priority</label>
          <div class="priority-group">
            <label class="priority-opt"><input type="radio" name="priority" checked><span>Low</span></label>
            <label class="priority-opt"><input type="radio" name="priority"><span>Medium</span></label>
            <label class="priority-opt"><input type="radio" name="priority"><span>Urgent</span></label>
          </div>
        </div>
        <div class="form-row">
          <label for="issueDesc">Describe the issue</label>
          <textarea id="issueDesc" placeholder="Tell us what's wrong and where exactly it's located in the room..."></textarea>
        </div>
        <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;"><i class="fa-solid fa-paper-plane"></i> Submit Request</button>
      </form>

      <div class="maint-notes">
        <h3>What happens next</h3>
        <ul>
          <li><i class="fa-solid fa-circle-check"></i> You'll receive a ticket number and SMS/email confirmation immediately.</li>
          <li><i class="fa-solid fa-circle-check"></i> Urgent requests (electrical, water leakage, safety) are attended within 4 hours.</li>
          <li><i class="fa-solid fa-circle-check"></i> Routine requests are resolved within 48 hours on working days.</li>
          <li><i class="fa-solid fa-circle-check"></i> Track your request's status any time from the student portal.</li>
        </ul>
        <span class="status-chip"><i class="fa-solid fa-circle"></i> 128 requests resolved this month</span>
      </div>
    </div>
  </div>
</section>

<!-- ============ WARDEN & STAFF CONTACTS ============ -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Who to contact</span>
      <h2>Wardens &amp; hostel staff</h2>
    </div>
    <div class="staff-grid">
      <div class="staff-card">
        <div class="staff-top">
          <div class="staff-avatar"><img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=120&q=70" alt=""></div>
          <div><div class="staff-name">Dr. Meera Nair</div><div class="staff-role">Chief Warden, Boys' Hostels</div></div>
        </div>
        <div class="staff-actions"><a href="tel:0112345690"><i class="fa-solid fa-phone"></i> Call</a><a href="mailto:warden.bh@iiser.ac.in"><i class="fa-solid fa-envelope"></i> Email</a></div>
      </div>
      <div class="staff-card">
        <div class="staff-top">
          <div class="staff-avatar"><img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=120&q=70" alt=""></div>
          <div><div class="staff-name">Dr. Priya Suresh</div><div class="staff-role">Chief Warden, Girls' Hostels</div></div>
        </div>
        <div class="staff-actions"><a href="tel:0112345691"><i class="fa-solid fa-phone"></i> Call</a><a href="mailto:warden.gh@iiser.ac.in"><i class="fa-solid fa-envelope"></i> Email</a></div>
      </div>
      <div class="staff-card">
        <div class="staff-top">
          <div class="staff-avatar"><img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?w=120&q=70" alt=""></div>
          <div><div class="staff-name">Mr. Anil Deshmukh</div><div class="staff-role">Hostel Administrative Officer</div></div>
        </div>
        <div class="staff-actions"><a href="tel:0112345692"><i class="fa-solid fa-phone"></i> Call</a><a href="mailto:hostel.admin@iiser.ac.in"><i class="fa-solid fa-envelope"></i> Email</a></div>
      </div>
      <div class="staff-card">
        <div class="staff-top">
          <div class="staff-avatar"><img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=120&q=70" alt=""></div>
          <div><div class="staff-name">Facilities Helpdesk</div><div class="staff-role">Maintenance &amp; Housekeeping</div></div>
        </div>
        <div class="staff-actions"><a href="tel:0112345693"><i class="fa-solid fa-phone"></i> Call</a><a href="mailto:maintenance@iiser.ac.in"><i class="fa-solid fa-envelope"></i> Email</a></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ FEES ============ -->
<section class="section section-alt" id="fees">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Costs &amp; deadlines</span>
      <h2>Hostel fee structure</h2>
      <p>Fees are billed per semester and must be cleared to retain your allotted room.</p>
    </div>
    <div style="overflow-x:auto;">
      <table class="fee-table">
        <thead>
          <tr><th>Category</th><th>Room Rent</th><th>Mess Advance</th><th>Establishment</th><th>Due Date</th></tr>
        </thead>
        <tbody>
          <tr><td>Undergraduate (Shared)</td><td>₹9,500</td><td>₹18,000</td><td>₹2,200</td><td class="due">31 Jul 2026</td></tr>
          <tr><td>Undergraduate (Single)</td><td>₹14,000</td><td>₹18,000</td><td>₹2,200</td><td class="due">31 Jul 2026</td></tr>
          <tr><td>PG / Research Scholar</td><td>₹11,500</td><td>₹20,000</td><td>₹2,500</td><td class="due">05 Aug 2026</td></tr>
          <tr><td>International Students</td><td>₹16,000</td><td>₹20,000</td><td>₹2,500</td><td class="due">05 Aug 2026</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Common questions</span>
      <h2>Hostel FAQs</h2>
    </div>
    <div class="faq-list" id="faqList">
      <div class="faq-item">
        <button class="faq-q">Can I request a room change mid-semester? <i class="fa-solid fa-plus"></i></button>
        <div class="faq-a"><p>Room change requests are accepted only for documented medical or safety reasons and must be routed through your warden and the SAO. Preference-based changes are handled at the start of the next semester's allotment cycle.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">What is the guest and visitor policy? <i class="fa-solid fa-plus"></i></button>
        <div class="faq-a"><p>Day guests are permitted in common areas until 8 PM with prior sign-in at the hostel gate. Overnight guests require advance written approval from the warden.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">How do I report a maintenance issue after hours? <i class="fa-solid fa-plus"></i></button>
        <div class="faq-a"><p>Use the maintenance request form above any time — urgent categories are routed to the on-call facilities team, which responds even outside working hours.</p></div>
      </div>
      <div class="faq-item">
        <button class="faq-q">What happens if I miss the hostel fee deadline? <i class="fa-solid fa-plus"></i></button>
        <div class="faq-a"><p>A short grace period with a late fee applies. Beyond that, your room allotment may be released to the waitlist, so please contact the Hostel Administrative Officer if you anticipate a delay.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA BAND ============ -->
<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h3>Still need help with your hostel?</h3>
        <p>Reach the Hostel Administrative Office directly, or explore SMC and safety resources.</p>
      </div>
      <div class="cta-actions">
        <a href="#" class="btn btn-gold"><i class="fa-solid fa-file-arrow-down"></i> Download Hostel Handbook</a>
        <a href="../index.html#footer" class="btn btn-outline"><i class="fa-solid fa-envelope"></i> Contact Us</a>
      </div>
    </div>
  </div>
</section>

</main>

<?php include __DIR__ . '/../components/footer.php'; ?>

<script>
/* ================= HOSTEL DIRECTORY DATA ================= */
const hostelData=[
  {cat:'boys',name:"BH1 — Aravalli House",img:'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=500&q=70',capacity:'480 residents',rooms:'Shared, 2 per room',warden:'Dr. Rakesh Iyer',role:'Resident Warden'},
  {cat:'boys',name:"BH2 — Nilgiri House",img:'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=500&q=70',capacity:'440 residents',rooms:'Shared &amp; single rooms',warden:'Dr. Sameer Kulkarni',role:'Resident Warden'},
  {cat:'boys',name:"BH3 — Vindhya House",img:'https://images.unsplash.com/photo-1550581190-9c1c48d21d6c?w=500&q=70',capacity:'400 residents',rooms:'Shared, 2 per room',warden:'Dr. Arvind Rao',role:'Resident Warden'},
  {cat:'girls',name:"GH1 — Kaveri House",img:'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=500&q=70',capacity:'360 residents',rooms:'Shared &amp; single rooms',warden:'Dr. Priya Suresh',role:'Chief Warden'},
  {cat:'girls',name:"GH2 — Godavari House",img:'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=500&q=70',capacity:'320 residents',rooms:'Shared, 2 per room',warden:'Ms. Lakshmi Menon',role:'Resident Warden'},
  {cat:'pg',name:"PG Block — Scholars' Residency",img:'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=500&q=70',capacity:'180 residents',rooms:'Single occupancy',warden:'Dr. Meera Nair',role:'PG Block Warden'}
];
const hostelGrid=document.getElementById('hostelGrid');
function renderHostels(filter){
  hostelGrid.innerHTML='';
  const items = filter==='all' ? hostelData : hostelData.filter(h=>h.cat===filter);
  items.forEach(h=>{
    const el=document.createElement('div');
    el.className='hostel-card';
    const tagClass = h.cat==='girls' ? 'hostel-tag girls' : 'hostel-tag';
    const tagLabel = h.cat==='boys' ? "Boys' Hostel" : h.cat==='girls' ? "Girls' Hostel" : 'PG / Scholars';
    el.innerHTML = `
      <div class="hostel-photo">
        <img src="${h.img}" alt="${h.name}" loading="lazy">
        <span class="${tagClass}">${tagLabel}</span>
      </div>
      <div class="hostel-body">
        <h4>${h.name}</h4>
        <div class="hostel-meta">
          <span><i class="fa-solid fa-users"></i> ${h.capacity}</span>
          <span><i class="fa-solid fa-door-closed"></i> ${h.rooms}</span>
        </div>
        <div class="hostel-warden">
          <div><div class="w-name">${h.warden}</div><div class="w-role">${h.role}</div></div>
          <a href="#">View details</a>
        </div>
      </div>`;
    hostelGrid.appendChild(el);
  });
}
renderHostels('all');
document.querySelectorAll('.filter-chip').forEach(chip=>{
  chip.addEventListener('click',()=>{
    document.querySelectorAll('.filter-chip').forEach(c=>c.classList.remove('active'));
    chip.classList.add('active');
    renderHostels(chip.dataset.filter);
  });
});

/* ================= FAQ ACCORDION ================= */
document.querySelectorAll('.faq-item').forEach(item=>{
  item.querySelector('.faq-q').addEventListener('click',()=>{
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(o=>o.classList.remove('open'));
    if(!wasOpen) item.classList.add('open');
  });
});
</script>
<script src="../layout/include.js"></script>

</body>
</html>