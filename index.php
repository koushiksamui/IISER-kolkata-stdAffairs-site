<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Students' Affairs Office — IISER</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <a href="#main" class="skip-link">Skip to main content</a>

  <?php $BASE_URL = './';
  include __DIR__ . '/components/navbar.php'; ?>

  <div id="mobile-drawer-placeholder"></div>

  <main id="main">
    <!-- ============ HERO ============ -->
    <section class="hero">
      <div class="container hero-grid">
        <div class="hero-top">
          <div class="carousel" id="carousel">
            <button class="carousel-prev" aria-label="Previous slide" style="display:none;">
              <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div id="carousel-slides-container">
              <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--gold-500); font-size: 2rem;">
                <i class="fa-solid fa-circle-notch fa-spin"></i>
              </div>
            </div>
            <div class="carousel-dots" id="carousel-dots-container">
            </div>
            <button class="carousel-next" aria-label="Next slide" style="display:none;">
              <i class="fa-solid fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="hero-bottom-section">
      <div class="hero-bottom">
        <div class="std-office-dtls">
          <span class="hero-eyebrow">Students' Affairs Office</span>
          <h1>
            Supporting every student's journey, <em>on and beyond campus.</em>
          </h1>
          <p class="dosa-msg">
            "Our office exists so that every student at IISER finds the
            support, safety and community they need to thrive — academically
            and personally. Reach out any time; we are here for you."
          </p>
          <p class="dosa-sign">
            <strong>Prof. Koushik Dutta</strong> · Dean of Students' Affairs
          </p>

          <div class="hero-cta">
            <a href="#services" class="btn btn-gold"><i class="fa-solid fa-compass"></i> Explore Services</a>
            <a href="#footer" class="btn btn-outline"><i class="fa-solid fa-envelope"></i> Contact Us</a>
          </div>
        </div>
        <div class="announcement-panel" role="region">
          <span class="hero-eyebrow">Updates &amp; Information</span>
          <div class="panel-head" style="margin-top: 16px;">
            <span class="panel-label"><i class="fa-solid fa-bullhorn"></i> Latest Notices & Updates</span>
            <a href="pages/notices.html">View all</a>
          </div>
          <ul class="announcement-list notice-style" id="dynamic-notices-container">
            <li>
              <div style="display: flex; align-items: center; justify-content: center; padding: 32px 0;">
                <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 2rem; color: var(--gold-500);"></i>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <!-- ============ QUICK SERVICES ============ -->
    <section class="section" id="services">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">What we offer</span>
          <h2>Services built around student life</h2>
          <p>
            From the day you move into your hostel room to the day you walk
            into placements — the Students' Affairs Office is your single
            point of contact.
          </p>
        </div>
        <div class="services-grid">
          <div class="service-card">
            <div class="ic"><i class="fa-solid fa-building"></i></div>
            <h4>Hostel Management</h4>
            <p>Room allotment, maintenance requests and warden contacts.</p>
          </div>
          <div class="service-card">
            <div class="ic"><i class="fa-solid fa-graduation-cap"></i></div>
            <h4>Scholarship &amp; Financial Aid</h4>
            <p>
              Merit and need-based aid, application tracking and disbursal.
            </p>
          </div>
          <div class="service-card">
            <div class="ic"><i class="fa-solid fa-briefcase"></i></div>
            <h4>Placement / CCD</h4>
            <p>
              Career counselling, internship drives and recruiter tie-ups.
            </p>
          </div>
          <div class="service-card">
            <div class="ic"><i class="fa-solid fa-masks-theater"></i></div>
            <h4>Clubs &amp; Societies</h4>
            <p>60+ student bodies covering arts, tech, and outreach.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ GALLERY ============ -->
    <section class="section section-alt" id="gallery">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Media Centre</span>
          <h2>Photo &amp; video gallery</h2>
          <p>
            Moments from campus life, hostels, events, sport and student-led
            activities.
          </p>
        </div>

        <div class="filter-bar" role="tablist" aria-label="Gallery filters">
          <button class="filter-chip active" data-filter="all">All</button>
          <button class="filter-chip" data-filter="photos">Photos</button>
          <button class="filter-chip" data-filter="videos">Videos</button>
        </div>

        <div class="gallery-grid" id="galleryGrid"></div>
      </div>
    </section>

    <!-- ============ SAFETY & WELLBEING ============ -->
    <section class="section safety-section" id="committees">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow" style="color: var(--gold-500)">Your safety, our priority</span>
          <h2 style="color: var(--white)">Safety &amp; Wellbeing</h2>
          <p style="color: rgba(255, 255, 255, 0.75)">
            Confidential support, rapid response and round-the-clock
            assistance whenever you need it.
          </p>
        </div>

        <div class="safety-grid">
          <div class="safety-card">
            <div class="ic"><i class="fa-solid fa-scale-balanced"></i></div>
            <h4>Internal Complaints Committee</h4>
            <p>
              Redressal of complaints related to sexual harassment, in strict
              confidence.
            </p>
            <a class="card-link" href="#">File a complaint <i class="fa-solid fa-arrow-right"></i></a>
          </div>
          <div class="safety-card">
            <div class="ic"><i class="fa-solid fa-brain"></i></div>
            <h4>Mental Health &amp; Counselling</h4>
            <p>
              Free, confidential one-on-one counselling and peer support
              groups.
            </p>
            <a class="card-link" href="#">Book a session <i class="fa-solid fa-arrow-right"></i></a>
          </div>
          <div class="safety-card report">
            <div class="ic"><i class="fa-solid fa-shield-halved"></i></div>
            <h4>Report Ragging</h4>
            <p>
              Zero-tolerance policy. Reports can be made anonymously, any
              time.
            </p>
            <a class="card-link" href="#">Report now <i class="fa-solid fa-arrow-right"></i></a>
          </div>
          <div class="safety-card">
            <div class="ic"><i class="fa-solid fa-kit-medical"></i></div>
            <h4>Medical Unit &amp; MCWC</h4>
            <p>
              On-campus clinic and the Medical Centre for Women's Care, open
              daily.
            </p>
            <a class="card-link" href="#">Clinic timings <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>

        <div class="contacts-strip">
          <div class="contact-pill">
            <div class="num-ic">
              <i class="fa-solid fa-truck-medical"></i>
            </div>
            <div class="txt">
              <div class="role">Campus Ambulance</div>
              <a href="tel:0112345678">011-2345-678</a>
            </div>
          </div>
          <div class="contact-pill">
            <div class="num-ic"><i class="fa-solid fa-user-shield"></i></div>
            <div class="txt">
              <div class="role">Chief Security Officer</div>
              <a href="tel:0112345679">011-2345-679</a>
            </div>
          </div>
          <div class="contact-pill">
            <div class="num-ic">
              <i class="fa-solid fa-house-medical"></i>
            </div>
            <div class="txt">
              <div class="role">Warden on Duty</div>
              <a href="tel:0112345680">011-2345-680</a>
            </div>
          </div>
          <div class="contact-pill">
            <div class="num-ic">
              <i class="fa-solid fa-hand-holding-heart"></i>
            </div>
            <div class="txt">
              <div class="role">Counselling Cell</div>
              <a href="tel:0112345681">011-2345-681</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <!-- ============ LIGHTBOX ============ -->
  <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
    <div class="lightbox-inner">
      <button class="lightbox-close" id="lbClose" aria-label="Close viewer">
        <i class="fa-solid fa-xmark"></i>
      </button>
      <button class="lightbox-nav prev" id="lbPrev" aria-label="Previous image">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      <img id="lbImg" src="" alt="" />
      <div class="lightbox-cap">
        <span id="lbTitle"></span>
        <span id="lbCat" style="color: var(--gold-500)"></span>
      </div>
      <button class="lightbox-nav next" id="lbNext" aria-label="Next image">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </div>

  <script>
    /* ================= DYNAMIC CAROUSEL ================= */
    fetch('api/banners.php?action=get_banners')
      .then(res => res.json())
      .then(data => {
        const slidesContainer = document.getElementById('carousel-slides-container');
        const dotsContainer = document.getElementById('carousel-dots-container');

        if (data.success && data.banners && data.banners.length > 0) {
          slidesContainer.innerHTML = '';
          dotsContainer.innerHTML = '';

          data.banners.forEach((banner, idx) => {
            // Slide
            const slide = document.createElement('div');
            slide.className = 'carousel-slide' + (idx === 0 ? ' active' : '');
            slide.style.backgroundImage = `url('${banner.image_path}')`;

            // Inner Content
            let innerHTML = `<div class="cap">${banner.title}</div>`;
            if (banner.description) {
              innerHTML += `<p style="color: white; margin-top: 8px; font-size: 0.9rem; text-shadow: 1px 1px 4px rgba(0,0,0,0.8); max-width: 600px;">${banner.description}</p>`;
            }
            if (banner.button_text && banner.button_link) {
              innerHTML += `<a href="${banner.button_link}" class="btn btn-gold" style="margin-top: 16px; display: inline-block; padding: 6px 16px; font-size: 0.85rem;">${banner.button_text}</a>`;
            }

            // Wrapper for cap content so it styles nicely
            slide.innerHTML = `<div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 40px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">${innerHTML}</div>`;
            slidesContainer.appendChild(slide);

            // Dot
            const dot = document.createElement('button');
            dot.setAttribute('aria-label', `Slide ${idx + 1}`);
            if (idx === 0) dot.className = 'active';
            dotsContainer.appendChild(dot);
          });

          document.querySelector('.carousel-prev').style.display = 'block';
          document.querySelector('.carousel-next').style.display = 'block';

          initCarousel();
        } else {
          document.getElementById('carousel').style.display = 'none';
        }
      })
      .catch(err => {
        console.error('Failed to load banners:', err);
        document.getElementById('carousel').style.display = 'none';
      });

    function initCarousel() {
      const slides = document.querySelectorAll(".carousel-slide");
      const dots = document.querySelectorAll(".carousel-dots button");
      let curSlide = 0,
        carouselTimer;

      function showSlide(i) {
        slides.forEach((s) => s.classList.remove("active"));
        dots.forEach((d) => d.classList.remove("active"));
        slides[i].classList.add("active");
        dots[i].classList.add("active");
        curSlide = i;

        const prevBtn = document.querySelector(".carousel-prev");
        const nextBtn = document.querySelector(".carousel-next");
        if (prevBtn && nextBtn) {
          let prevIdx = (i - 1 + slides.length) % slides.length;
          let nextIdx = (i + 1) % slides.length;
          prevBtn.style.setProperty("--preview-bg", slides[prevIdx].style.backgroundImage);
          nextBtn.style.setProperty("--preview-bg", slides[nextIdx].style.backgroundImage);
        }
      }
      showSlide(0);

      function nextSlide() {
        showSlide((curSlide + 1) % slides.length);
      }

      function startCarousel() {
        carouselTimer = setInterval(nextSlide, 4500);
      }

      dots.forEach((d, i) =>
        d.addEventListener("click", () => {
          showSlide(i);
          clearInterval(carouselTimer);
          startCarousel();
        }),
      );
      startCarousel();

      const prevBtn = document.querySelector(".carousel-prev");
      const nextBtn = document.querySelector(".carousel-next");
      if (prevBtn && nextBtn) {
        prevBtn.addEventListener("click", () => {
          showSlide((curSlide - 1 + slides.length) % slides.length);
          clearInterval(carouselTimer);
          startCarousel();
        });
        nextBtn.addEventListener("click", () => {
          nextSlide();
          clearInterval(carouselTimer);
          startCarousel();
        });
      }
    }

    /* ================= DYNAMIC GALLERY ================= */
    const galleryGrid = document.getElementById("galleryGrid");
    let allMediaData = [];

    Promise.all([
      fetch('api/public_gallery.php?action=get_photos').then(r => r.json()).catch(() => ({})),
      fetch('api/public_gallery.php?action=get_videos').then(r => r.json()).catch(() => ({}))
    ]).then(([photoRes, videoRes]) => {
      if (photoRes.success && photoRes.galleries) {
        photoRes.galleries.forEach(g => {
          let cover = g.cover_image ? g.cover_image : 'https://placehold.co/600x400?text=No+Image';
          let src = cover.match(/^https?:\/\//) ? cover : cover;
          allMediaData.push({
            type: 'photos',
            cat: 'Photo Gallery',
            title: g.title,
            img: src,
            count: g.image_count + ' Photos'
          });
        });
      }

      if (videoRes.success && videoRes.videos) {
        videoRes.videos.forEach(v => {
          let thumbnail = '';
          if (v.video_type === 'youtube' && v.video_url) {
            const match = v.video_url.match(/\/embed\/([^?&]+)/);
            if (match && match[1]) {
              thumbnail = `https://img.youtube.com/vi/${match[1]}/maxresdefault.jpg`;
            }
          }
          if (!thumbnail) thumbnail = 'https://placehold.co/600x400?text=Video';

          allMediaData.push({
            type: 'videos',
            cat: 'Video',
            title: v.caption || 'Untitled Video',
            img: thumbnail,
            count: 'Video'
          });
        });
      }

      renderGallery("all");
    });

    function renderGallery(filter) {
      galleryGrid.innerHTML = "";
      const items = filter === "all" ? allMediaData : allMediaData.filter(d => d.type === filter);

      if (items.length === 0) {
        galleryGrid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: var(--grey-500); padding: 40px 0;">No media found.</div>';
        return;
      }

      items.forEach((d) => {
        const el = document.createElement("div");
        el.className = "gallery-item";

        let playIcon = d.type === 'videos' ? '<div class="play" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 3rem; opacity: 0.8; z-index: 10; pointer-events: none;"><i class="fa-solid fa-play"></i></div>' : '';

        el.innerHTML = `<img src="${d.img}" alt="${d.title}" loading="lazy">
        ${playIcon}
        <div class="overlay"><div><div class="g-cat">${d.count}</div><div class="g-title">${d.title}</div></div></div>`;

        el.addEventListener("click", () => {
          if (d.type === 'videos') {
            window.location.href = 'pages/video_gallery.html';
          } else {
            openLightbox(allMediaData.indexOf(d));
          }
        });
        galleryGrid.appendChild(el);
      });
    }

    document.querySelectorAll(".filter-chip").forEach((chip) => {
      chip.addEventListener("click", () => {
        document.querySelectorAll(".filter-chip").forEach((c) => c.classList.remove("active"));
        chip.classList.add("active");
        renderGallery(chip.dataset.filter);
      });
    });

    /* ================= LIGHTBOX ================= */
    const lightbox = document.getElementById("lightbox"),
      lbImg = document.getElementById("lbImg"),
      lbTitle = document.getElementById("lbTitle"),
      lbCat = document.getElementById("lbCat");
    let lbIndex = 0;

    function openLightbox(i) {
      lbIndex = i;
      updateLightbox();
      lightbox.classList.add("open");
    }

    function updateLightbox() {
      const d = allMediaData[lbIndex];
      lbImg.src = d.img.replace("w=600", "w=1200");
      lbImg.alt = d.title;
      lbTitle.textContent = d.title;
      lbCat.textContent = d.cat;
    }
    document
      .getElementById("lbClose")
      .addEventListener("click", () => lightbox.classList.remove("open"));
    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) lightbox.classList.remove("open");
    });
    document.getElementById("lbPrev").addEventListener("click", () => {
      // Find previous photo
      let prev = lbIndex - 1;
      while (prev >= 0 && allMediaData[prev].type !== 'photos') prev--;
      if (prev >= 0) {
        lbIndex = prev;
        updateLightbox();
      }
    });
    document.getElementById("lbNext").addEventListener("click", () => {
      // Find next photo
      let next = lbIndex + 1;
      while (next < allMediaData.length && allMediaData[next].type !== 'photos') next++;
      if (next < allMediaData.length) {
        lbIndex = next;
        updateLightbox();
      }
    });
    document.addEventListener("keydown", (e) => {
      if (!lightbox.classList.contains("open")) return;
      if (e.key === "Escape") lightbox.classList.remove("open");
      if (e.key === "ArrowLeft") document.getElementById("lbPrev").click();
      if (e.key === "ArrowRight") document.getElementById("lbNext").click();
    });

    /* ================= DYNAMIC NOTICES ================= */
    (function() {
      const container = document.getElementById("dynamic-notices-container");
      if (!container) return;

      fetch('api/notices.php?action=get_notices&public_only=1&limit=2')
        .then(res => res.json())
        .then(data => {
          if (data.success && data.data && data.data.length > 0) {
            container.innerHTML = '';
            data.data.forEach(notice => {
              let badgeStyle = 'display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;';
              if (notice.type === 'circular') badgeStyle += ' background: #eff6ff; color: #1d4ed8;';
              else if (notice.type === 'event') badgeStyle += ' background: #f0fdf4; color: #15803d;';
              else if (notice.type === 'alert') badgeStyle += ' background: #fef2f2; color: #b91c1c;';
              else badgeStyle += ' background: #f8fafc; color: #334155;';

              const typeName = notice.type === 'other' ? notice.other_type_name : notice.type;

              const dateObj = new Date(notice.created_at);
              const dateStr = dateObj.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric'
              });

              let actionsHTML = '';
              if (notice.pdf_path) {
                actionsHTML += `<a href="${notice.pdf_path}" target="_blank" style="margin-right: 12px; font-size: 0.9rem; color: #fbbf24; text-decoration: none;"><i class="fa-solid fa-file-pdf"></i> PDF</a>`;
              }
              if (notice.link) {
                actionsHTML += `<a href="${notice.link}" target="_blank" style="font-size: 0.9rem; color: #60a5fa; text-decoration: none;"><i class="fa-solid fa-link"></i> Link</a>`;
              }

              const li = document.createElement('li');
              li.style.position = 'relative';
              li.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                  <div>
                    <span style="${badgeStyle}">${typeName}</span>
                    <strong style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 1.05rem; margin-bottom: 4px; color: #ffffff;" title="${notice.title}">${notice.title}</strong>
                    <div style="margin-top: 8px;">
                      ${actionsHTML}
                    </div>
                  </div>
                  <time style="font-size: 0.85rem; color: rgba(255,255,255,0.7); white-space: nowrap; margin-left: 16px;">${dateStr}</time>
                </div>
              `;
              container.appendChild(li);
            });
          } else {
            container.innerHTML = '<li style="text-align: center; color: var(--white); padding: 32px 0;">No New Updates or Notices</li>';
          }
        })
        .catch(err => {
          console.error('Failed to load notices:', err);
          container.innerHTML = '<li style="text-align: center; color: var(--white); padding: 32px 0;">No New Updates or Notices</li>';
        });
    })();
  </script>
  <script src="layout/include.js"></script>
</body>

</html>