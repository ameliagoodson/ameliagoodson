<?php get_template_part('parts/global/site-footer') ?>

<?php wp_footer(); ?>

<?php global $icons; ?>
<!-- back to top button -->
<button class="btn-back-to-top" id="btn-back-to-top" onclick="backToTop()">
  <div class="icon">
    <?php echo $icons['arrow-up-circle-outline'] ?>
  </div>
</button>
</div>
</body>

</html>