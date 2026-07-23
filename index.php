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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
          <div class="panel-head">
            <span class="panel-label">
              <i class="fa-solid fa-bullhorn"></i> Latest Announcements <span class="live-pulse-dot" id="live-pulse-dot" title="Live Updates" style="display: none;"></span>
            </span>
            <a href="pages/notices.php" class="view-all-btn">
              View All <i class="fa-solid fa-arrow-right-long"></i>
            </a>
          </div>
          <div class="notice-type-tabs" id="notice-type-tabs">
            <button class="notice-tab-btn active" data-type="">All</button>
          </div>
          <ul class="announcement-list" id="dynamic-notices-container">
            <li style="text-align: center; padding: 32px 0;">
              <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 2rem; color: #fbbf24;"></i>
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
          <h2>Essential Student Services</h2>
          <p>
            We are here to support you outside the classroom. From your hostel stay to campus transport and student clubs, we've got you covered throughout your journey.
          </p>
        </div>
        <div class="services-grid">
          <a href="pages/hostel-management.php" class="service-card" style="text-decoration: none; color: inherit; display: block;">
            <div class="ic"><i class="fa-solid fa-building"></i></div>
            <h4>Hostels</h4>
            <p>Room allotment, maintenance requests and warden contacts.</p>
          </a>
          <a href="pages/smc-info.php" class="service-card" style="text-decoration: none; color: inherit; display: block;">
            <div class="ic"><i class="fa-solid fa-utensils"></i></div>
            <h4>Student Monitored Canteen</h4>
            <p>Details about the student monitored canteen.</p>
          </a>
          <a href="pages/transport.php" class="service-card" style="text-decoration: none; color: inherit; display: block;">
            <div class="ic"><i class="fa-solid fa-bus"></i></div>
            <h4>Transport</h4>
            <p>Campus bus schedules, routes, and transport services.</p>
          </a>
          <a href="pages/student-achievements.php" class="service-card" style="text-decoration: none; color: inherit; display: block;">
            <div class="ic"><i class="fa-solid fa-medal"></i></div>
            <h4>Student Achievements</h4>
            <p>Celebrating academic, sports, and cultural successes.</p>
          </a>
          <a href="pages/clubs-societies.php" class="service-card" style="text-decoration: none; color: inherit; display: block;">
            <div class="ic"><i class="fa-solid fa-masks-theater"></i></div>
            <h4>Clubs &amp; Societies</h4>
            <p>60+ student bodies covering arts, tech, and outreach.</p>
          </a>
        </div>
      </div>
    </section>

    <!-- ============ MOSAIC GALLERY ============ -->
    <section class="section section-alt" id="mosaic-gallery">
      <div class="container">
        <div class="section-head">
          <span class="eyebrow">Campus Life</span>
          <h2>A Glimpse of IISER Kolkata</h2>
          <p>
            Explore the vibrant life, events, and everyday moments of our students inside the campus.
          </p>
        </div>

        <div class="mosaic-grid">
          <div class="mosaic-item mosaic-large">
            <img src="images/Clubs/club-img7.jpg" alt="Campus Life" loading="lazy">
          </div>
          <div class="mosaic-item mosaic-tall">
            <img src="images/Clubs/club-img2.jpg" alt="Student Activities" loading="lazy">
          </div>
          <div class="mosaic-item mosaic-wide">
            <img src="images/Clubs/club-img3.jpg" alt="Sports" loading="lazy">
          </div>
          <div class="mosaic-item">
            <img src="images/Clubs/club-img4.jpg" alt="Club Event" loading="lazy">
          </div>
          <div class="mosaic-item">
            <img src="images/Clubs/club-img5.jpg" alt="Cultural Event" loading="lazy">
          </div>
          <div class="mosaic-item mosaic-wide">
            <img src="images/Clubs/club-img6.jpg" alt="Festivals" loading="lazy">
          </div>
          <div class="mosaic-item">
            <img src="images/Clubs/club-img8.jpg" alt="Performances" loading="lazy">
          </div>
          <div class="mosaic-item mosaic-wide">
            <img src="images/Clubs/club-img10.jpg" alt="Gatherings" loading="lazy">
          </div>
        </div>
      </div>
    </section>

    <!-- ============ GALLERY ============ -->
    <section class="section" id="gallery">
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

        <div class="albums-grid" id="galleryGrid"></div>
      </div>
    </section>

    <!-- ============ SAFETY & WELLBEING ============ -->
    <section class="section safety-section section-alt" id="committees">
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

  <!-- ============ LIGHTBOX MODAL ============ -->
  <div class="lightbox-modal" id="lightboxModal" role="dialog" aria-modal="true">
    <!-- Floating Top Left Title & Counter -->
    <div class="lightbox-top-left">
      <h3 class="lightbox-title-text" id="lbAlbumTitle">Media</h3>
      <div class="lightbox-counter" id="lbCounter">Photo 1 of 1</div>
    </div>

    <!-- Floating Top Right Close Button -->
    <button class="lightbox-close-btn" id="lbCloseBtn" aria-label="Close image viewer">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="lightbox-body" style="padding-top: 80px; padding-bottom: 40px;">
      <button class="lightbox-nav-btn prev-btn" id="lbPrevBtn" aria-label="Previous photo">
        <i class="fa-solid fa-chevron-left"></i>
      </button>
      
      <div id="lbMediaContainer" style="flex: 1; display: flex; align-items: center; justify-content: center; min-width: 0; min-height: 0; width: 100%;">
         <img class="lightbox-main-img" id="lbMainImg" src="" alt="Gallery Image" decoding="async">
         <div id="lbVideoPlayer" style="display: none; width: 100%; max-width: 1100px; box-shadow: 0 16px 50px rgba(0,0,0,0.7); border-radius: 12px; overflow: hidden; background: #000;"></div>
      </div>

      <button class="lightbox-nav-btn next-btn" id="lbNextBtn" aria-label="Next photo">
        <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>

    <div class="lightbox-thumbnails" id="lbThumbnails">
      <!-- Dynamic thumbnails -->
    </div>
  </div>

  <script>
    /* ================= DYNAMIC CAROUSEL ================= */
    $.ajax({
        url: 'api/banners.php?action=get_banners',
        method: 'GET',
        dataType: 'json'
      }).done(data => {
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
            let innerHTML = `<h2 class="carousel-title">${banner.title}</h2>`;
            if (banner.description) {
              innerHTML += `<p class="carousel-subtitle">${banner.description}</p>`;
            }
            if (banner.button_text && banner.button_link) {
              innerHTML += `<a href="${banner.button_link}" class="btn btn-gold carousel-btn">${banner.button_text} <i class="fa-solid fa-arrow-right-long" style="margin-left: 6px;"></i></a>`;
            }

            // Wrapper for cap content so it styles nicely
            slide.innerHTML = `<div class="carousel-content-wrapper">${innerHTML}</div>`;
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
      .fail((jqXHR, textStatus, err) => {
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
      $.ajax({
        url: 'api/public_gallery.php?action=get_photos',
        method: 'GET',
        dataType: 'json'
      }).catch(() => ({})),
      $.ajax({
        url: 'api/public_gallery.php?action=get_videos',
        method: 'GET',
        dataType: 'json'
      }).catch(() => ({}))
    ]).then(([photoRes, videoRes]) => {
      if (photoRes.success && photoRes.galleries) {
        photoRes.galleries.forEach(g => {
          let cover = g.cover_image ?
            (g.cover_image.match(/^https?:\/\//) ? g.cover_image : g.cover_image.replace(/^\.\.\//, '')) :
            'https://placehold.co/600x400?text=No+Image';

          allMediaData.push({
            type: 'photos',
            cat: 'Photo Gallery',
            gallery_id: g.id,
            title: g.title,
            img: cover,
            count: (g.image_count || 0) + ' Photos'
          });
        });
      }

      if (videoRes.success && videoRes.videos) {
        videoRes.videos.forEach(v => {
          allMediaData.push({
            type: 'videos',
            cat: 'Video',
            title: v.caption || 'Untitled Video',
            video_type: v.video_type,
            video_url: v.video_url,
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
        const el = document.createElement("a");
        el.className = "album-card-link";
        el.href = "javascript:void(0)";

        let mediaHtml = '';
        if (d.type === 'photos') {
            mediaHtml = `
                <img class="album-cover-img" src="${d.img}" alt="${d.title}" loading="lazy">
                <div class="album-count-badge"><i class="fa-solid fa-images"></i> ${d.count}</div>
            `;
        } else {
            let playerHtml = '';
            if (d.video_type === 'youtube') {
                let videoId = '';
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
                const match = d.video_url.match(regExp);
                if (match && match[2].length === 11) {
                    videoId = match[2];
                }
                const embedUrl = videoId ? `https://www.youtube.com/embed/${videoId}` : d.video_url;
                playerHtml = `<iframe src="${embedUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 100%; pointer-events: none;"></iframe>`;
            } else {
                playerHtml = `<video style="width: 100%; height: 100%; object-fit: cover; background: #000; pointer-events: none;">
                                  <source src="api/stream_video.php?file=${encodeURIComponent(d.video_url)}" type="video/mp4">
                              </video>`;
            }
            mediaHtml = `
                ${playerHtml}
                <!-- Invisible overlay to capture clicks instead of the player -->
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 5;"></div>
                <div class="album-count-badge" style="z-index: 10;">
                    <i class="fa-solid fa-play"></i> Video
                </div>
            `;
        }

        let metaText = d.type === 'photos' ? `${d.count} &bull; Click to open album` : 'Click to watch in Video Gallery';

        el.innerHTML = `
            <div class="album-card" style="cursor: pointer;">
                <div class="album-media" style="position: relative;">
                    ${mediaHtml}
                </div>
                <div class="album-details">
                    <h3 class="album-title">${d.title}</h3>
                    <div class="album-meta-text">${metaText}</div>
                </div>
            </div>
        `;

        el.addEventListener("click", () => {
          if (d.type === 'photos' && d.gallery_id) {
            window.location.href = 'pages/photo_gallery_details.php?id=' + d.gallery_id;
          } else {
            const videoOnlyData = allMediaData.filter(m => m.type === 'videos');
            const videoIndex = videoOnlyData.indexOf(d);
            openLightbox(videoIndex, videoOnlyData);
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

    /* ================= LIGHTBOX MODAL ================= */
    const modal = document.getElementById("lightboxModal");
    const lbMainImg = document.getElementById("lbMainImg");
    const lbVideoPlayer = document.getElementById("lbVideoPlayer");
    const lbAlbumTitle = document.getElementById("lbAlbumTitle");
    const lbCounter = document.getElementById("lbCounter");
    const lbThumbnails = document.getElementById("lbThumbnails");

    let currentImageIndex = 0;
    let lbActiveArray = [];

    window.openLightbox = function(idx, array = allMediaData) {
      lbActiveArray = array;
      if (!lbActiveArray || lbActiveArray.length === 0) return;
      currentImageIndex = idx;

      renderThumbnailsOnce();
      changeImage(currentImageIndex);

      modal.classList.add("active");
      document.body.style.overflow = "hidden";
    };

    function closeModal() {
      modal.classList.remove("active");
      document.body.style.overflow = "";
      lbVideoPlayer.innerHTML = '';
    }

    function renderThumbnailsOnce() {
      lbThumbnails.innerHTML = '';
      lbActiveArray.forEach((d, idx) => {
        const thumb = document.createElement('img');
        if (d.type === 'videos') {
           if (d.video_type === 'youtube') {
              const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
              const match = d.video_url.match(regExp);
              thumb.src = match && match[2].length === 11 ? `https://img.youtube.com/vi/${match[2]}/default.jpg` : 'https://placehold.co/200x200?text=Video';
           } else {
              thumb.src = 'https://placehold.co/200x200?text=Video';
           }
        } else {
           thumb.src = d.img.replace("w=600", "w=200");
        }
        thumb.loading = "lazy";
        thumb.decoding = "async";
        thumb.className = `lightbox-thumb ${idx === currentImageIndex ? 'active' : ''}`;
        thumb.onclick = (e) => {
          e.stopPropagation();
          changeImage(idx);
        };
        lbThumbnails.appendChild(thumb);
      });
    }

    function changeImage(newIndex) {
      if (lbActiveArray === allMediaData) {
        if (newIndex < 0) newIndex = allMediaData.length - 1;
        if (newIndex >= allMediaData.length) newIndex = 0;
      } else {
        const totalImgs = lbActiveArray.length;
        if (newIndex < 0) newIndex = totalImgs - 1;
        if (newIndex >= totalImgs) newIndex = 0;
      }

      const oldIndex = currentImageIndex;
      currentImageIndex = newIndex;

      const currentObj = lbActiveArray[currentImageIndex];
      lbAlbumTitle.textContent = currentObj.title;
      lbCounter.textContent = currentObj.cat;

      if (currentObj.type === 'videos') {
          lbMainImg.style.display = 'none';
          lbVideoPlayer.style.display = 'block';
          
          let embedUrl = '';
          if (currentObj.video_type === 'youtube') {
              let videoId = '';
              const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
              const match = currentObj.video_url.match(regExp);
              if (match && match[2].length === 11) {
                  videoId = match[2];
              }
              embedUrl = videoId ? `https://www.youtube.com/embed/${videoId}?autoplay=1` : currentObj.video_url;
              lbVideoPlayer.innerHTML = `<iframe width="100%" style="aspect-ratio: 16/9; max-height: 85vh;" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
          } else {
              lbVideoPlayer.innerHTML = `<video style="width: 100%; max-height: 85vh; outline: none; background: #000;" controls autoplay controlsList="nodownload"><source src="api/stream_video.php?file=${encodeURIComponent(currentObj.video_url)}" type="video/mp4"></video>`;
          }
      } else {
          lbVideoPlayer.style.display = 'none';
          lbVideoPlayer.innerHTML = '';
          lbMainImg.style.display = 'block';
          lbMainImg.src = currentObj.img.replace("w=600", "w=1200");
      }

      // Instant thumbnail active class switch
      const thumbs = lbThumbnails.querySelectorAll('.lightbox-thumb');
      if (thumbs.length > 0) {
        if (thumbs[oldIndex]) thumbs[oldIndex].classList.remove('active');
        if (thumbs[currentImageIndex]) {
          thumbs[currentImageIndex].classList.add('active');
          thumbs[currentImageIndex].scrollIntoView({
            behavior: 'auto',
            inline: 'center',
            block: 'nearest'
          });
        }
      }
    }

    document.getElementById("lbCloseBtn").addEventListener("click", closeModal);
    modal.addEventListener("click", e => {
      if (e.target === modal) closeModal();
    });

    document.getElementById("lbPrevBtn").addEventListener("click", e => {
      e.stopPropagation();
      changeImage(currentImageIndex - 1);
    });

    document.getElementById("lbNextBtn").addEventListener("click", e => {
      e.stopPropagation();
      changeImage(currentImageIndex + 1);
    });

    // Instant Keyboard Navigation
    document.addEventListener("keydown", e => {
      if (!modal.classList.contains("active")) return;
      if (e.key === "Escape") closeModal();
      if (e.key === "ArrowLeft") {
        e.preventDefault();
        changeImage(currentImageIndex - 1);
      }
      if (e.key === "ArrowRight") {
        e.preventDefault();
        changeImage(currentImageIndex + 1);
      }
    });

    const mosaicMediaData = [];
    document.querySelectorAll('.mosaic-item img').forEach((img, idx) => {
      img.style.cursor = 'zoom-in';
      mosaicMediaData.push({
        img: img.src,
        title: img.alt,
        cat: 'Campus Life'
      });
      img.addEventListener('click', () => {
        openLightbox(idx, mosaicMediaData);
      });
    });

    /* ================= DYNAMIC NOTICES ================= */
    (function() {
      const container = document.getElementById("dynamic-notices-container");
      const tabsContainer = document.getElementById("notice-type-tabs");
      if (!container) return;

      // Mouse drag and wheel to scroll on notice tabs
      if (tabsContainer) {
        let isDown = false;
        let startX;
        let scrollLeft;

        tabsContainer.addEventListener('mousedown', (e) => {
          isDown = true;
          tabsContainer.style.cursor = 'grabbing';
          startX = e.pageX - tabsContainer.offsetLeft;
          scrollLeft = tabsContainer.scrollLeft;
        });
        tabsContainer.addEventListener('mouseleave', () => {
          isDown = false;
          tabsContainer.style.cursor = '';
        });
        tabsContainer.addEventListener('mouseup', () => {
          isDown = false;
          tabsContainer.style.cursor = '';
        });
        tabsContainer.addEventListener('mousemove', (e) => {
          if (!isDown) return;
          e.preventDefault();
          const x = e.pageX - tabsContainer.offsetLeft;
          const walk = (x - startX) * 2;
          tabsContainer.scrollLeft = scrollLeft - walk;
        });

        tabsContainer.addEventListener('wheel', (e) => {
          if (e.deltaY !== 0) {
            e.preventDefault();
            tabsContainer.scrollLeft += e.deltaY;
          }
        }, {
          passive: false
        });
      }

      let currentSelectedType = '';

      function getCategoryIcon(cat) {
        const c = cat.toLowerCase();
        if (c.includes('academic')) return 'fa-graduation-cap';
        if (c.includes('circular')) return 'fa-file-lines';
        if (c.includes('event')) return 'fa-calendar-day';
        if (c.includes('alert') || c.includes('disciplinary')) return 'fa-shield-halved';
        if (c.includes('finance') || c.includes('fee')) return 'fa-coins';
        return 'fa-folder-open';
      }

      // Fetch Category Tabs
      if (tabsContainer) {
        $.ajax({
          url: 'api/notices.php?action=get_categories',
          method: 'GET',
          dataType: 'json'
        }).done(data => {
          if (data.success && data.categories && data.categories.length > 0) {
            data.categories.forEach(cat => {
              const icon = getCategoryIcon(cat);
              const btn = document.createElement('button');
              btn.className = 'notice-tab-btn';
              btn.dataset.type = cat;
              btn.innerHTML = `<i class="fa-solid ${icon}"></i> ${cat}`;
              tabsContainer.appendChild(btn);
            });
            bindNoticeTabClicks();
          }
        });
      }

      function bindNoticeTabClicks() {
        const tabBtns = document.querySelectorAll('#notice-type-tabs .notice-tab-btn');
        tabBtns.forEach(btn => {
          btn.onclick = () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentSelectedType = btn.dataset.type || '';
            fetchIndexNotices(currentSelectedType);
          };
        });
      }

      function fetchIndexNotices(typeFilter = '') {
        container.innerHTML = `
          <li style="text-align: center; padding: 32px 0;">
            <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 2rem; color: #fbbf24;"></i>
          </li>
        `;

        let url = 'api/notices.php?action=get_notices&public_only=1&limit=15';
        if (typeFilter) {
          url += '&type=' + encodeURIComponent(typeFilter);
        }

        $.ajax({
          url: url,
          method: 'GET',
          dataType: 'json'
        }).done(data => {
          if (data.success && data.data && data.data.length > 0) {
            container.innerHTML = '';
            let hasNewNotice = false;
            data.data.forEach(notice => {
              const rawDate = notice.created_at ? notice.created_at.replace(' ', 'T') : '';
              const dateObj = rawDate ? new Date(rawDate) : new Date();
              const dateStr = !isNaN(dateObj.getTime()) ?
                dateObj.toLocaleDateString('en-US', {
                  month: 'short',
                  day: 'numeric',
                  year: 'numeric'
                }) :
                '';

              let actionsHTML = [];
              if (notice.pdf_path) {
                actionsHTML.push(`<a href="${notice.pdf_path}" target="_blank"><i class="fa-solid fa-file-pdf" style="margin-right: 4px;"></i>View Document</a>`);
              }
              if (notice.link) {
                actionsHTML.push(`<a href="${notice.link}" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square" style="margin-right: 4px;"></i>Open Link</a>`);
              }
              let actionsString = actionsHTML.join(' <span style="color: rgba(255,255,255,0.35);">&bull;</span> ');

              const now = new Date();
              const diffMs = now - dateObj;
              const diffDays = diffMs / (1000 * 60 * 60 * 24);
              const isNew = !isNaN(diffDays) && diffDays >= 0 && diffDays <= 7;
              if (isNew) hasNewNotice = true;
              const newBadge = isNew ? '<span class="notice-badge-new">NEW</span>' : '';

              const li = document.createElement('li');
              li.innerHTML = `
                <div class="notice-row">
                  <div class="notice-title" title="${notice.title}">
                    ${notice.title}${newBadge}
                  </div>
                  <div class="notice-meta">
                    <span><i class="fa-regular fa-calendar" style="margin-right: 5px;"></i>${dateStr}</span>
                    ${actionsString ? `<span style="color: rgba(255,255,255,0.4);">&bull;</span> ${actionsString}` : ''}
                  </div>
                </div>
              `;
              container.appendChild(li);
            });

            const pulseDot = document.getElementById('live-pulse-dot');
            if (pulseDot) {
              pulseDot.style.display = hasNewNotice ? 'inline-block' : 'none';
            }
          } else {
            container.innerHTML = `
              <li style="text-align: center; color: rgba(255,255,255,0.6); padding: 40px 0;">
                <i class="fa-solid fa-clipboard-list" style="font-size: 2.5rem; margin-bottom: 10px; opacity: 0.4;"></i>
                <p style="margin: 0; font-size: 0.95rem;">No notices found for this category.</p>
              </li>
            `;
          }
        }).fail((jqXHR, textStatus, err) => {
          console.error('Failed to load notices:', err);
          container.innerHTML = `
            <li style="text-align: center; color: rgba(255,255,255,0.6); padding: 40px 0;">
              <i class="fa-solid fa-triangle-exclamation" style="font-size: 2.2rem; margin-bottom: 10px; opacity: 0.5; color: #ef4444;"></i>
              <p style="margin: 0; font-size: 0.95rem;">Unable to load notices. Please try again later.</p>
            </li>
          `;
        });
      }

      // Initial load
      fetchIndexNotices();
    })();
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="layout/include.js"></script>
</body>

</html>