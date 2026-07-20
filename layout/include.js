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
    return fetch(ROOT + "layout/" + fileName)
      .then(function (res) {
        if (!res.ok) throw new Error("Failed to load " + fileName);
        return res.text();
      })
      .then(function (html) {
        var target = document.getElementById(targetId);
        if (target) target.outerHTML = html.split("%%BASE%%").join(ROOT);
      });
  }

  function initMegaMenu() {
    document.querySelectorAll(".nav-list > li").forEach(function (li) {
      var btn = li.querySelector("button.nav-top");
      if (!btn) return;
      btn.addEventListener("click", function () {
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
    });
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

  function initMobileDrawer() {
    var hamburgerBtn = document.getElementById("hamburgerBtn"),
      mobileNav = document.getElementById("mobileNav"),
      scrim = document.getElementById("scrim"),
      closeDrawer = document.getElementById("closeDrawer");
    if (!hamburgerBtn || !mobileNav || !scrim || !closeDrawer) return;

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

    if (fontUp) fontUp.addEventListener("click", function () { fontScale = Math.min(130, fontScale + 10); applyFont(); });
    if (fontDown) fontDown.addEventListener("click", function () { fontScale = Math.max(80, fontScale - 10); applyFont(); });
    if (fontReset) fontReset.addEventListener("click", function () { fontScale = 100; applyFont(); });
    if (contrastBtn) contrastBtn.addEventListener("click", function () {
      document.body.classList.toggle("hc");
      contrastBtn.setAttribute("aria-pressed", document.body.classList.contains("hc"));
    });
  }

  function initGoToTop() {
    var goToTopBtn = document.getElementById("goToTopBtn");
    if (!goToTopBtn) return;
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

  Promise.all([
    loadPartial("header.html", "header-placeholder"),
    loadPartial("mobile-drawer.html", "mobile-drawer-placeholder"),
    loadPartial("footer.html", "footer-placeholder"),
  ])
    .then(function () {
      initMegaMenu();
      initMobileDrawer();
      initAccessibility();
      initGoToTop();
      document.dispatchEvent(new CustomEvent("layout:ready"));
    })
    .catch(function (err) {
      console.error("Layout include failed:", err);
    });
})();
