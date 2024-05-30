<?php

/**
 * Displays the entry header.
 *
 * @package NC Theme
 */

?>

<header class="entry-header">
  <div class="section-inner mw-thin i-a a-fade-up">

    <hr class="has-accent-color" aria-hidden="true" />

    <h1>test full width</h1>

    <?php if (has_excerpt()) : ?>
      <div class="intro-text contain-margins">
        <?php the_excerpt(); ?>
      </div><!-- .intro-text -->
    <?php endif; ?>

  </div><!-- .section-inner -->

  <?php if (has_post_thumbnail() && !post_password_required()) : ?>
    <figure class="featured-media section-inner i-a a-fade-up a-del-200">
      <div class="media-wrapper">
        <?php the_post_thumbnail(); ?>
      </div><!-- .media-wrapper -->
    </figure><!-- .featured-media -->
  <?php endif; ?>

</header><!-- .entry-header -->