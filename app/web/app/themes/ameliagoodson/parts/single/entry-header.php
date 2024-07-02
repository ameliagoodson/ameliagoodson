<?php

/**
 * Displays the entry hero on single posts
 *
 */

?>

<div class="entry-header">
  <div class="section-inner mw-small i-a a-fade-up">

    <?php if (is_front_page() && is_home()) : ?>
      <div class="entry-title h1"><?php the_title(); ?></div>
    <?php else : ?>
      <h1 class="entry-title h1"><?php the_title(); ?></h1>
    <?php endif; ?>
    <?php if (has_excerpt()) : ?>
      <div class="intro-text contain-margins">
        <?php the_excerpt(); ?>
      </div>
    <?php endif; ?>

  </div>

  <?php if (has_post_thumbnail() && !post_password_required()) : ?>
    <figure class="featured-media section-inner mw-small i-a a-fade-up a-del-200">
      <div class="media-wrapper">
        <?php the_post_thumbnail(); ?>
      </div>
    </figure>
  <?php endif; ?>

</div>