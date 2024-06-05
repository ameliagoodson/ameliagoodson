<?php

/**
 * Displays the default single post content.
 *
 */


?>

<div class="post-inner">
  <div class="section-inner mw-medium do-spot spot-fade-up a-del-200">

    <?php get_template_part('parts/single/entry-content'); ?>

  </div><!-- .section-inner -->
</div><!-- .post-inner -->

<?php get_template_part('parts/single/post-navigation'); ?>

<?php comments_template(); ?>

</article><!-- .post -->