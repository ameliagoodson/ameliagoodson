<?php
/**
 * Displays the single post content.
 *
 */

?>
<?php 
$hero_layout = get_field('hero_layout');
?>

  <?php
  if ($hero_layout) {
      get_template_part( 'parts/single/hero-' . strtolower($hero_layout) );
    } 
  ?>

	<div class="post-inner">
    <div class="section-inner mw-thin do-spot spot-fade-up a-del-200">

      <?php get_template_part( 'parts/single/entry-content' ); ?>

    </div><!-- .section-inner -->
	</div><!-- .post-inner -->

  <?php get_template_part( 'parts/single/post-navigation' ); ?>

  <?php comments_template(); ?>

</article><!-- .post -->