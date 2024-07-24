<?php
$footer_logo = get_field('footer_logo');
$footer_link = get_field('footer_link');
$footer_text = get_field('footer_text');
?>
<footer id="site-footer">
  <div class="footer-top footer-inner section-inner">
    <div class="footer-columns">
      <div class="footer-column footer-branding">
        <?php if ($footer_logo) : ?>
          <div class="footer-logo">
            <a href="<?php echo esc_url(home_url()) ?>"><img src="<?php echo esc_url($footer_logo['url']) ?>"></a>
          </div>
        <?php endif; ?>
        <?php if ($footer_text) : ?>
          <div class="footer-text">
            <a href="<?php echo esc_url($footer_link['url']) ?>"><?php echo $footer_text ?></a>
          </div>
        <?php endif; ?>
      </div>
      <div class="footer-column footer-nav">
        <?php wp_nav_menu(array(
          'theme_location' => 'footer',
          'container' => 'nav',
          'container_class' => 'footer-menu-container',
          'menu_class' => 'footer-menu',

        ))
        ?>
        <div class="footer-social footer-menu">
          <ul>
            <li>LinkedIn</li>
            <li>Github</li>
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