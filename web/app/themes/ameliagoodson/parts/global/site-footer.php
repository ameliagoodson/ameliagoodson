<footer id="site-footer">
  <div class="footer-top footer-inner section-inner">
    <div class="footer-columns">
      <div class="footer-column footer-branding">
        <div class="footer-logo">
          <a href="<?php echo esc_url(home_url()) ?>"><img src="<?php echo get_template_directory_uri() .  "/assets/img/logo-brand-coloured-future.png" ?>"></a>
        </div>
      </div>
      <div class="footer-column footer-nav">
        <?php wp_nav_menu(array(
          'theme_location' => 'footer',
          'container' => 'nav',
          'container_class' => 'footer-menu-container',
          'menu_class' => 'footer-menu reset-list-style',

        ))
        ?>
        <div class="footer-social">
          <ul class="footer-menu reset-list-style">
            <li><a href="https://www.linkedin.com/in/ameliagoodson/"><?php echo ag_get_icon_svg('linkedin') ?></a></li>
            <li><a href="https://github.com/ameliagoodson"><?php echo ag_get_icon_svg('github') ?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom footer-inner section-inner">
    <div class="footer-credits">
      <p class="footer-copyright">&copy; <?php echo esc_html(date_i18n(esc_html__('Y', 'lysanderfunds'))); ?> <?php bloginfo('name'); ?></p>
    </div><!-- .footer-credits -->
  </div>
</footer>