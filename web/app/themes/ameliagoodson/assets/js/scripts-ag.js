/* ------------------------------------------------------------------------------ /*
/*  NAMESPACE
/* ------------------------------------------------------------------------------ */

// let is used here because we need to declare agtheme first, and then conditionally initialize it.
// const cannot be used because it requires initialization at the time of declaration.
// Use $ instead of writing "jQuery" (shorthand)
let agtheme;
if (typeof agtheme === "undefined") {
  agtheme = {};
}
const $ = jQuery;

/* ------------------------------------------------------------------------------ /*
/*  GLOBALS
/* ------------------------------------------------------------------------------ */

const $agthemeDoc = $(document);
const $agthemeWin = $(window);
const agthemeIsIE11 = !!window.MSInputMethodContext && !!document.documentMode;

/* ------------------------------------------------------------------------------ /*
/*  GRID
/* ------------------------------------------------------------------------------ */

agtheme.grid = {
  init: function () {
    var $wrapper = $(".posts-grid");

    if ($wrapper.length) {
      $wrapper.imagesLoaded(function () {
        $grid = $wrapper.isotope({
          columnWidth: ".grid-sizer",
          itemSelector: ".js-grid-item",
          percentPosition: true,
          stagger: 0,
          transitionDuration: "0.25s",
          hiddenStyle: { opacity: 0 },
          visibleStyle: { opacity: 1 },
          layoutMode: $wrapper.data("layout") == "masonry" ? "masonry" : "fitRows",
        });

        // Trigger will-be-spotted elements.
        $grid.on("layoutComplete", function () {
          $agthemeWin.trigger("scroll");
        });

        // Check for Masonry layout changes on an interval. Accounts for DOM changes caused by lazyloading plugins.
        // The interval is cleared when all previews have been spotted.
        agtheme.grid.intervalUpdate($grid);

        // Reinstate the interval when new content is loaded.
        $agthemeWin.on("ajax-content-loaded", function () {
          agtheme.grid.intervalUpdate($grid);
        });
      });
    }
  },

  intervalUpdate: function ($grid) {
    var gridLayoutInterval = setInterval(function () {
      $grid.isotope();

      // Clear the interval when all previews have been spotted.
      if (!$(".preview.do-spot:not(.spotted)").length) {
        clearInterval(gridLayoutInterval);
      }
    }, 1000);
  },
};

/* ------------------------------------------------------------------------------ /*
/*  INIT
/* ------------------------------------------------------------------------------ */

$agthemeDoc.ready(function () {
  agtheme.grid.init();
});

/* ------------------------------------------------------------------------------ /*
/*  SCROLL REVEAL JS
/* ------------------------------------------------------------------------------ */

document.addEventListener("DOMContentLoaded", function () {
  ScrollReveal().reveal(".reveal", {
    distance: "50px",
    duration: 1000,
    easing: "ease-in-out",
    origin: "bottom",
    reset: false,
    interval: 300,
  });

  ScrollReveal().reveal(".reveal-100", {
    distance: "50px",
    duration: 1000,
    easing: "ease-in-out",
    origin: "bottom",
    reset: false,
    delay: 100,
  });
  ScrollReveal().reveal(".reveal-200", {
    distance: "50px",
    duration: 1000,
    easing: "ease-in-out",
    origin: "bottom",
    reset: false,
    delay: 200,
  });

  ScrollReveal().reveal(".reveal-300", {
    distance: "50px",
    duration: 1000,
    easing: "ease-in-out",
    origin: "bottom",
    reset: false,
    delay: 300,
  });

  ScrollReveal().reveal(".reveal-400", {
    distance: "50px",
    duration: 1000,
    easing: "ease-in-out",
    origin: "bottom",
    reset: false,
    delay: 400,
  });
});

/* ------------------------------------------------------------------------------ /*
/*  BACK TO TOP BUTTON
/* ------------------------------------------------------------------------------ */

window.addEventListener("scroll", displayButton);

function displayButton() {
  let btn = document.getElementById("btn-back-to-top");

  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    btn.classList.add("show");
  } else {
    btn.classList.remove("show");
  }
}

function backToTop() {
  document.body.scrollTop = 0; // for Safari
  document.documentElement.scrollTop = 0; // for other browsers
}

// ------------------------------------------------------------------------------ //
//  MOBILE HAMBURGER MENU
// ------------------------------------------------------------------------------ //

document.addEventListener("DOMContentLoaded", function () {
  const button = document.querySelector(".hamburger-btn");

  button.addEventListener("click", function () {
    const mobileMenu = document.querySelector(".mobile-menu-container");

    if (mobileMenu) {
      const isActive = mobileMenu.classList.toggle("active");
      button.classList.toggle("active");
      document.body.classList.toggle("menu-open"); // prevent scrolling on mobile menu
      button.setAttribute("aria-expanded", isActive);
    }
  });
});
