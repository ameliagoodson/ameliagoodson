<?php
$hero_image = get_field('hero_image');
$hero_layout = get_field('hero_layout');
$text_alignment = get_field('text_alignment');
$hero_width = get_field('hero_width');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_layout = get_field('hero_layout');

set_query_var('hero_layout', $hero_layout);
set_query_var('hero_image', $hero_image);
set_query_var('text_alignment', $text_alignment);
set_query_var('hero_width', $hero_width);
set_query_var('hero_title', $hero_title);
set_query_var('hero_subtitle', $hero_subtitle);
set_query_var('hero_layout', $hero_layout);
?>

<section class="hero<?php
                    if ($hero_layout == "Full image") : echo " hero-full";
                    endif; ?>" style="background-image: url(<?php echo esc_url($hero_image['url']) ?>)">
  <div class=" section-inner mw-<?php echo strtolower($hero_width) ?> i-a a-fade-up">
    <?php if ($hero_layout == 'Full image' || $hero_layout == "No image") {
      get_template_part('parts/single/hero-full');
    } else {
      get_template_part('parts/single/hero-half');
    } ?>
  </div>
</section>
</div>