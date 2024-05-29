<?php

// ------------------------------------------------------------------------------ //
//  Template tags are collections of functions designed to output something e.g. logo
// ------------------------------------------------------------------------------ //


/**
 * Outputs the post meta for a given context and post ID.
 */
function ag_the_post_meta( $context = 'archive', $post_id = '' ) {

  if( ! $post_id ) {
    global $post;
    $post_id = $post->ID;
  }

  // Escaped in ag_get_post_meta().
  echo ag_get_post_meta( $context, $post_id );

}

/**
 * Returns the post meta for a given post and context.
 */
function ag_get_post_meta( $context = 'archive', $post_id = '' ) {

  if( ! $post_id ) {
    global $post;
    $post_id = $post->ID;
  }

  // Get our post type.
  $post_type = get_post_type( $post_id );

  // Get the list of the post types that support post meta, and only proceed if the current post type is supported.
  $post_type_has_post_meta 	 = false;
  $post_types_with_post_meta = AG_Theme_Customizer::get_post_types_with_post_meta();

  foreach ( $post_types_with_post_meta as $post_type_with_post_meta => $data ) {
    if ( $post_type == $post_type_with_post_meta ) {
      $post_type_has_post_meta = true;
      break;
    }
  }

  if ( ! $post_type_has_post_meta ) {
    return;
  }

  // Get the default post meta for this post type.
  $post_meta_default = isset( $post_types_with_post_meta[$post_type]['default'][$context] ) ? $post_types_with_post_meta[$post_type]['default'][$context] : array();

  // Determine the Customizer setting name based on post type and context.
  $theme_mod_name = 'ag_post_meta_' . $post_type;

  if ( $context !== 'archive' ) {
    $theme_mod_name .= '_' . $context;
  }

  // Get the post meta for this post type from the Customizer setting.
  $post_meta = get_theme_mod( $theme_mod_name, $post_meta_default );

  // If we have post meta, sort it.
  if ( $post_meta && ! in_array( 'empty', $post_meta ) ) {

    // Set the output order of the post meta.
    $post_meta_order = array( 'date', 'author', 'categories', 'tags', 'comments', 'edit-link' );

    // Store any custom post meta items in a separate array, so we can append them after sorting.
    $post_meta_custom = array_diff( $post_meta, $post_meta_order );

    // Loop over the intended order, and sort $post_meta_reordered accordingly.
    $post_meta_reordered = array();
    foreach ( $post_meta_order as $i => $post_meta_name ) {
      $original_i = array_search( $post_meta_name, $post_meta );

      if ( $original_i === false ) {
        continue;
      }
      
      $post_meta_reordered[$i] = $post_meta[$original_i];
    }

    // Reassign the reordered post meta with custom post meta items appended, and update the indexes.
    $post_meta = array_values( array_merge( $post_meta_reordered, $post_meta_custom ) );

  }

  // If the post meta setting has the value 'empty' at this point, it's explicitly empty and the default post meta shouldn't be output.
  if ( ! $post_meta || ( $post_meta && in_array( 'empty', $post_meta ) ) ) {
    return;
  }

  // Enable the $ag_has_meta variable to be modified in actions.
  global $ag_has_meta;

  // Default it to false, to make sure we don't output an empty container.
  $ag_has_meta = false;

  global $post;
  $post = get_post( $post_id );
  setup_postdata( $post );

  // Record out output.
  ob_start();
  ?>

  <div class="post-meta-wrapper">
    <ul class="post-meta">

      <?php
      foreach ( $post_meta as $post_meta_item ) {
        switch ( $post_meta_item ) {

          // DATE
          case 'date' : 
            $ag_has_meta = true;
            $entry_time 	      = get_the_time( get_option( 'date_format' ) );
						$date_link 			    = get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) );
						$entry_time_str     = '<time><a href="' . esc_url( $date_link ) . '">' . $entry_time . '</a></time>';
						?>
            <li class="date">
              <?php 
              if ( $context == 'single' ) {
                printf( esc_html_x( 'Published %s', '%s = The date of the post', 'ag' ), $entry_time_str );	
              } else {
                echo $entry_time_str;
              }
              ?>
            </li>
            <?php
          break;

          // AUTHOR
          case 'author' : 
            $ag_has_meta = true;
            ?>
            <li class="author">
              <?php 
              // Translators: %s = the author name
              printf( esc_html_x( 'By %s', '%s = author name', 'ag' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>' ); ?>
            </li>
            <?php
          break;

          // CATEGORIES
          case 'categories' : 

            // Determine which taxonomy to use for "categories".
            $category_taxonomy = 'category';

            if ( ! has_term( '', $category_taxonomy, $post_id ) ) {
              break;
            }

            $ag_has_meta = true;
            $prefix = ( $context == 'single' ) ? esc_html__( 'Posted in', 'ag' ) : esc_html__( 'In', 'ag' );
            ?>
            <li class="categories">
              <?php the_terms( $post_id, $category_taxonomy, $prefix . ' ', ', ' ); ?>
            </li>
            <?php
          break;

          // TAGS
          case 'tags' : 

            // Determine which taxonomy to use for tags.
            $tag_taxonomy = 'post_tag';

            if ( ! has_term( '', $tag_taxonomy, $post_id ) ) {
              break;
            }

            $ag_has_meta = true;
            ?>
            <li class="tags">
              <?php the_terms( $post_id, $tag_taxonomy, esc_html__( 'Tagged', 'ag' ) . ' ', ', ' ); ?>
            </li>
            <?php
          break;

          // COMMENTS
          case 'comments' : 
            if ( post_password_required() || ! comments_open() || ! get_comments_number() ) {
              break;
            }
            $ag_has_meta = true;
            ?>
            <li class="comments">
              <?php comments_popup_link(); ?>
            </li>
            <?php
          break;

          // EDIT LINK
          case 'edit-link' : 
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
              break;
            }
            $ag_has_meta = true;
            ?>
            <li class="edit">
              <a href="<?php echo esc_url( get_edit_post_link() ); ?>">
                <?php esc_html_e( 'Edit', 'ag' ); ?>
              </a>
            </li>
            <?php
          break;

        }
      }
      ?>

    </ul>
  </div>

  <?php
  wp_reset_postdata();

  // Get the recorded output.
  $meta_output = ob_get_clean();

  // If there is post meta, return it.
  return ( $ag_has_meta && $meta_output ) ? $meta_output : '';

}