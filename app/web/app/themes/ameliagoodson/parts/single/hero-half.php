<?php

/**
 * Displays the hero with half image, half text
 *
 */

?>

<?php
$hero_title = get_field('hero_title');
?>

<section class="hero">
  <div class="section-inner mw-large i-a a-fade-up">
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

      <?php $svg_file_path = get_template_directory() . '/assets/svg/womansitting.svg';
      ?>
      <div class="hero-image col-d-6">
        <figure class="i-a a-fade-up a-del-200">
          <?php if (file_exists($svg_file_path)) : ?>
            <div class="draw-svg">
              <?php
              // Read SVG content and add class="path" to all <path> elements
              $svg_content = file_get_contents($svg_file_path);
              $svg_content_with_class = preg_replace('/<path/', '<path class="path"', $svg_content);
              echo $svg_content_with_class;
              ?>
            </div>
          <?php endif; ?>
        </figure>
        <div class="media-wrapper">
        </div>

        <!-- .media-wrapper -->

        <!-- .featured-media -->
      </div>
    </div>
  </div><!-- .section-inner -->
</section><!-- .hero -->