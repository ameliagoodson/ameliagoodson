<?php

/**
 * The template for displaying all single posts and pages.
 *
 */

get_header();
?>

<main id="site-content" role="main">
  <div class="site-content-inner">

    <?php
    while (have_posts()) {
      the_post();
      get_template_part('parts/single/content', get_post_type());
    }
    ?>

  </div>
</main>

<?php
get_footer();
