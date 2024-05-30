<?php

/**
 * Displays the hero with half image, half text
 *
 */

?>

<?php
$hero_title = get_field('hero_title');
?>

<header class="entry-header">
  <div class="section-inner mw-wide i-a a-fade-up">
    <div class="hero-content">
      <div class="hero-copy col-d-6">
        <?php if ($hero_title) : ?>
          <div class="hero-title"><?php echo $hero_title ?></div>
        <?php endif; ?>
        <?php if (has_excerpt()) : ?>
          <div class="hero-subtitle contain-margins">
            <?php the_excerpt(); ?>
          </div><!-- .hero-subtitle -->
        <?php endif; ?>
        <a class="button" href="<?php echo esc_url(home_url('/work')) ?>">See work</a>
      </div>
      <div class="hero-image col-d-6">
        <figure class="i-a a-fade-up a-del-200">
          <div class="media-wrapper">
            <?php if (has_post_thumbnail() && !post_password_required()) : ?>
              <?php the_post_thumbnail(); ?>
            <?php endif; ?>
          </div><!-- .media-wrapper -->
        </figure><!-- .featured-media -->

      </div>
    </div>
  </div><!-- .section-inner -->
</header><!-- .entry-header -->