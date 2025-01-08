<?php
function ag_is_blank_canvas()
{

  $blank_canvas_templates = array(
    'page-templates/template-blank-canvas.php',
    'page-templates/template-blank-canvas-with-aside.php'
  );

  return is_page_template($blank_canvas_templates);
}



/**
 * Checks if we're outputting the archive filters.
 */
function agtheme_show_archive_filters()
{

  $paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
  $archive_filters = is_home() && get_theme_mod('agtheme_show_archive_filters', true);

  if (is_page_template('page-templates/template-custom-archive.php')) {
    $archive_filters = get_post_meta(get_the_ID(), 'custom_archive_filters', true);
  }

  return $archive_filters &&  $paged == 1;
}


/**
 * Console log
 */
function console_log($obj)
{
  $data = json_encode(print_r($obj, true));
?>
  <style type="text/css">
    #bsdLogger {
      position: fixed;
      top: 0px;
      right: 0px;
      border-left: 4px solid #bbb;
      padding: 15px;
      background: white;
      color: #444;
      z-index: 999999999;
      font-size: 12px;
      width: 30vw;
      min-width: 300px;
      max-width: 900px;
      height: 100vh;
      overflow: scroll;
    }

    body.admin-bar #bsdLogger {
      padding-top: 50px;
    }
  </style>
  <script type="text/javascript">
    var debug = function() {
      var obj = <?php echo $data; ?>;
      var logger = document.getElementById('bsdLogger');
      if (!logger) {
        logger = document.createElement('div');
        logger.id = 'bsdLogger';
        document.body.appendChild(logger);
      }
      var pre = document.createElement('pre');
      pre.classList.add('xdebug-var-dump');
      pre.innerHTML = obj;
      logger.appendChild(pre);
    };
    window.addEventListener("DOMContentLoaded", debug, false);
  </script>
<?php
}

/* ------------------------------------------------------------------------------ /*
/*  SVG ICON HELPER 
/* ------------------------------------------------------------------------------ */
function ag_get_icon_svg($icon_name, $size = '24')
{
  global $icons;

  if (isset($icons[$icon_name])) {
    $svg = $icons[$icon_name];

    // Check if width/height attributes are missing
    if (strpos($svg, 'width=') === false && strpos($svg, 'height=') === false) {
      // Inject width and height attributes into the <svg> tag
      $svg = preg_replace(
        '/<svg /', // Match the opening <svg> tag
        '<svg width="' . $size . '" height="' . $size . '" ', // Add the attributes
        $svg,
        1 // Replace only the first match
      );
    } else {
      // Replace existing width and height attributes with the new size
      $svg = str_replace(
        ['width="24"', 'height="24"'],
        ['width="' . $size . '"', 'height="' . $size . '"'],
        $svg
      );
    }

    return $svg;
  }

  // Fallback if the icon is not found
  return '<svg class="svg-icon" width="' . $size . '" height="' . $size . '" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><circle cx="' . ($size / 2) . '" cy="' . ($size / 2) . '" r="' . ($size / 2) . '"></circle></svg>';
}
