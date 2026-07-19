/**
 * School for Interdisciplinary Studies & Sustainability (SiSAS), IIT Guwahati
 * Homepage Interactive Features
 * 
 * Contains: Carousel Slider, Autoplay ticker for Announcements,
 * Tabs for Publications/Patents, Intersection Observer Stats Counter,
 * and Mobile Menu responsive behaviors.
 */

document.addEventListener('DOMContentLoaded', () => {


  // 2. Custom Carousel Logic (IIT Madras style hero)
  // ==========================================================================
  const slides = document.querySelectorAll('.carousel-slide-custom');
  const prevBtn = document.querySelector('.carousel-btn-prev');
  const nextBtn = document.querySelector('.carousel-btn-next');
  let currentSlide = 0;
  let carouselInterval;
  const slideDuration = 6000; // 6 seconds

  function updatePreviews() {
    if (slides.length === 0) return;
    const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
    const nextIndex = (currentSlide + 1) % slides.length;

    const prevSlide = slides[prevIndex];
    const nextSlide = slides[nextIndex];

    if (prevSlide && nextSlide) {
      const prevBg = prevSlide.style.backgroundImage;
      const nextBg = nextSlide.style.backgroundImage;

      const prevPreview = prevBtn ? prevBtn.querySelector('.btn-preview') : null;
      const nextPreview = nextBtn ? nextBtn.querySelector('.btn-preview') : null;

      if (prevPreview) {
        prevPreview.style.backgroundImage = prevBg;
      }
      if (nextPreview) {
        nextPreview.style.backgroundImage = nextBg;
      }
    }
  }

  function showSlide(index) {
    if (slides.length === 0) return;
    
    // Bounds check
    if (index >= slides.length) currentSlide = 0;
    else if (index < 0) currentSlide = slides.length - 1;
    else currentSlide = index;

    // Remove active class from all slides
    slides.forEach(slide => slide.classList.remove('active'));

    // Activate the current slide
    slides[currentSlide].classList.add('active');

    // Update the arrow preview thumbnails
    updatePreviews();
  }

  function nextSlide() {
    showSlide(currentSlide + 1);
  }

  function prevSlide() {
    showSlide(currentSlide - 1);
  }

  function startCarouselAutoplay() {
    stopCarouselAutoplay();
    carouselInterval = setInterval(nextSlide, slideDuration);
  }

  function stopCarouselAutoplay() {
    if (carouselInterval) {
      clearInterval(carouselInterval);
    }
  }

  // Event Listeners for Carousel Controls
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      startCarouselAutoplay(); // Reset timer on click
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      startCarouselAutoplay(); // Reset timer on click
    });
  }

  // Pause on hover
  const carouselWrapper = document.querySelector('.hero-carousel-wrapper');
  if (carouselWrapper) {
    carouselWrapper.addEventListener('mouseenter', stopCarouselAutoplay);
    carouselWrapper.addEventListener('mouseleave', startCarouselAutoplay);
  }

  // Initialize carousel
  if (slides.length > 0) {
    showSlide(0);
    startCarouselAutoplay();
  }


  // ==========================================================================
  // 3. Announcements Ticker Logic
  // ==========================================================================
  const announceTabs = document.querySelectorAll('.announce-tab-btn');
  const tickerContainer = document.querySelector('.announcements-ticker-container');
  const tickerList = document.querySelector('.ticker-list');
  let tickerScrollInterval;
  const scrollSpeed = 1.2; // pixels per step
  const scrollIntervalMs = 30; // frequency

  // Tab switching inside announcements panel
  announceTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      announceTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      
      const category = tab.getAttribute('data-category');
      filterAnnouncements(category);
    });
  });

  // Filter announcements based on tab category
  function filterAnnouncements(category) {
    const items = tickerList.querySelectorAll('.ticker-item');
    items.forEach(item => {
      const type = item.getAttribute('data-type');
      if (category === 'all' || type === category) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
    // Reset scroll position on tab change
    if (tickerContainer) {
      tickerContainer.scrollTop = 0;
    }
  }

  // Vertical Auto-scroll Ticker
  function startTicker() {
    if (!tickerContainer || !tickerList) return;
    
    stopTicker();
    
    tickerScrollInterval = setInterval(() => {
      // Only scroll if there is overflow
      if (tickerList.offsetHeight > tickerContainer.offsetHeight) {
        tickerContainer.scrollTop += scrollSpeed;
        
        // If scrolled to the end, wrap around
        if (tickerContainer.scrollTop >= (tickerList.scrollHeight - tickerContainer.clientHeight - 5)) {
          // Take the first child item and append it to the end to loop infinitely
          const firstChild = tickerList.querySelector('.ticker-item:not([style*="display: none"])');
          if (firstChild) {
            tickerList.appendChild(firstChild);
            tickerContainer.scrollTop -= firstChild.offsetHeight;
          }
        }
      }
    }, scrollIntervalMs);
  }

  function stopTicker() {
    if (tickerScrollInterval) {
      clearInterval(tickerScrollInterval);
    }
  }

  if (tickerContainer) {
    tickerContainer.addEventListener('mouseenter', stopTicker);
    tickerContainer.addEventListener('mouseleave', startTicker);
    // Initialize ticker
    startTicker();
  }


  // ==========================================================================
  // 4. Publications & Patents Tabs Switching
  // ==========================================================================
  const tabNavBtns = document.querySelectorAll('.tab-nav-btn');
  const tabPanels = document.querySelectorAll('.tab-panel-custom');

  tabNavBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Deactivate all navigation buttons and panels
      tabNavBtns.forEach(b => b.classList.remove('active'));
      tabPanels.forEach(p => p.classList.remove('active'));

      // Activate current button and matching panel
      btn.classList.add('active');
      const targetId = btn.getAttribute('data-target');
      const targetPanel = document.getElementById(targetId);
      if (targetPanel) {
        targetPanel.classList.add('active');
      }
    });
  });


  // ==========================================================================
  // 5. Research Statistics Counter (Intersection Observer)
  // ==========================================================================
  const counterElements = document.querySelectorAll('.stat-number');
  const counterSection = document.querySelector('.stats-section');

  function animateCounter(el) {
    const target = parseInt(el.getAttribute('data-count'), 10);
    const suffix = el.getAttribute('data-suffix') || '';
    const duration = 2000; // 2 seconds
    const startTime = performance.now();

    function updateCounter(currentTime) {
      const elapsedTime = currentTime - startTime;
      const progress = Math.min(elapsedTime / duration, 1);
      
      // Easing function: easeOutQuad
      const easedProgress = progress * (2 - progress);
      const currentValue = Math.floor(easedProgress * target);

      el.textContent = currentValue + suffix;

      if (progress < 1) {
        requestAnimationFrame(updateCounter);
      } else {
        el.textContent = target + suffix;
      }
    }

    requestAnimationFrame(updateCounter);
  }

  // Set up Intersection Observer for stats section
  if (counterElements.length > 0 && counterSection) {
    let animated = false;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !animated) {
          counterElements.forEach(el => animateCounter(el));
          animated = true;
          // Unobserve once animation is triggered
          observer.unobserve(counterSection);
        }
      });
    }, {
      threshold: 0.2 // Trigger when 20% of section is visible
    });

    observer.observe(counterSection);
  }

  // ==========================================================================
  // 6. Go to Top Button Logic
  // ==========================================================================
  const goToTopBtn = document.getElementById('goToTopBtn');

  if (goToTopBtn) {
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        goToTopBtn.classList.add('show');
      } else {
        goToTopBtn.classList.remove('show');
      }
    });

    goToTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

});
