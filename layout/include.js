/* ==========================================================================
   Universal layout loader — injects the shared header, mobile drawer and
   footer (from /layout/*.html) into every page and wires up their behavior
   (mega menu, mobile drawer, font size, high contrast).

   Usage: place placeholder elements in the page body:
     <div id="header-placeholder"></div>
     <div id="mobile-drawer-placeholder"></div>
     <div id="footer-placeholder"></div>
   and include this script once, near the end of <body>:
     <script src="layout/include.js"></script>          (from site root)
     <script src="../layout/include.js"></script>       (from /pages/*.html)

   NOTE: because it uses fetch() to load the HTML partials, pages must be
   served over http(s) (e.g. VS Code "Live Server") rather than opened
   directly via file:// for the includes to load.
   ========================================================================== */
(function () {
  "use strict";

  var scriptEl = document.currentScript;
  // Absolute URL of the site root (the parent folder of /layout/).
  var ROOT = new URL("..", scriptEl.src).href;

  function loadPartial(fileName, targetId) {
    var target = document.getElementById(targetId);
    if (!target) return Promise.resolve();

    return fetch(ROOT + "layout/" + fileName)
      .then(function (res) {
        if (!res.ok) throw new Error("Failed to load " + fileName);
        return res.text();
      })
      .then(function (html) {
        var t = document.getElementById(targetId);
        if (t) t.outerHTML = html.split("%%BASE%%").join(ROOT);
      })
      .catch(function (err) {
        console.warn("Partial load skipped for " + fileName + ":", err);
      });
  }

  function initMegaMenu() {
    document.querySelectorAll(".nav-list > li").forEach(function (li) {
      var btn = li.querySelector("button.nav-top");
      if (!btn) return;
      if (btn.dataset.initialized === "true") return;
      btn.dataset.initialized = "true";

      btn.addEventListener("click", function (e) {
        e.stopPropagation();
        var isOpen = li.classList.contains("open");
        document.querySelectorAll(".nav-list > li.open").forEach(function (o) {
          o.classList.remove("open");
          var b = o.querySelector("button.nav-top");
          if (b) b.setAttribute("aria-expanded", "false");
        });
        if (!isOpen) {
          li.classList.add("open");
          btn.setAttribute("aria-expanded", "true");
        }
      });

      li.addEventListener("mouseenter", function () {
        if (window.innerWidth > 992) {
          li.classList.add("open");
          btn.setAttribute("aria-expanded", "true");
        }
      });

      li.addEventListener("mouseleave", function () {
        if (window.innerWidth > 992) {
          li.classList.remove("open");
          btn.setAttribute("aria-expanded", "false");
        }
      });
    });

    if (!window.__megaMenuGlobalClickBound) {
      window.__megaMenuGlobalClickBound = true;
      document.addEventListener("click", function (e) {
        if (!e.target.closest(".nav-list > li")) {
          document.querySelectorAll(".nav-list > li.open").forEach(function (o) {
            o.classList.remove("open");
            var b = o.querySelector("button.nav-top");
            if (b) b.setAttribute("aria-expanded", "false");
          });
        }
      });
    }
  }

  function initMobileDrawer() {
    var hamburgerBtn = document.getElementById("hamburgerBtn"),
      mobileNav = document.getElementById("mobileNav"),
      scrim = document.getElementById("scrim"),
      closeDrawer = document.getElementById("closeDrawer");
    if (!hamburgerBtn || !mobileNav || !scrim || !closeDrawer) return;

    if (hamburgerBtn.dataset.initialized === "true") return;
    hamburgerBtn.dataset.initialized = "true";

    function openDrawer() {
      mobileNav.classList.add("open");
      scrim.classList.add("open");
      hamburgerBtn.setAttribute("aria-expanded", "true");
    }
    function shutDrawer() {
      mobileNav.classList.remove("open");
      scrim.classList.remove("open");
      hamburgerBtn.setAttribute("aria-expanded", "false");
    }
    hamburgerBtn.addEventListener("click", openDrawer);
    closeDrawer.addEventListener("click", shutDrawer);
    scrim.addEventListener("click", shutDrawer);
  }

  function initAccessibility() {
    var fontScale = 100;
    function applyFont() {
      document.documentElement.style.fontSize = fontScale + "%";
    }
    var fontUp = document.getElementById("fontUp"),
      fontDown = document.getElementById("fontDown"),
      fontReset = document.getElementById("fontReset"),
      contrastBtn = document.getElementById("contrastToggle");

    if (fontUp && !fontUp.dataset.initialized) {
      fontUp.dataset.initialized = "true";
      fontUp.addEventListener("click", function () { fontScale = Math.min(130, fontScale + 10); applyFont(); });
    }
    if (fontDown && !fontDown.dataset.initialized) {
      fontDown.dataset.initialized = "true";
      fontDown.addEventListener("click", function () { fontScale = Math.max(80, fontScale - 10); applyFont(); });
    }
    if (fontReset && !fontReset.dataset.initialized) {
      fontReset.dataset.initialized = "true";
      fontReset.addEventListener("click", function () { fontScale = 100; applyFont(); });
    }
    if (contrastBtn && !contrastBtn.dataset.initialized) {
      contrastBtn.dataset.initialized = "true";
      contrastBtn.addEventListener("click", function () {
        document.body.classList.toggle("hc");
        contrastBtn.setAttribute("aria-pressed", document.body.classList.contains("hc"));
      });
    }
  }

  function initGoToTop() {
    var goToTopBtn = document.getElementById("goToTopBtn");
    if (!goToTopBtn || goToTopBtn.dataset.initialized === "true") return;
    goToTopBtn.dataset.initialized = "true";
    window.addEventListener("scroll", function () {
      if (window.scrollY > 300) {
        goToTopBtn.classList.add("show");
      } else {
        goToTopBtn.classList.remove("show");
      }
    });
    goToTopBtn.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  function initScrollSpy() {
    var contentBoxes = document.querySelectorAll('.content-box[id]');
    if (contentBoxes.length === 0) return;
    
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var id = entry.target.id;
          var buttons = document.querySelectorAll('.sidebar-menu .tab-btn');
          buttons.forEach(function(btn) {
            var onclickAttr = btn.getAttribute('onclick');
            if (onclickAttr && (onclickAttr.indexOf("'" + id + "'") !== -1 || onclickAttr.indexOf('"' + id + '"') !== -1)) {
              buttons.forEach(function(b) { b.classList.remove('active'); });
              btn.classList.add('active');
            }
          });
        }
      });
    }, { rootMargin: '-110px 0px -60% 0px', threshold: 0 });

    contentBoxes.forEach(function(box) {
      observer.observe(box);
    });
  }

  function runAllInits() {
    initMegaMenu();
    initAccessibility();
    initGoToTop();
    initScrollSpy();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", runAllInits);
  } else {
    runAllInits();
  }

  Promise.all([
    loadPartial("mobile-drawer.html", "mobile-drawer-placeholder")
  ])
    .then(function () {
      runAllInits();
      initMobileDrawer();
      document.dispatchEvent(new CustomEvent("layout:ready"));
    });
})();
