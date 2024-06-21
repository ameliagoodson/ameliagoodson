<?php
$hero_image = get_theme_mod('hero_image');
$background_image = get_theme_mod('hero_bg_image_setting');
$text_alignment = get_theme_mod('text_alignment');
$hero_width = get_theme_mod('hero_width');
$hero_title = get_theme_mod('hero_title');
$hero_subtitle = get_theme_mod('hero_subtitle');
$hero_layout = get_theme_mod('hero_layout');
$transparent_header = get_theme_mod('hero_transparent_header');


set_query_var('hero_layout', $hero_layout);
set_query_var('hero_image', $hero_image);
set_query_var('background_image', $background_image);
set_query_var('text_alignment', $text_alignment);
set_query_var('hero_width', $hero_width);
set_query_var('hero_title', $hero_title);
set_query_var('hero_subtitle', $hero_subtitle);
set_query_var('hero_layout', $hero_layout);
set_query_var('transparent_header', $transparent_header);
?>

<section class="hero" <?php if ($background_image && $hero_layout != "No image" && !$transparent_header) : ?> style="background-image: url(<?php echo esc_url($background_image); ?>)" <?php endif ?>>
  <div class="section-inner mw-<?php echo $hero_width ?> i-a a-fade-up">
    <?php if ($hero_layout == 'Full image' || $hero_layout == "No image") {
      get_template_part('parts/single/hero-full');
    } else {
      get_template_part('parts/single/hero-half');
    } ?>
  </div>
</section>
</div>