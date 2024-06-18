<?php

/**
 * Displays the site header.
 *
 */ ?>

<?php
$header_color = get_theme_mod('header_color');
?>
<header id="site-header" <?php if ($header_color) : ?> style="background-color: <?php echo $header_color;
                                                                              endif; ?>">
  <div class="header-inner-wrapper">
    <nav class="header-inner section-inner">
      <h1 class="site-logo">
        <a href="<?php echo esc_url(home_url()) ?>"><img src="http://ameliagoodson.local/app/uploads/2024/06/logo-brand-black-future.png"></a>
        <span class="screen-reader-text">Amelia Goodson</span>
      </h1>
      <?php wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class' => 'main-menu',
      ))
      ?>
    </nav>
  </div>
</header>