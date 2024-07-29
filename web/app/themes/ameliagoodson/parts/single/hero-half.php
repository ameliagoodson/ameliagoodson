<!-- Hero half -->
<?php
$hero_image = get_theme_mod('hero_image');
$background_image = get_theme_mod('hero_bg_image_setting');
$text_alignment = get_theme_mod('text_alignment');
$hero_width = get_theme_mod('hero_width');
$hero_title = get_theme_mod('hero_title');
$hero_subtitle = get_theme_mod('hero_subtitle');
$hero_layout = get_theme_mod('hero_layout');
$transparent_header = get_theme_mod('hero_transparent_header');
?>
<main class="hero" <?php if ($background_image && $hero_layout != "No image" && !$transparent_header) : ?> style="background-image: url(<?php echo esc_url($background_image); ?>)" <?php endif ?>>
  <div class="section-inner mw-<?php echo $hero_width ?> i-a a-fade-up">
    <div class="hero-content hero-half">
      <div class="hero-copy col-6 <?php echo "align-" . strtolower($text_alignment) ?>">
        <?php if ($hero_title) : ?>
          <div class="h1 hero-title"><?php echo $hero_title; ?></div>
        <?php endif; ?>
        <?php if ($hero_subtitle) : ?>
          <div class="hero-subtitle contain-margins">
            <?php echo $hero_subtitle ?>
          </div>
        <?php endif; ?>
        <a class="button" href="<?php echo esc_url(home_url('/work')); ?>">See work</a>
      </div>
      <div class="hero-image col-6">
        <img src="<?php echo $hero_image ? esc_url($hero_image) : 'https://placehold.co/500' ?>">
      </div>
    </div>
  </div>
</main>
</div>