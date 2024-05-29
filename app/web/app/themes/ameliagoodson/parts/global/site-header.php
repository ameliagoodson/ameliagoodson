<?php
/**
 * Displays the site header.
 *
 */?>

<header id="site-header">
  <div class="header-inner-wrapper">
    <nav class="header-inner section-inner">

    <!-- If it is the front page, which is also the blog homepage, don't output an h1 tag -->
      <?php if (is_home() && is_front_page())  : ?>
        <div class="entry-title h1"><a href="<?php home_url( ) ?>"><?php bloginfo( 'name' ) ?></a></div>
      <?php else : ?>
        <h1 class="entry-title h1"><a href="<?php home_url() ?>"><?php bloginfo( 'name' ) ?></h1></a>
    <!-- If it is the home page, put the website title as an h1 -->
      <?php endif; ?>
      <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class' => 'main-menu',
      ) )
      ?>
    </nav>
  </div>
</header>
