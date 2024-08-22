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
  <div class="header-inner-wrapper d-desktop">
    <nav class="header-inner section-inner">
      <h1 class="site-logo">
        <a href="<?php echo esc_url(home_url()) ?>"><img src="http://ameliagoodson.local/app/uploads/2024/06/logo-brand-black-future.png"></a>
        <span class="screen-reader-text">Amelia Goodson</span>
      </h1>
      <?php wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class' => 'menu main-menu',
      ))
      ?>
    </nav>
  </div>
  <div class="mobile-header d-flex-mobile">
    <button class="hamburger-btn" aria-controls="mobile-menu" aria-expanded="false">
      <div class="menu-bar top"></div>
      <div class="menu-bar middle"></div>
      <div class="menu-bar bottom"></div>
    </button>
    <?php wp_nav_menu(array(
      'theme_location' => 'primary',
      'menu_class' => 'menu mobile-menu',
      'container' => 'nav',
      'container_class' => 'mobile-menu-container',
    )) ?>
</header>

<script>
  document.querySelector('.hamburger-btn').addEventListener('click', function() {
    document.querySelector('.mobile-menu-container').classList.toggle('active')
  })
</script>