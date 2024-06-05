<?php

/**
 * Displays the site header.
 *
 */ ?>

<header id="site-header">
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