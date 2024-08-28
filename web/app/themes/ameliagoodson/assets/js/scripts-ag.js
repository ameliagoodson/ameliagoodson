/* ------------------------------------------------------------------------------ /*
/*  NAMESPACE
/* ------------------------------------------------------------------------------ */

var agtheme = agtheme || {},
  $ = jQuery;

/* ------------------------------------------------------------------------------ /*
/*  GLOBALS
/* ------------------------------------------------------------------------------ */

var $agthemeDoc = $(document),
  $agthemeWin = $(window),
  agthemeIsIE11 = !!window.MSInputMethodContext && !!document.documentMode;

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
