<!-- hero.php -->
<?php
$layout_type = get_field('image_type');
$text_alignment = get_field('text_alignment');
$hero_width = get_field('hero_width');
$hero_title = get_field('hero_title');
?>

<section class="hero">
  <div class="section-inner mw-large i-a a-fade-up">
    <div class="hero-content">
      <div class="hero-copy <?php echo "align-" . $text_alignment ?>">
        <?php if ($hero_title) : ?>
          <div class="hero-title"><?php echo $hero_title; ?></div>
        <?php endif; ?>
        <?php if (has_excerpt()) : ?>
          <div class="hero-subtitle contain-margins">
            <?php the_excerpt(); ?>
          </div><!-- .hero-subtitle -->
        <?php endif; ?>
        <a class="button" href="<?php echo esc_url(home_url('/work')); ?>">See work</a>
      </div>


    </div>
  </div><!-- .section-inner -->
</section><!-- .hero -->
</div>