  <div class="hero-content">
    <div class="hero-copy <?php echo "align-" . strtolower($text_alignment) ?>">
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
  </div>