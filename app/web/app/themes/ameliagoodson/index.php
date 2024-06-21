<?php

/**
 * The main index template file - displays post archives
 *
 * @package NC Theme
 */

get_header();
?>

<main id="site-content" role="main">
	<div class="site-content-inner">

		<?php get_template_part('parts/archive/archive-header'); ?>

		<?php if (have_posts()) : ?>

			<?php get_template_part('parts/archive/posts'); ?>
			<?php get_template_part('parts/archive/pagination'); ?>

		<?php elseif (is_search()) : ?>

			<?php get_template_part('parts/archive/no-results'); ?>

		<?php endif; ?>

	</div><!-- .site-content-inner -->
</main><!-- #site-content -->

<?php
get_footer();
