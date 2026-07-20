<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Committees for Students</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/committees.css">
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
            style="font-size:.6rem"></i> <span>Committees</span></div>
        <span class="eyebrow" style="color:var(--gold-500)">Your safety, your recourse</span>
        <h1>Committees for Students</h1>
        <p class="lede">The Internal Complaints Committee, Grievance Redressal Committee, and Anti-Ragging Committee
          exist
          to make sure every student has a fair, confidential, and fast way to raise a concern.</p>

        <div class="hero-cta">
          <a href="#icc" class="btn btn-gold"><i class="fa-solid fa-scale-balanced"></i> File a Complaint</a>
          <a href="tel:1800111234" class="btn btn-outline"><i class="fa-solid fa-phone"></i> 24/7 Helpline:
            1800-111-234</a>
        </div>

        <div class="hero-stats">
          <div class="hero-stat">
            <div class="num">3</div>
            <div class="lbl">Dedicated committees</div>
          </div>
          <div class="hero-stat">
            <div class="num">48 hrs</div>
            <div class="lbl">Target response time</div>
          </div>
          <div class="hero-stat">
            <div class="num">100%</div>
            <div class="lbl">Confidential handling</div>
          </div>
          <div class="hero-stat">
            <div class="num">24/7</div>
            <div class="lbl">Helpline availability</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ CONFIDENTIALITY BANNER ============ -->
    <section class="section" style="padding-bottom:0;">
      <div class="container">
        <div class="confid-banner">
          <div class="ic"><i class="fa-solid fa-user-shield"></i></div>
          <div class="txt">
            <h4>Every complaint is handled in strict confidence</h4>
            <p>Identities are protected throughout the process. Retaliation against a complainant or witness is itself a
              punishable offence under institute policy. You are never required to confront the person you are
              complaining
              about, and you may bring a support person to any hearing.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ COMMITTEE OVERVIEW CARDS ============ -->
    <section class="section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Three committees, one goal</span>
          <h2>Which committee handles what</h2>
          <p>Not sure where your concern fits? Here's a quick guide — the sections below go into full detail for each.
          </p>
        </div>
        <div class="mv-grid">
          <div class="mv-card">
            <div class="ic"><i class="fa-solid fa-scale-balanced"></i></div>
            <h3>Internal Complaints Committee (ICC)</h3>
            <p>Handles complaints of sexual harassment involving students, faculty, or staff, as mandated under the POSH
              Act and UGC regulations.</p>
          </div>
          <div class="mv-card">
            <div class="ic"><i class="fa-solid fa-handshake"></i></div>
            <h3>Grievance Redressal Committee</h3>
            <p>Handles academic disputes, hostel or administrative issues, discrimination complaints, and any concern
              not
              covered by the other two committees.</p>
          </div>
          <div class="mv-card">
            <div class="ic"><i class="fa-solid fa-shield-halved"></i></div>
            <h3>Anti-Ragging Committee</h3>
            <p>Enforces the institute's zero-tolerance policy on ragging, with a dedicated 24/7 reporting line and rapid
              response protocol.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ COMMITTEE DETAIL TABS ============ -->
    <section class="section section-alt">
      <div class="container">
        <div class="section-head flex-head">
          <div>
            <span class="eyebrow">In detail</span>
            <h2>Committee information &amp; how to file</h2>
          </div>
        </div>

        <div class="committee-tabs" role="tablist" aria-label="Committee selector">
          <button class="committee-tab active" data-committee="icc">
            <div class="ic"><i class="fa-solid fa-scale-balanced"></i></div>
            <div class="txt">
              <h4>ICC</h4><span>Sexual harassment complaints</span>
            </div>
          </button>
          <button class="committee-tab" data-committee="grievance">
            <div class="ic"><i class="fa-solid fa-handshake"></i></div>
            <div class="txt">
              <h4>Grievance Redressal</h4><span>Academic &amp; administrative disputes</span>
            </div>
          </button>
          <button class="committee-tab" data-committee="antiragging">
            <div class="ic"><i class="fa-solid fa-shield-halved"></i></div>
            <div class="txt">
              <h4>Anti-Ragging</h4><span>Zero-tolerance enforcement</span>
            </div>
          </button>
        </div>

        <!-- ICC PANEL -->
        <div class="committee-panel active" id="panel-icc">
          <div class="committee-header">
            <div>
              <h3>Internal Complaints Committee (ICC)</h3>
              <p>Constituted under the Sexual Harassment of Women at Workplace (Prevention, Prohibition and Redressal)
                Act, 2013, and UGC (Prevention of Sexual Harassment) Regulations, 2015. The ICC investigates complaints
                of
                sexual harassment involving any member of the institute community.</p>
            </div>
            <a href="#" class="btn btn-navy report-btn"><i class="fa-solid fa-file-signature"></i> File with ICC</a>
          </div>
          <div class="committee-body">
            <div class="committee-info">
              <h4>Who can file a complaint</h4>
              <p>Any student, faculty member, or staff member who has experienced or witnessed sexual harassment on
                campus, during institute-sponsored travel, or in any institute-related context.</p>

              <h4>What counts as sexual harassment</h4>
              <ul>
                <li><i class="fa-solid fa-circle"></i> Unwelcome physical contact or advances</li>
                <li><i class="fa-solid fa-circle"></i> A demand or request for sexual favours</li>
                <li><i class="fa-solid fa-circle"></i> Sexually coloured remarks, jokes, or gestures</li>
                <li><i class="fa-solid fa-circle"></i> Showing pornography or sexually explicit content</li>
                <li><i class="fa-solid fa-circle"></i> Any other unwelcome physical, verbal, or non-verbal conduct of a
                  sexual nature</li>
              </ul>

              <h4>How to file</h4>
              <p>Submit a written complaint (email is accepted) to the ICC Presiding Officer within 3 months of the
                incident, extendable at the committee's discretion. You may also request an in-person meeting first to
                understand the process before filing formally.</p>

              <h4>What happens next</h4>
              <p>The ICC acknowledges your complaint within 3 working days, offers interim measures if needed (such as a
                no-contact directive), completes its inquiry within 90 days, and shares findings with both parties
                before
                submitting recommendations to the institute administration.</p>
            </div>
            <div class="committee-side">
              <h4>ICC Contacts</h4>
              <div class="side-contact">
                <div class="side-avatar"><img
                    src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=100&q=70" alt=""></div>
                <div>
                  <div class="name">Dr. Meera Nair</div>
                  <div class="role">Presiding Officer</div>
                </div>
                <a href="mailto:icc@iiser.ac.in">Email</a>
              </div>
              <div class="side-contact">
                <div class="side-avatar"><img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&q=70"
                    alt=""></div>
                <div>
                  <div class="name">Ms. Fatima Sheikh</div>
                  <div class="role">Member, External Expert</div>
                </div>
                <a href="mailto:icc.external@iiser.ac.in">Email</a>
              </div>
              <div class="side-cta">
                <a href="mailto:icc@iiser.ac.in" class="btn btn-gold"><i class="fa-solid fa-envelope"></i> Email the
                  ICC</a>
                <a href="#" class="btn btn-ghost"><i class="fa-solid fa-file-arrow-down"></i> Download Complaint
                  Form</a>
              </div>
            </div>
          </div>
        </div>

        <!-- GRIEVANCE PANEL -->
        <div class="committee-panel" id="panel-grievance">
          <div class="committee-header">
            <div>
              <h3>Grievance Redressal Committee</h3>
              <p>The catch-all body for concerns that don't fall under the ICC or Anti-Ragging Committee — academic
                disputes, hostel or mess issues escalated beyond the warden/SMC, discrimination, and administrative
                delays.</p>
            </div>
            <a href="#" class="btn btn-navy report-btn"><i class="fa-solid fa-file-signature"></i> File a Grievance</a>
          </div>
          <div class="committee-body">
            <div class="committee-info">
              <h4>What can be filed here</h4>
              <ul>
                <li><i class="fa-solid fa-circle"></i> Academic disputes — grading, evaluation, or supervision conflicts
                </li>
                <li><i class="fa-solid fa-circle"></i> Discrimination based on caste, religion, gender, disability, or
                  region</li>
                <li><i class="fa-solid fa-circle"></i> Hostel or mess issues unresolved at the warden/SMC level</li>
                <li><i class="fa-solid fa-circle"></i> Administrative delays — scholarships, certificates, fee refunds
                </li>
                <li><i class="fa-solid fa-circle"></i> Any other concern not covered by the ICC or Anti-Ragging
                  Committee
                </li>
              </ul>

              <h4>How to file</h4>
              <p>Submit the online grievance form or a written complaint to the Grievance Cell. You may file
                anonymously,
                though named complaints are easier to investigate and resolve. Escalated academic grievances should
                first
                be raised with your department before reaching this committee.</p>

              <h4>What happens next</h4>
              <p>You'll receive an acknowledgment within 48 hours. Most grievances are resolved within 2 weeks; complex
                cases involving multiple departments may take longer, with regular status updates provided.</p>
            </div>
            <div class="committee-side">
              <h4>Grievance Cell Contacts</h4>
              <div class="side-contact">
                <div class="side-avatar"><img
                    src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?w=100&q=70" alt=""></div>
                <div>
                  <div class="name">Dr. Arvind Rao</div>
                  <div class="role">Grievance Officer</div>
                </div>
                <a href="mailto:grievance@iiser.ac.in">Email</a>
              </div>
              <div class="side-contact">
                <div class="side-avatar"><img
                    src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=100&q=70" alt=""></div>
                <div>
                  <div class="name">Aditi Rao</div>
                  <div class="role">Student Representative</div>
                </div>
                <a href="mailto:grievance.student@iiser.ac.in">Email</a>
              </div>
              <div class="side-cta">
                <a href="#" class="btn btn-gold"><i class="fa-solid fa-file-pen"></i> Open Grievance Form</a>
                <a href="#" class="btn btn-ghost"><i class="fa-solid fa-user-secret"></i> File Anonymously</a>
              </div>
            </div>
          </div>
        </div>

        <!-- ANTI-RAGGING PANEL -->
        <div class="committee-panel" id="panel-antiragging">
          <div class="committee-header">
            <div>
              <h3>Anti-Ragging Committee</h3>
              <p>IISER enforces a zero-tolerance policy on ragging in compliance with UGC Regulations, 2009, and Supreme
                Court directives. Ragging in any form — physical, verbal, or psychological — is a punishable offence
                under
                both institute policy and Indian law.</p>
            </div>
            <a href="tel:1800111234" class="btn report-btn urgent"><i class="fa-solid fa-triangle-exclamation"></i>
              Report
              Ragging Now</a>
          </div>
          <div class="committee-body">
            <div class="committee-info">
              <h4>What counts as ragging</h4>
              <ul>
                <li><i class="fa-solid fa-circle"></i> Any act that causes physical or psychological harm to a student
                </li>
                <li><i class="fa-solid fa-circle"></i> Forcing a student to perform acts they wouldn't otherwise do</li>
                <li><i class="fa-solid fa-circle"></i> Verbal abuse, intimidation, or humiliation of any student,
                  especially first-years</li>
                <li><i class="fa-solid fa-circle"></i> Exploitation for errands, financial demands, or forced compliance
                </li>
              </ul>

              <h4>How to report</h4>
              <p>Call the 24/7 anti-ragging helpline, report anonymously through the drop-box in every hostel, or email
                the committee directly. All incoming students also sign a mandatory anti-ragging affidavit at admission
                —
                familiarize yourself with it.</p>

              <h4>What happens next</h4>
              <p>Reports are investigated within 24 hours. Confirmed cases can result in suspension, expulsion, or
                referral to police, depending on severity, per UGC guidelines. Interim protective measures — such as a
                room change or no-contact order — are available immediately upon report.</p>
            </div>
            <div class="committee-side">
              <h4>Anti-Ragging Contacts</h4>
              <div class="side-contact">
                <div class="side-avatar"><img
                    src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?w=100&q=70" alt=""></div>
                <div>
                  <div class="name">Dr. Sameer Kulkarni</div>
                  <div class="role">Committee Chairperson</div>
                </div>
                <a href="mailto:antiragging@iiser.ac.in">Email</a>
              </div>
              <div class="side-contact">
                <div class="side-avatar"><img
                    src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=100&q=70" alt=""></div>
                <div>
                  <div class="name">Campus Security Dispatch</div>
                  <div class="role">Immediate response</div>
                </div>
                <a href="tel:0112345679">Call</a>
              </div>
              <div class="side-cta">
                <a href="tel:1800111234" class="btn btn-gold"><i class="fa-solid fa-phone"></i> 24/7 Anti-Ragging
                  Helpline</a>
                <a href="#" class="btn btn-ghost"><i class="fa-solid fa-user-secret"></i> Report Anonymously</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ HOW FILING WORKS (GENERIC PROCESS) ============ -->
    <section class="section">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">What to expect</span>
          <h2>The complaint process, step by step</h2>
          <p>Whichever committee you approach, the broad process looks like this.</p>
        </div>
        <div class="process-grid">
          <div class="process-step">
            <div class="process-num">1</div>
            <h4>Submit</h4>
            <p>File in writing, online, or by dropping a note in a hostel drop-box — named or anonymous.</p>
          </div>
          <div class="process-step">
            <div class="process-num">2</div>
            <h4>Acknowledge</h4>
            <p>You receive confirmation and, if needed, immediate interim protective measures.</p>
          </div>
          <div class="process-step">
            <div class="process-num">3</div>
            <h4>Investigate</h4>
            <p>The committee gathers statements and evidence in confidence, on a defined timeline.</p>
          </div>
          <div class="process-step">
            <div class="process-num">4</div>
            <h4>Resolve</h4>
            <p>Findings and recommendations are shared, with a clear route to appeal if needed.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="section section-alt">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Common questions</span>
          <h2>FAQs</h2>
        </div>
        <div class="faq-list" id="committeeFaqList">
          <div class="faq-item">
            <button class="faq-q">Can I file a complaint anonymously? <i class="fa-solid fa-plus"></i></button>
            <div class="faq-a">
              <p>Yes, for the Grievance Redressal Committee and Anti-Ragging Committee. Anonymous ICC complaints are
                accepted but may limit the committee's ability to investigate fully — you can still request
                confidentiality without full anonymity.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-q">Will filing a complaint affect my academic standing? <i
                class="fa-solid fa-plus"></i></button>
            <div class="faq-a">
              <p>No. Retaliation of any kind against a complainant, including academic penalization, is itself a
                violation
                of institute policy and can be reported separately.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-q">What if my concern doesn't clearly fit one committee? <i
                class="fa-solid fa-plus"></i></button>
            <div class="faq-a">
              <p>File with whichever committee feels closest, or email the Students' Affairs Office directly —
                complaints
                are routed to the correct committee internally, so you won't need to refile.</p>
            </div>
          </div>
          <div class="faq-item">
            <button class="faq-q">Can I appeal a committee's decision? <i class="fa-solid fa-plus"></i></button>
            <div class="faq-a">
              <p>Yes. All three committees' decisions can be appealed to the Dean of Students' Affairs within 15 days of
                the outcome being communicated.</p>
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
            <h3>Need to talk to someone first?</h3>
            <p>You don't need a formal complaint ready — reach out and we'll help you figure out the right next step.
            </p>
          </div>
          <div class="cta-actions">
            <a href="tel:1800111234" class="btn btn-gold"><i class="fa-solid fa-phone"></i> Call the Helpline</a>
            <a href="index.html#footer" class="btn btn-outline"><i class="fa-solid fa-envelope"></i> Contact the SAO</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../components/footer.php'; ?>
  <script>
    /* ================= COMMITTEE TAB SWITCHER ================= */
    document.querySelectorAll('.committee-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.committee-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.committee-panel').forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('panel-' + tab.dataset.committee).classList.add('active');
      });
    });

    /* ================= FAQ ACCORDION ================= */
    document.querySelectorAll('#committeeFaqList .faq-item').forEach(item => {
      item.querySelector('.faq-q').addEventListener('click', () => {
        const wasOpen = item.classList.contains('open');
        document.querySelectorAll('#committeeFaqList .faq-item.open').forEach(o => o.classList.remove('open'));
        if (!wasOpen) item.classList.add('open');
      });
    });
  </script>
  <script src="../layout/include.js"></script>
</body>

</html>